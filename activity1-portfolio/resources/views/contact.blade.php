@extends('layouts.app')

@section('title', 'Contact - Boon Jefferson S. Brigoli')

@section('content')
    <section class="contact-section">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header">
                <h1 class="page-title">Get In Touch</h1>
                <p class="page-subtitle">Have a project in mind? Let's discuss how we can work together</p>
            </div>
            
            <div class="contact-wrapper">
                {{-- Contact Form --}}
                <div class="contact-form-container">
                    <div class="card">
                        <h2 class="form-title">Send Me a Message</h2>
                        <p class="form-subtitle">Fill out the form below and I'll get back to you as soon as possible</p>
                        
                        {{-- Laravel Concept: Forms --}}
                        {{-- In a real application, this would POST to a route that handles the submission --}}
                        <form class="contact-form" id="contactForm">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control" 
                                    placeholder="Your full name"
                                    required
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control" 
                                    placeholder="your.email@example.com"
                                    required
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input 
                                    type="text" 
                                    id="subject" 
                                    name="subject" 
                                    class="form-control" 
                                    placeholder="What's this about?"
                                    required
                                >
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea 
                                    id="message" 
                                    name="message" 
                                    class="form-control" 
                                    rows="6" 
                                    placeholder="Tell me about your project or inquiry..."
                                    required
                                ></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="22" y1="2" x2="11" y2="13"></line>
                                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                </svg>
                                Send Message
                            </button>
                        </form>
                        
                        {{-- Success/Error Messages --}}
                        <div class="form-message" id="formMessage" style="display: none;"></div>
                    </div>
                </div>
                
                {{-- Contact Information --}}
                <div class="contact-info-container">
                    <div class="card contact-info-card">
                        <h2 class="info-title">Contact Information</h2>
                        <p class="info-subtitle">Feel free to reach out through any of these channels</p>
                        
                        <div class="contact-methods">
                            {{-- Laravel Concept: Looping through contact data --}}
                            @foreach($contacts as $contact)
                                <a href="{{ $contact['url'] }}" target="_blank" rel="noopener noreferrer" class="contact-method">
                                    <div class="method-icon">{{ $contact['icon'] }}</div>
                                    <div class="method-content">
                                        <div class="method-type">{{ $contact['type'] }}</div>
                                        <div class="method-value">{{ $contact['value'] }}</div>
                                    </div>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="7" y1="17" x2="17" y2="7"></line>
                                        <polyline points="7 7 17 7 17 17"></polyline>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Quick Links Card --}}
                    <div class="card quick-links-card">
                        <h3 class="quick-links-title">Quick Links</h3>
                        <div class="quick-links">
                            <a href="{{ config('portfolio.portfolio_url') }}" target="_blank" rel="noopener noreferrer" class="quick-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                                Full Portfolio
                            </a>
                            <a href="{{ asset('resume.pdf') }}" target="_blank" rel="noopener noreferrer" class="quick-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                </svg>
                                Download Resume
                            </a>
                            <a href="{{ route('projects') }}" class="quick-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                </svg>
                                View Projects
                            </a>
                            <a href="{{ route('about') }}" class="quick-link">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                About Me
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Contact form handling
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(contactForm);
            const name = formData.get('name');
            const email = formData.get('email');
            const subject = formData.get('subject');
            const message = formData.get('message');
            
            // Basic validation
            if (!name || !email || !subject || !message) {
                showMessage('Please fill in all fields', 'error');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                showMessage('Please enter a valid email address', 'error');
                return;
            }
            
            // Simulate form submission
            // In a real application, this would send data to a Laravel route
            const submitButton = contactForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span>Sending...</span>';
            
            setTimeout(() => {
                showMessage('Thank you for your message! I\'ll get back to you soon.', 'success');
                contactForm.reset();
                submitButton.disabled = false;
                submitButton.innerHTML = `
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Send Message
                `;
            }, 1500);
        });
        
        function showMessage(text, type) {
            formMessage.textContent = text;
            formMessage.className = 'form-message ' + type;
            formMessage.style.display = 'block';
            
            setTimeout(() => {
                formMessage.style.display = 'none';
            }, 5000);
        }
    });
</script>
@endsection
