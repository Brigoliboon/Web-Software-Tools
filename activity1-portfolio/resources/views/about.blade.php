@extends('layouts.app')

@section('title', 'About - Boon Jefferson S. Brigoli')

@section('content')
    {{-- Hero-style Bio Section --}}
    <section class="about-hero">
        <div class="container">
            <div class="about-hero-content">
                <h1 class="about-hero-title">{{ $name }}</h1>
                <p class="about-hero-role">{{ $role }}</p>
                
                {{-- Laravel Concept: Displaying Configuration Data --}}
                <p class="about-hero-bio">{{ $bio }}</p>
                
                {{-- Stats Grid --}}
                <div class="about-stats-grid">
                    <div class="about-stat">
                        <div class="about-stat-number">{{ count(config('portfolio.projects')) }}+</div>
                        <div class="about-stat-label">Projects Completed</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">{{ count(config('portfolio.tech_stack.Frontend')) + count(config('portfolio.tech_stack.Backend')) }}+</div>
                        <div class="about-stat-label">Technologies</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">{{ count(config('portfolio.achievements')) }}</div>
                        <div class="about-stat-label">Awards</div>
                    </div>
                    <div class="about-stat">
                        <div class="about-stat-number">{{ count(config('portfolio.events')) }}</div>
                        <div class="about-stat-label">Events</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Skills Section Header --}}
    <section class="skills-header-section">
        <div class="container">
            <h2 class="skills-main-title">Tech Stack & Skills</h2>
            <p class="skills-main-subtitle">Technologies and tools I work with</p>
        </div>
    </section>
    
    {{-- Laravel Concept: Nested Loops --}}
    {{-- Outer loop: iterate through tech stack categories --}}
    {{-- Inner loop: iterate through technologies in each category --}}
    @foreach($techStack as $category => $technologies)
        {{-- Each category as a full-width subsection --}}
        <section class="skill-subsection">
            <div class="container">
                <h3 class="skill-subsection-title">
                    {{-- Category Icons --}}
                    @if($category === 'Frontend')
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="16 18 22 12 16 6"></polyline>
                            <polyline points="8 6 2 12 8 18"></polyline>
                        </svg>
                    @elseif($category === 'Backend')
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
                            <line x1="6" y1="6" x2="6.01" y2="6"></line>
                            <line x1="6" y1="18" x2="6.01" y2="18"></line>
                        </svg>
                    @elseif($category === 'Databases')
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                            <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                            <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                        </svg>
                    @elseif($category === 'DevOps & Tools')
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                    @endif
                    {{ $category }}
                </h3>
                
                <div class="skill-items-grid">
                    @foreach($technologies as $tech)
                        <div class="skill-item">
                            <span class="skill-name">{{ $tech }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
    
    {{-- Call to Action Section --}}
    <section class="about-cta-section">
        <div class="container">
            <div class="about-cta-content">
                <h2 class="about-cta-title">Let's Work Together</h2>
                <p class="about-cta-text">I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision.</p>
                <div class="about-cta-buttons">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Get In Touch
                    </a>
                    <a href="{{ route('projects') }}" class="btn btn-secondary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                        View Projects
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
