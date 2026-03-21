# Bookstore Management System

<p align="center">
  <a href="https://github.com/jeffstacks/activity3-bookstore-management-system"><img src="https://img.shields.io/badge/GitHub-View%20Code-blue?logo=github" alt="GitHub Repository"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-9+-red?logo=laravel" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.0%2B-blue?logo=php" alt="PHP Version"></a>
</p>

## Overview

This Bookstore Management System is a full-featured web application built with Laravel that allows users to browse, purchase, and manage books online. The system includes user authentication, book catalog management, shopping cart functionality, and order processing capabilities.

## Features Implemented

### 📚 Book Catalog
- Browse books by category, author, or search
- Detailed book views with cover images, descriptions, and pricing
- Filtering and sorting options
- Pagination for large catalogs

### 🛒 Shopping Cart
- Add/remove books from cart
- Update quantities
- Persistent cart across sessions
- Cart summary with totals

### 👤 User Accounts
- User registration with email verification
- Secure login/logout system
- Profile management
- Order history tracking

### 📋 Order Management
- Checkout process with multiple payment options (simulated)
- Order confirmation and tracking
- Admin view of all orders
- Order status updates

### ⚙️ Admin Panel (Basic)
- Book inventory management (add/edit/delete)
- Category management
- User management
- Sales reporting

## Technical Implementation

### Architecture
This project follows Laravel's MVC (Model-View-Controller) architecture:
- **Models**: Book, User, Category, Order, OrderItem, Cart
- **Controllers**: RESTful controllers for each entity
- **Views**: Blade templates with Bootstrap 4 styling
- **Routes**: Web routes organized by functionality

### Database Design
- **users**: id, name, email, password, role, remember_token, timestamps
- **books**: id, title, author, isbn, price, description, cover_image, category_id, stock, timestamps
- **categories**: id, name, description, timestamps
- **orders**: id, user_id, status, total_amount, shipping_address, timestamps
- **order_items**: id, order_id, book_id, quantity, price, timestamps
- **carts**: id, user_id, book_id, quantity, timestamps

### Key Technologies
- **Backend**: Laravel 9, PHP 8.0+
- **Frontend**: Blade Templates, Bootstrap 4, Vanilla JavaScript
- **Database**: MySQL
- **Authentication**: Laravel's built-in auth system
- **Packages**: Laravel/UI for auth scaffolding

## Setup & Installation

### Prerequisites
- PHP 8.0+
- Composer
- MySQL
- Node.js & NPM (for asset compilation)

### Installation Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/jeffstacks/activity3-bookstore-management-system.git
   cd activity3-bookstore-management-system
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies** (if applicable)
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
   DB_DATABASE=bookstore_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.

### Default Accounts (after seeding)
- **Admin**: admin@bookstore.com / password
- **Customer**: customer@bookstore.com / password