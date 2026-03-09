# Todo Native Auth - Laravel Application

A Laravel web application with native authentication system, user profile management, and To-Do CRUD functionality. Built manually without using authentication scaffolding packages.

## Features

### A. Native Authentication System
- User registration with validation
- User login with session-based authentication
- User logout
- Password hashing using bcrypt
- Route protection using custom middleware

### B. User Profile Management
- View authenticated user profile
- Edit user name and email
- Optional password update
- Profile page accessible only to logged-in users

### C. To-Do List CRUD Application
- Create tasks
- Display tasks belonging only to the logged-in user
- Edit tasks
- Delete tasks
- User-specific data isolation

## Project Structure

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

## Setup Instructions

### Prerequisites
- PHP 8.1+
- Composer
- MySQL or SQLite

### Installation

1. **Create the project**
   ```bash
   composer create-project laravel/laravel todo-native-auth
   cd todo-native-auth
   ```

2. **Configure Database**
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_native
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Create Database**
   ```bash
   mysql -u root -p -e "CREATE DATABASE todo_native;"
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Start Development Server**
   ```bash
   php artisan serve
   ```

## Implementation Details

### Authentication Controller
- `showRegister()` - Display registration form
- `register()` - Handle user registration
- `showLogin()` - Display login form
- `login()` - Handle user login with session
- `logout()` - Handle user logout

### Profile Controller
- `show()` - Display user profile
- `update()` - Update user profile information

### Task Controller
- `index()` - List all tasks for authenticated user
- `create()` - Show create task form
- `store()` - Store new task
- `edit()` - Show edit task form
- `update()` - Update existing task
- `destroy()` - Delete task

### Middleware
- `AuthCheck` - Protects routes requiring authentication

## Routes

| Method | Route | Controller | Description |
|--------|-------|------------|-------------|
| GET | /register | AuthController | Show registration form |
| POST | /register | AuthController | Handle registration |
| GET | /login | AuthController | Show login form |
| POST | /login | AuthController | Handle login |
| POST | /logout | AuthController | Handle logout |
| GET | /profile | ProfileController | Show profile |
| POST | /profile | ProfileController | Update profile |
| GET | /tasks | TaskController | List tasks |
| GET | /tasks/create | TaskController | Create task form |
| POST | /tasks | TaskController | Store task |
| GET | /tasks/{id}/edit | TaskController | Edit task form |
| PUT | /tasks/{id} | TaskController | Update task |
| DELETE | /tasks/{id} | TaskController | Delete task |

## UI Design

This project features a custom-designed user interface with:
- Unique color scheme
- Custom layout structure
- Responsive design
- Original typography and spacing

**Note:** This UI is student-designed and must not be copied. Each student must create their own unique design.

## Security Features

- Passwords are hashed using bcrypt
- Session-based authentication
- User data isolation (users can only see their own tasks)
- Route protection with custom middleware
- Input validation on all forms

## Tech Stack

- **Framework:** Laravel 11+
- **Database:** MySQL/SQLite
- **Authentication:** Native Session-based
- **Templating:** Blade Templates
- **CSS:** Custom CSS (no default Laravel styles)

## Grading Rubrics

| Criteria | Points |
|----------|--------|
| Native Authentication Implementation | 20 |
| User Profile Management | 15 |
| To-Do CRUD Functionality | 25 |
| MVC Structure and Flow | 20 |
| UI Design and Uniqueness | 15 |
| GitHub Repository and Commits | 5 |
| **Total** | **100** |

## License

This project is for educational purposes.
