# Advanced Bookstore Management System

<p align="center">
  <a href="https://github.com/jeffstacks/activity4-bookstore-management-system(advanced_auth)"><img src="https://img.shields.io/badge/GitHub-View%20Code-blue?logo=github" alt="GitHub Repository"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-10+-red?logo=laravel" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php" alt="PHP Version"></a>
</p>

## Overview

This Advanced Bookstore Management System enhances the basic bookstore application with sophisticated authentication and authorization features. Built as part of advanced Laravel coursework, this project implements role-based access control, two-factor authentication, and comprehensive security measures while maintaining all core bookstore functionality.

## Features Implemented

### 🔐 Advanced Authentication System
- **Two-Factor Authentication (2FA)**: Time-based one-time passwords (TOTP) via authenticator apps
- **Role-Based Access Control (RBAC)**: Distinct permissions for admin and customer roles
- **Email Verification**: Required email confirmation upon registration
- **Secure Password Policies**: Enforcement of strong password requirements
- **Remember Me Functionality**: Secure persistent login sessions
- **Password Reset**: Secure token-based password recovery
- **Account Lockout**: Temporary lockout after failed login attempts

### 👥 User Management
- **Role Assignment**: Admin can assign user roles (admin/customer)
- **Profile Management**: Users can update personal information and preferences
- **Activity Logging**: Tracking of user actions for security auditing
- **Session Management**: Concurrent session limits and device management
- **Privacy Controls**: GDPR-compliant data handling options

### 📚 Enhanced Bookstore Features
- **All Basic Features**: Book catalog, shopping cart, order processing (from activity3)
- **Advanced Search**: Full-text search with filters and faceted navigation
- **Wishlist System**: Save books for later purchase
- **Reviews & Ratings**: User-generated book reviews with moderation
- **Inventory Management**: Real-time stock tracking with low-stock alerts
- **Discount System**: Coupon codes and promotional pricing
- **Order History**: Detailed purchase history with reorder capability

### ⚙️ Administrative Dashboard
- **User Administration**: Create/edit/delete users, manage roles and permissions
- **Content Management**: Book and category management with approval workflows
- **Order Management**: View, process, and track all customer orders
- **Analytics & Reporting**: Sales reports, inventory reports, user statistics
- **System Settings**: Configuration options for security, email, and payment systems
- **Audit Logs**: Comprehensive tracking of administrative actions

### 🛡️ Security Enhancements
- **Advanced Encryption**: Enhanced encryption for sensitive data
- **CSRF Protection**: Extended to all forms and AJAX requests
- **XSS Prevention**: Output escaping and content security policies
- **SQL Injection Prevention**: Parameterized queries and ORM protection
- **Rate Limiting**: API and login attempt throttling
- **Security Headers**: Implementation of modern HTTP security headers
- **Input Validation**: Server-side validation on all inputs
- **File Upload Security**: Secure file handling with virus scanning simulation

## Technical Implementation

### Architecture
This project utilizes a modular architecture with clear separation of concerns:
- **Core Modules**: Authentication, User Management, Bookstore, Admin Panel
- **Service Layer**: Business logic separated from controllers
- **Repository Pattern**: Data access abstraction
- **Event System**: Loose coupling through Laravel events and listeners
- **Notifications**: Laravel notification system for emails and alerts

### Database Design (Enhanced)
- **users**: id, name, email, password, role, two_factor_secret, two_factor_recovery_codes, remember_token, email_verified_at, failed_login_attempts, locked_until, timestamps
- **roles**: id, name, description, permissions (JSON), timestamps
- **permissions**: id, name, description, module, action
- **role_user**: Pivot table for many-to-many relationship
- **user_sessions**: id, user_id, ip_address, user_agent, last_activity, tokens
- **two_factor_verifications**: id, user_id, code, expires_at, verified_at
- **books**: Enhanced with ISBN, publisher, publication_date, dimensions, weight
- **categories**: Hierarchical structure with parent-child relationships
- **orders**: Enhanced with tax, discount, shipping tracking
- **order_items**: Extended with tax calculations
- **reviews**: id, user_id, book_id, rating, title, content, approved, timestamps
- **wishlists**: id, user_id, book_id, timestamps
- **coupons**: id, code, description, discount_type, discount_value, starts_at, expires_at, usage_limit
- **audit_logs**: id, user_id, action, model, model_id, changes, ip_address, user_agent, timestamps

### Key Technologies
- **Backend**: Laravel 10, PHP 8.1+
- **Frontend**: Blade Templates, Alpine.js, Tailwind CSS (via Vite)
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Fortify + Custom 2FA Implementation
- **Authorization**: Laravel Gates and Policies
- **Packages**: 
  - laravel/fortify (authentication scaffolding)
  - laravel/sanctum (API authentication)
  - spatie/laravel-permission (role & permission management)
  - pragmarx/google2fa (two-factor authentication)
  - livewire/livewire (dynamic components)
  - laravel/scout (full-text search)
  - laravel/telescope (debugging - development only)

## Setup & Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL or SQLite
- Node.js 16+ & NPM
- (Optional) Docker for containerized deployment

### Installation Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/jeffstacks/activity4-bookstore-management-system(advanced_auth).git
   cd activity4-bookstore-management-system(advanced_auth)
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies**
   ```bash
   npm install && npm run dev
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database** in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=advanced_bookstore
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Install Laravel Sanctum** (for API auth)
   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

9. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

### Default Accounts (after seeding)
- **Admin Admin**: admin@bookstore.com / password
  - Can access all admin features
  - Has permission to manage users, books, orders
- **Customer User**: customer@bookstore.com / password
  - Standard customer access
  - Can browse, purchase, review books
- **Demo User**: demo@bookstore.com / password
  - Limited access for demonstration purposes