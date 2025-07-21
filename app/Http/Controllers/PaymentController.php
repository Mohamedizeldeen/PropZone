<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Contract;
use App\Models\Tenant;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display payments for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        $payments = Payment::whereHas('contract.property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['tenant', 'contract.property'])
          ->orderBy('paid_date', 'desc')
          ->paginate(15);

        // Get contracts for filter dropdown
        $contracts = Contract::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['property', 'tenant'])->get();

        return view('payments.index', compact('payments', 'contracts'));
    }

    /**
     * Show payment form
     */
    public function create()
    {
        $user = Auth::user();
        
        // Get contracts for the dropdown
        $contracts = Contract::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['property', 'tenant'])->get();
        
        return view('payments.create', compact('contracts'));
    }

    /**
     * Store a new payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,check,bank_transfer,credit_card,online',
            'paid_date' => 'required|date',
            'status' => 'required|in:pending,paid,overdue,cancelled',
            'transaction_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500'
        ]);

        $contract = Contract::with(['property', 'tenant'])->findOrFail($request->contract_id);
        
        // Check authorization
        if ($contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $payment = Payment::create([
            'payment_number' => 'PAY' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
            'contract_id' => $contract->id,
            'tenant_id' => $contract->tenant_id,
            'property_id' => $contract->property_id,
            'user_id' => Auth::id(),
            'payment_type' => 'rent',
            'amount' => $request->amount,
            'due_date' => $request->paid_date, // Using paid_date as due_date for manual entries
            'paid_date' => $request->paid_date,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'transaction_reference' => $request->transaction_reference,
            'late_fee_amount' => 0,
            'notes' => $request->notes
        ]);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully!');
    }

    /**
     * Show payment details
     */
    public function show(Payment $payment)
    {
        // Check authorization
        if ($payment->contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $payment->load(['contract.property', 'contract.tenant']);

        return view('payments.show', compact('payment'));
    }

    /**
     * Show edit form
     */
    public function edit(Payment $payment)
    {
        // Check authorization
        if ($payment->contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $user = Auth::user();
        $contracts = Contract::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['property', 'tenant'])->get();

        return view('payments.edit', compact('payment', 'contracts'));
    }

    /**
     * Update payment
     */
    public function update(Request $request, Payment $payment)
    {
        // Check authorization
        if ($payment->contract->property->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $request->validate([
            'status' => 'sometimes|in:pending,paid,overdue,cancelled',
            'payment_method' => 'sometimes|in:cash,check,bank_transfer,credit_card,online',
            'transaction_reference' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500'
        ]);

        $payment->update($request->only(['status', 'payment_method', 'transaction_reference', 'notes']));

        return redirect()->route('payments.show', $payment)
            ->with('success', 'Payment updated successfully!');
    }
}
