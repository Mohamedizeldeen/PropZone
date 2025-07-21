# PropZone 🏢

<p align="center">
  <img src="public/build/assets/img/PropZoneRealEstateLogo.png" alt="PropZone Logo" height="80">
</p>

<p align="center">
  <strong>Modern Property Management Platform</strong><br>
  Streamline your real estate operations with powerful analytics and intuitive management tools
</p>

<p align="center">
<img src="./public/build/assets/img/PropZoneRealEstateLogo.png" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php" alt="PHP Version">
<img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
<img src="https://img.shields.io/badge/Status-Active-success" alt="Status">
</p>

## 🌟 About PropZone

PropZone is a comprehensive property management platform designed to simplify and enhance real estate operations. Built with modern web technologies, it provides property managers, real estate professionals, and property owners with the tools they need to efficiently manage their portfolios.

### ✨ Key Features

- **📊 Real-time Analytics Dashboard** - Monitor property performance, revenue, and occupancy rates
- **🏠 Property Portfolio Management** - Centralized management of all your properties
- **💰 Revenue Tracking** - Detailed financial analytics and reporting
- **📈 Performance Metrics** - Track occupancy rates, growth trends, and ROI
- **👥 User Management** - Secure authentication and role-based access
- **📱 Responsive Design** - Works seamlessly across all devices
- **🔒 Enterprise Security** - Advanced security features for data protection

### 🎨 Modern UI/UX

PropZone features a sleek, modern interface with:
- **Custom Brand Colors**: Elegant teal gradient design (`#00685f` to `#01bbab`)
- **Interactive Dashboard**: Real-time data visualization and charts
- **Responsive Layout**: Mobile-first design that works on any device
- **Intuitive Navigation**: Right-side sliding navigation for better UX
- **Smooth Animations**: Engaging hover effects and transitions

## 🚀 Technology Stack

PropZone is built using cutting-edge technologies:

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Frontend**: Tailwind CSS, Alpine.js
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **Asset Compilation**: Vite
- **Icons**: Heroicons
- **Charts**: Chart.js (planned)

## 📋 Requirements

- PHP 8.2 or higher
- Composer
- Node.js 18+ and npm
- MySQL 8.0+ or PostgreSQL 13+
- Web server (Apache/Nginx)

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/propzone.git
   cd propzone
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Configuration**
   - Update your `.env` file with database credentials
   - Run migrations:
   ```bash
   php artisan migrate
   ```

6. **Build Assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

7. **Start the Application**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access PropZone!

## 🎯 Features Overview

### Authentication System
- ✅ User Registration with extended profile fields
- ✅ Secure Login with Remember Me functionality
- ✅ Password Reset capabilities
- ✅ Session management and CSRF protection

### Dashboard Features
- ✅ Property performance metrics
- ✅ Revenue tracking and analytics
- ✅ Occupancy rate monitoring
- ✅ Growth trend visualization
- ✅ Recent property activity feed

### User Interface
- ✅ Modern, responsive design
- ✅ Interactive dashboard components
- ✅ Custom brand styling
- ✅ Mobile-optimized layouts
- ✅ Smooth animations and transitions

## 🗂️ Project Structure

```
PropZone/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Authentication logic
│   │   └── DashboardController.php # Dashboard functionality
│   └── Models/
│       └── User.php                # User model with extended fields
├── resources/
│   ├── views/
│   │   ├── welcome.blade.php       # Landing page
│   │   ├── login.blade.php         # Login form
│   │   ├── register.blade.php      # Registration form
│   │   ├── dashboard.blade.php     # Main dashboard
│   │   └── auth/
│   │       └── forgot-password.blade.php
│   └── css/
│       └── app.css                 # Tailwind styles
├── routes/
│   └── web.php                     # Application routes
└── database/
    └── migrations/                 # Database migrations
```

## 🤝 Contributing

We welcome contributions to PropZone! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 Development Guidelines

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed
- Use the existing code style and patterns

## 🐛 Bug Reports

If you discover a bug, please create an issue on GitHub with:
- A clear description of the problem
- Steps to reproduce the issue
- Expected vs actual behavior
- Your environment details

## 🔒 Security

PropZone takes security seriously:

- All user inputs are validated and sanitized
- CSRF protection on all forms
- Secure password hashing with bcrypt
- Session security and regeneration
- SQL injection prevention through Eloquent ORM

## 📊 Roadmap

### Phase 1 (Current) ✅
- ✅ User Authentication System
- ✅ Modern UI/UX Design
- ✅ Basic Dashboard
- ✅ Property Management Foundation

### Phase 2 (Planned) 🚧
- 🔄 Advanced Property CRUD Operations
- 🔄 Tenant Management System
- 🔄 Lease Agreement Management
- 🔄 Payment Processing Integration

### Phase 3 (Future) 📋
- 📋 Advanced Analytics & Reporting
- 📋 Document Management
- 📋 Maintenance Request System
- 📋 Mobile Application

## 🆘 Support

- **Documentation**: [Link to your docs]
- **Issues**: [GitHub Issues](https://github.com/yourusername/propzone/issues)
- **Email**: support@propzone.com
- **Community**: [Discord/Slack channel]

## 📄 License

PropZone is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- Styled with [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- Icons by [Heroicons](https://heroicons.com) - Beautiful hand-crafted SVG icons

---

<p align="center">
  Made with ❤️ for the real estate community<br>
  <strong>PropZone</strong> - Where property management meets innovation
</p>
