# Laravel Portfolio Website

A modern, dark minimalist portfolio website built with Laravel 12 and Blade templating.

## 🎨 Features

- **Modern Dark Theme**: Professional dark minimalist design with blue accents
- **Responsive Design**: Mobile-first approach that works on all devices
- **Dynamic Content**: All content managed through Laravel configuration
- **4 Main Pages**:
  - **Home**: Hero section, contact cards, experience timeline with tabs
  - **About**: Biography, tech stack grid, statistics
  - **Projects**: Filterable project showcase with categories
  - **Contact**: Contact form and information cards

## 🚀 Laravel Concepts Demonstrated

This project demonstrates key Laravel concepts for beginners:

1. **Routing** (`routes/web.php`)
   - Custom route definitions
   - Named routes
   - Controller binding

2. **Controllers** (`app/Http/Controllers/PortfolioController.php`)
   - Controller structure
   - Passing data to views
   - Using configuration files

3. **Configuration** (`config/portfolio.php`)
   - Storing application data
   - Accessing config with `config()` helper

4. **Blade Templating** (`resources/views/`)
   - Template inheritance with `@extends`
   - Sections with `@section` and `@yield`
   - Loops with `@foreach`
   - Conditionals with `@if`
   - Echoing data with `{{ }}`

5. **Project Structure**
   - MVC pattern
   - Separation of concerns
   - Clean, maintainable code

## 📁 Project Structure

```
activity1/
├── app/
│   └── Http/
│       └── Controllers/
│           └── PortfolioController.php
├── config/
│   └── portfolio.php
├── public/
│   ├── css/
│   │   └── portfolio.css
│   └── resume.pdf (add your resume here)
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── home.blade.php
│       ├── about.blade.php
│       ├── projects.blade.php
│       └── contact.blade.php
└── routes/
    └── web.php
```

## 🛠️ Setup Instructions

### Prerequisites

- PHP 8.2 or higher
- Composer
- Laravel 12

### Installation

1. **Navigate to the project directory**
   ```bash
   cd activity1
   ```

2. **Install dependencies** (if not already installed)
   ```bash
   composer install
   ```

3. **Set up environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Add your resume** (optional)
   - Place your `resume.pdf` file in `public/` directory
   - Or update the resume link in the views

5. **Start the development server**
   ```bash
   php artisan serve
   ```

6. **Visit the website**
   - Open your browser and go to: `http://localhost:8000`

## 🎯 Available Routes

- `/` - Home page
- `/about` - About page
- `/projects` - Projects page
- `/contact` - Contact page

## 🎨 Design System

### Colors

```css
Background: #0f0f0f (Dark)
Card Background: #161616
Text: #e5e5e5 (Light gray)
Accent: #3b82f6 (Blue)
Hover: #2563eb (Darker blue)
Border: #262626
```

### Typography

- **Font Family**: Inter (Google Fonts)
- **Headings**: Bold, larger sizes
- **Body**: Regular weight, comfortable reading size

## 📝 Customization

### Update Personal Information

Edit `config/portfolio.php`:

```php
'name' => 'Your Name',
'role' => 'Your Role',
'email' => 'your.email@example.com',
// ... etc
```

### Add/Edit Projects

Edit the `projects` array in `config/portfolio.php`:

```php
'projects' => [
    [
        'title' => 'Project Name',
        'description' => 'Project description',
        'category' => 'Web Application',
        'technologies' => ['React', 'Node.js'],
        'liveUrl' => 'https://...',
        'githubUrl' => 'https://...',
        'image' => 'images/project.jpg'
    ],
    // Add more projects...
]
```

### Update Tech Stack

Edit the `tech_stack` array in `config/portfolio.php`:

```php
'tech_stack' => [
    'Frontend' => ['React', 'Vue', 'Angular'],
    'Backend' => ['Laravel', 'Node.js', 'Django'],
    // ... etc
]
```

### Modify Styles

Edit `public/css/portfolio.css` to customize:
- Colors (CSS variables at the top)
- Spacing
- Typography
- Component styles

## 🔧 Troubleshooting

### Routes not working

```bash
php artisan route:clear
php artisan cache:clear
```

### Views not found

```bash
php artisan view:clear
```

### CSS not loading

1. Check that `portfolio.css` exists in `public/css/`
2. Clear browser cache
3. Verify the asset path in `layouts/app.blade.php`

### Config not loading

```bash
php artisan config:clear
```

## 📚 Learning Resources

### Laravel Documentation
- [Routing](https://laravel.com/docs/routing)
- [Controllers](https://laravel.com/docs/controllers)
- [Blade Templates](https://laravel.com/docs/blade)
- [Configuration](https://laravel.com/docs/configuration)

### Code Comments

All files include detailed comments explaining:
- Laravel concepts being used
- How each feature works
- Best practices

## 🎓 Key Takeaways

After completing this project, you should understand:

1. How to structure a Laravel application
2. How routing works in Laravel
3. How to create and use controllers
4. How to pass data from controllers to views
5. How to use Blade templating engine
6. How to organize application data in config files
7. How to create responsive, modern UI with CSS
8. How to implement interactive features with JavaScript

## 📦 Features Breakdown

### Home Page
- Hero section with name and role
- Call-to-action buttons (Portfolio, Resume)
- Contact information cards
- Experience timeline with tabs (Experience, Events, Achievements)

### About Page
- Biography section
- Statistics cards
- Tech stack organized by categories
- Call-to-action section

### Projects Page
- Category filter buttons
- Project cards with images
- Technology tags
- Live demo and GitHub links
- Smooth filtering animations

### Contact Page
- Contact form with validation
- Contact information cards
- Quick links section
- Availability status

## 🚀 Next Steps

### Enhancements you can add:

1. **Database Integration**
   - Store projects in database
   - Create admin panel for content management

2. **Contact Form Backend**
   - Process form submissions
   - Send emails
   - Store messages in database

3. **Blog Section**
   - Add blog functionality
   - Markdown support
   - Categories and tags

4. **Authentication**
   - Admin login
   - Protected routes
   - Content management

5. **API**
   - Create REST API for projects
   - JSON responses
   - API documentation

6. **Testing**
   - Unit tests
   - Feature tests
   - Browser tests

## 📄 License

This project is open-source and available for educational purposes.

## 👤 Author

**Boon Jefferson S. Brigoli**
- Portfolio: [https://boonjf-dev.vercel.app/](https://boonjf-dev.vercel.app/)
- GitHub: [@Brigoliboon](https://github.com/Brigoliboon)
- LinkedIn: [Boon Jefferson Brigoli](https://linkedin.com/in/boon-jefferson-brigoli-a1a4a628a)

---

Built with ❤️ using Laravel & Blade
