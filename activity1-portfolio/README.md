# Jeff Stacks Portfolio - Laravel Web Application

<p align="center">
  <a href="https://github.com/jeffstacks/activity1-portfolio"><img src="https://img.shields.io/badge/GitHub-View%20Code-blue?logo=github" alt="GitHub Repository"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-10+-red?logo=laravel" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php" alt="PHP Version"></a>
</p>

## Overview

This is a personal portfolio website built with Laravel 10 to showcase web development projects and skills. The application serves as both a demonstration of Laravel proficiency and a professional showcase for potential employers or clients.

## Features Implemented

### 📱 Responsive Design
- Mobile-first approach with Bootstrap 5
- Fluid layouts that adapt to all screen sizes
- Touch-friendly navigation and interactions
- Optimized performance for fast loading

### 🎨 Visual Presentation
- Clean, modern aesthetic with professional color scheme
- Project showcase with thumbnail previews
- Smooth animations and transitions
- Consistent typography and spacing

### 🔧 Technical Features
- Laravel Blade templating engine
- Routing with named routes and middleware
- Static asset management (CSS, JS, images)
- SEO-friendly structure with semantic HTML
- Contact form with validation

### 📂 Project Organization
- Clean separation of concerns (MVC architecture)
- Well-organized views directory structure
- Efficient asset pipeline
- Clear routing logic

## Technical Implementation

### Architecture
This portfolio follows Laravel's MVC (Model-View-Controller) pattern:
- **Views**: Blade templates for rendering pages
- **Routes**: Web routes defined in `routes/web.php`
- **Controllers**: PageController handles page rendering
- **Assets**: CSS, JavaScript, and images in `public/` directory

### Key Components
- **Home Page**: Introduction and featured projects
- **Projects Section**: Grid layout showcasing all Laravel activities
- **Navigation**: Fixed header with smooth scrolling
- **Footer**: Contact information and copyright

### Database
This portfolio uses static content and does not require a database connection, focusing on frontend presentation and Laravel routing capabilities.

## Setup & Installation

### Prerequisites
- PHP 8.1+
- Composer
- Web server (Apache/Nginx) or PHP built-in server

### Installation Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/jeffstacks/activity1-portfolio.git
   cd activity1-portfolio
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to view the portfolio.

## Project Structure

```
activity1-portfolio/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PageController.php
│   │   └── Middleware/
├── bootstrap/
├── config/
├── database/
├── public/
│   ├── css/
│   ├── js/
│   └── images/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── pages/
│   │   └── partials/
├── routes/
│   └── web.php
└── ...
```

## Technologies Used

### Backend
- **Laravel Framework**: PHP 8.1+ with Laravel 10
- **Routing**: Laravel's expressive routing system
- **Blade Templating**: Server-side rendering with Blade
- **Middleware**: HTTP middleware for request filtering

### Frontend
- **HTML5**: Semantic markup structure
- **CSS3**: Custom styling with Bootstrap 5 utilities
- **JavaScript**: Vanilla JS for interactive elements
- **Bootstrap 5**: Responsive frontend framework

### Development Tools
- **Composer**: PHP dependency management
- **Artisan**: Laravel CLI for development tasks
- **PHP Built-in Server**: For local development

## Portfolio Contents

This portfolio showcases the following Laravel projects from academic coursework:

1. **Todo Application with Native Authentication** (activity2-todo-native-auth)
   - Custom authentication system without scaffolding
   - User profile management
   - Todo CRUD functionality

2. **Bookstore Management System** (activity3-bookstore-management-system)
   - Full e-commerce bookstore
   - Shopping cart and order processing
   - Admin panel for inventory management

3. **Advanced Bookstore Management System** (activity4-bookstore-management-system(advanced_auth))
   - Two-factor authentication
   - Role-based access control
   - Enhanced security features

## Learning Objectives Demonstrated

Through this portfolio project, the following Laravel competencies are demonstrated:
- **Application Structure**: Proper organization of Laravel applications
- **Routing & Controllers**: Clean route definitions and controller logic
- **Blade Templating**: Effective use of layouts, components, and directives
- **Asset Management**: Proper handling of CSS, JavaScript, and images
- **Responsive Design**: Mobile-first approach with Bootstrap
- **Project Presentation**: Professional showcase of technical work

## Conclusion

This portfolio represents a solid foundation in Laravel web development, demonstrating the ability to create professional, responsive web applications using modern PHP frameworks. While simple in functionality, it effectively showcases technical skills and serves as a gateway to the more complex Laravel projects featured within it.