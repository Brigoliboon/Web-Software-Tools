# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel-based bookstore management system with advanced authentication features including two-factor authentication, role-based access control (admin/customer), and a complete e-commerce workflow.

## Architecture Overview

### Core Components

1. **User Management**
   - Role-based access control (admin/customer)
   - Two-factor authentication support
   - Profile management
   - Email verification

2. **Bookstore Features**
   - Book catalog with categories
   - Shopping cart functionality
   - Order processing system
   - Book reviews and ratings

3. **Admin Dashboard**
   - User management
   - Book/category management
   - Order management
   - Analytics and reporting

### Key Models and Relationships

- **User**: Core user model with roles, 2FA support
- **Book**: Represents books with title, author, ISBN, price, stock
- **Category**: Book categorization system
- **Order**: Customer orders with status tracking
- **OrderItem**: Individual items within orders
- **Review**: Book reviews with ratings

## Common Development Commands

### Setup and Installation
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Build frontend assets
npm run build
```

### Development Server
```bash
# Start development server with all services
composer dev
```

### Testing
```bash
# Run all tests
composer test

# Run tests with coverage
php artisan test --coverage

# Run a specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests in a specific directory
php artisan test tests/Unit/
```

### Database Operations
```bash
# Run database migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:refresh

# Seed the database
php artisan db:seed

# Access database CLI
php artisan db
```

### Artisan Tinker (Interactive PHP Shell)
```bash
# Start interactive shell
php artisan tinker

# Execute a single command
php artisan tinker --execute="App\Models\User::count()"

# Delete a user by email
php artisan tinker --execute="App\Models\User::where('email', 'example@example.com')->delete()"
```

## Code Structure

### Directory Layout
```
app/
  Http/Controllers/     # Controllers for handling requests
  Models/               # Eloquent models
  Console/Commands/     # Custom Artisan commands
database/
  migrations/          # Database schema migrations
  seeders/             # Database seeders
resources/
  views/               # Blade templates
routes/               # Route definitions
tests/                # PHPUnit tests
```

### Key Route Groups
1. **Public Routes**: Home page, book browsing
2. **Authenticated Routes**: Cart, orders, reviews, profile
3. **Admin Routes**: User management, book management, order management
4. **Authentication Routes**: Login, registration, password reset

## Database Schema

### Main Tables
- `users`: User accounts with roles and 2FA fields
- `categories`: Book categories
- `books`: Book inventory with pricing and stock
- `orders`: Customer orders with status tracking
- `order_items`: Individual items within orders
- `reviews`: Book reviews with ratings

## Frontend Build Process

The project uses Vite with Tailwind CSS for styling:
- `npm run dev` - Start development server with hot reloading
- `npm run build` - Build production assets

## Environment Configuration

Key environment variables:
- `DB_CONNECTION=sqlite` - Using SQLite database
- `MAIL_MAILER=smtp` - SMTP configuration for emails
- Two-factor authentication settings

## Testing Framework

Uses PHPUnit with Laravel testing features:
- Feature tests in `tests/Feature/`
- Unit tests in `tests/Unit/`
- In-memory SQLite database for testing