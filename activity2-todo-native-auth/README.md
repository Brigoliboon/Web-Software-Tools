# Todo Application with Native Laravel Authentication

<p align="center">
  <a href="https://github.com/jeffstacks/activity2-todo-native-auth"><img src="https://img.shields.io/badge/GitHub-View%20Code-blue?logo=github" alt="GitHub Repository"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-11+-red?logo=laravel" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/PHP-8.1%2B-blue?logo=php" alt="PHP Version"></a>
</p>

## Overview

This Todo Application showcases a secure authentication system built from scratch in Laravel, without relying on authentication scaffolding packages. The project demonstrates understanding of Laravel's core concepts including MVC architecture, middleware, authentication, and database relationships.

## Features Implemented

### 🔐 Native Authentication System
- Custom user registration with server-side validation
- Secure login/logout with session-based authentication
- Password hashing using Laravel's bcrypt implementation
- Custom authentication middleware for route protection
- CSRF protection on all forms

### 👤 User Profile Management
- Secure profile viewing (accessible only to authenticated users)
- Profile editing capabilities (name, email)
- Optional password update with confirmation
- User-specific data isolation

### 📝 Todo CRUD Functionality
- Create, Read, Update, Delete operations for tasks
- User-specific task visibility (users only see their own tasks)
- Task completion status tracking
- Form validation on all inputs

## Technical Implementation

### Project Structure
```
todo-native-auth/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── ProfileController.php
│   │   │   └── TaskController.php
│   │   └── Middleware/
│   │       └── AuthCheck.php
│   └── Models/
│       ├── User.php
│       └── Task.php
├── database/
│   └── migrations/
│       ├── 0001_01_01_000000_create_users_table.php
│       └── xxxx_xx_xx_xxxxxx_create_tasks_table.php
├── routes/
│   └── web.php
└── resources/
    └── views/
        ├── auth/
        │   ├── login.blade.php
        │   └── register.blade.php
        ├── profile/
        │   └── show.blade.php
        └── tasks/
            ├── index.blade.php
            ├── create.blade.php
            └── edit.blade.php
```

### Database Design
- **Users Table**: id, name, email, password, remember_token, timestamps
- **Tasks Table**: id, user_id (foreign key), title, description, completed, timestamps

## Setup & Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL or SQLite
- Node.js & NPM (for asset compilation, if applicable)

### Installation Steps
1. **Clone the repository**
   ```bash
   git clone https://github.com/jeffstacks/activity2-todo-native-auth.git
   cd activity2-todo-native-auth
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run dev  # if using frontend assets
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database** in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_native_auth
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Start development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to access the application.