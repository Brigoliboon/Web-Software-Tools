@extends('layouts.app')

@section('title', 'Projects - Boon Jefferson S. Brigoli')

@section('content')
    <section class="projects-section">
        {{-- Page Header with standard container --}}
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">My Projects</h1>
                <p class="page-subtitle">
                    A collection of web applications, mobile apps, APIs, and innovative concepts I've built
                </p>
            </div>
            
            {{-- Category Filter --}}
            <div class="category-filter">
                <button class="category-btn active" data-category="all">
                    All Projects
                </button>
                
                {{-- Laravel Concept: Looping through categories --}}
                {{-- We extract unique categories in the controller and loop through them here --}}
                @foreach($categories as $category)
                    <button class="category-btn" data-category="{{ $category }}">
                        {{ $category }}
                    </button>
                @endforeach
            </div>
        </div>
        
        {{-- Projects Grid with wider container --}}
        <div class="container-wide">
            <div class="projects-grid">
                {{-- Laravel Concept: Looping through projects --}}
                {{-- Each project has a data-category attribute for JavaScript filtering --}}
                @foreach($projects as $project)
                    <div class="card project-card" data-category="{{ $project['category'] }}">
                        {{-- Project Image --}}
                        <div class="project-image">
                            {{-- Laravel Concept: Conditional Rendering --}}
                            {{-- @if checks if a condition is true --}}
                            @if($project['image'])
                                <img src="{{ asset($project['image']) }}" alt="{{ $project['title'] }}" loading="lazy">
                            @else
                                <div class="project-placeholder">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Category Badge --}}
                            <div class="project-category-badge">{{ $project['category'] }}</div>
                        </div>
                        
                        {{-- Project Content --}}
                        <div class="project-content">
                            <h3 class="project-title">{{ $project['title'] }}</h3>
                            
                            {{-- Laravel Concept: Using Laravel Helpers --}}
                            {{-- Str::limit() truncates text to a specified length --}}
                            <p class="project-description">{{ Str::limit($project['description'], 120) }}</p>
                            
                            {{-- Technologies --}}
                            <div class="tech-tags">
                                @foreach($project['technologies'] as $tech)
                                    <span class="tech-tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                            
                            {{-- Project Links --}}
                            <div class="project-links">
                                {{-- Laravel Concept: Conditional Display --}}
                                {{-- Only show links if they exist --}}
                                @if($project['liveUrl'])
                                    <a href="{{ $project['liveUrl'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-small btn-primary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                        </svg>
                                        Live Demo
                                    </a>
                                @endif
                                
                                @if($project['githubUrl'])
                                    <a href="{{ $project['githubUrl'] }}" target="_blank" rel="noopener noreferrer" class="btn btn-small btn-secondary">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        GitHub
                                    </a>
                                @endif
                                
                                {{-- Laravel Concept: @if @else @endif --}}
                                @if(!$project['liveUrl'] && !$project['githubUrl'])
                                    <span class="project-status">In Development</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Empty State --}}
            <div class="empty-state" id="emptyState" style="display: none;">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <h3>No projects found</h3>
                <p>Try selecting a different category</p>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // Project filtering functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-btn');
        const projectCards = document.querySelectorAll('.project-card');
        const emptyState = document.getElementById('emptyState');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.dataset.category;
                
                // Update active button
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter projects with animation
                let visibleCount = 0;
                
                projectCards.forEach((card, index) => {
                    // Add slight delay for staggered animation
                    setTimeout(() => {
                        if (category === 'all' || card.dataset.category === category) {
                            card.style.display = 'block';
                            // Trigger reflow for animation
                            card.offsetHeight;
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                            visibleCount++;
                        } else {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                card.style.display = 'none';
                            }, 300);
                        }
                    }, index * 50);
                });
                
                // Show empty state if no projects match
                setTimeout(() => {
                    if (visibleCount === 0) {
                        emptyState.style.display = 'flex';
                    } else {
                        emptyState.style.display = 'none';
                    }
                }, projectCards.length * 50 + 300);
            });
        });
        
        // Initialize project cards with animation
        projectCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 50);
        });
    });
</script>
@endsection
