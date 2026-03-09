<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Portfolio Controller
 * 
 * Laravel Concept: Controllers
 * Controllers handle the logic for your routes. They fetch data from various sources
 * (in this case, configuration files) and pass it to views for rendering.
 * 
 * This controller manages all portfolio-related pages:
 * - Home page with hero, contacts, and achievements
 * - About page with biography and tech stack
 * - Projects page with filterable project categories
 * - Contact page with contact form and information
 */
class PortfolioController extends Controller
{
    /**
     * Display the home page
     * 
     * Laravel Concept: Passing Data to Views
     * We use config() helper to retrieve data from config files
     * and compact() to pass variables to the view as an associative array.
     * 
     * @return View
     */
    public function home(): View
    {
        // Fetch personal information from configuration
        $name = config('portfolio.name');
        $role = config('portfolio.role');
        $portfolioUrl = config('portfolio.portfolio_url');
        
        // Fetch contact information
        $contacts = config('portfolio.contacts');
        
        // Fetch achievements
        $achievements = config('portfolio.achievements');
        
        // Fetch experience data
        $experience = config('portfolio.experience');
        
        // Fetch events data
        $events = config('portfolio.events');
        
        // Laravel Concept: compact() function
        // compact() creates an array with variable names as keys and their values as values
        // This is a convenient way to pass multiple variables to a view
        return view('home', compact('name', 'role', 'portfolioUrl', 'contacts', 'achievements', 'experience', 'events'));
    }

    /**
     * Display the about page
     * 
     * @return View
     */
    public function about(): View
    {
        // Fetch biography
        $bio = config('portfolio.bio');
        
        // Fetch tech stack grouped by categories
        $techStack = config('portfolio.tech_stack');
        
        // Fetch personal information for display
        $name = config('portfolio.name');
        $role = config('portfolio.role');
        
        return view('about', compact('bio', 'techStack', 'name', 'role'));
    }

    /**
     * Display the projects page
     * 
     * Laravel Concept: Data Processing
     * We can process data in the controller before passing it to the view.
     * Here, we extract unique categories from the projects array.
     * 
     * @return View
     */
    public function projects(): View
    {
        // Get all projects from configuration
        $projects = config('portfolio.projects');
        
        // Extract unique categories from projects
        // array_column() extracts a single column from a multi-dimensional array
        // array_unique() removes duplicate values
        $categories = array_unique(array_column($projects, 'category'));
        
        return view('projects', compact('projects', 'categories'));
    }

    /**
     * Display the contact page
     * 
     * @return View
     */
    public function contact(): View
    {
        // Fetch contact information
        $contacts = config('portfolio.contacts');
        
        // Fetch personal information
        $name = config('portfolio.name');
        $email = config('portfolio.email');
        
        return view('contact', compact('contacts', 'name', 'email'));
    }
}
