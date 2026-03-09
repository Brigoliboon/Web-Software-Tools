<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

/**
 * Laravel Concept: Routing
 * 
 * Routes define the URLs that users can access in your application.
 * Each route is mapped to a controller method that handles the request.
 * 
 * Route Structure: Route::get(url, [Controller::class, 'method'])->name('route_name');
 * - get(): HTTP method (GET request)
 * - url: The URL path users will visit
 * - Controller::class: The controller that handles this route
 * - 'method': The method in the controller to execute
 * - name(): Assigns a name to the route for easy reference
 */

// Home page route
// When user visits '/', Laravel calls the 'home' method in PortfolioController
Route::get('/', [PortfolioController::class, 'home'])->name('home');

// About page route
// Accessible at /about
Route::get('/about', [PortfolioController::class, 'about'])->name('about');

// Projects page route
// Accessible at /projects
Route::get('/projects', [PortfolioController::class, 'projects'])->name('projects');

// Contact page route
// Accessible at /contact
Route::get('/contact', [PortfolioController::class, 'contact'])->name('contact');
