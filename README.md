# Web Software and Tools Laboratory Activities

This repository contains laboratory activities for the Web Software and Tools course, focusing on Laravel web application development. The activities progressively build upon each other to teach various aspects of web development with Laravel.

## Overview

The laboratory sequence covers:
1. Basic Laravel portfolio website (Activity 1)
2. Authentication systems and CRUD operations (Activity 2)
3. E-commerce bookstore management system (Activity 3)
4. Advanced authentication features in bookstore system (Activity 4)

Each activity builds upon Laravel fundamentals while introducing new concepts and techniques.

## Laboratory Activities

### Activity 1: Portfolio Website
**Directory:** `activity1-portfolio`

A basic Laravel portfolio website that introduces:
- Laravel project structure
- Blade templating engine
- Routing fundamentals
- Static page creation
- Basic styling with CSS

This activity establishes the foundation for Laravel development by creating a simple, responsive portfolio page.

### Activity 2: Todo Application with Native Authentication
**Directory:** `activity2-todo-native-auth`

A Laravel web application featuring:
- Custom-built authentication system (registration, login, logout)
- User profile management
- To-Do list CRUD functionality
- Custom middleware for route protection
- Password hashing with bcrypt
- User-specific data isolation
- Custom UI design

This activity focuses on implementing authentication and authorization systems manually, without using Laravel's built-in authentication scaffolding.

### Activity 3: Bookstore Management System
**Directory:** `activity3-bookstore-management-system`

A basic e-commerce bookstore management system that includes:
- Book catalog browsing
- Category management
- Basic shopping cart functionality
- Order processing
- Administrative features for managing books and categories

This activity introduces e-commerce concepts and database relationships in Laravel.

### Activity 4: Bookstore Management System with Advanced Authentication
**Directory:** `activity4-bookstore-management-system(advanced_auth)`

An enhanced version of the bookstore system featuring:
- Role-based access control (admin/customer)
- Two-factor authentication (2FA)
- Email verification
- Enhanced security features
- Admin dashboard with analytics
- Advanced user management
- Complete e-commerce workflow

This activity builds upon Activity 3 by implementing advanced authentication and authorization features commonly found in production applications.

## Learning Progression

The activities are designed to follow this learning progression:
1. **Foundations** (Activity 1): Laravel basics and MVC structure
2. **Authentication & CRUD** (Activity 2): User management and data manipulation
3. **Application Development** (Activity 3): Building complete web applications
4. **Advanced Features** (Activity 4): Security, roles, and enterprise-level features

## Prerequisites

- PHP 8.1+
- Composer
- Node.js & npm (for frontend assets)
- MySQL or SQLite database

## Common Setup Instructions

For each activity:
1. Navigate to the activity directory
2. Copy `.env.example` to `.env` and configure database settings
3. Run `composer install` to install PHP dependencies
4. Run `php artisan key:generate` to set application key
5. Run `php artisan migrate` to set up database tables
6. For activities with frontend assets: `npm install && npm run dev`
7. Start development server: `php artisan serve`

## License

These laboratory activities are for educational purposes only.