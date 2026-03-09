{{-- Laravel Concept: Template Inheritance --}}
{{-- @extends tells Laravel this view extends the master layout --}}
@extends('layouts.app')

{{-- Laravel Concept: Defining Sections --}}
{{-- @section defines content for a specific section in the parent layout --}}
@section('title', 'Home - Boon Jefferson S. Brigoli')

@section('content')
    {{-- Hero Section --}}
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                {{-- Laravel Concept: Echoing Variables --}}
                {{-- {{ }} automatically escapes HTML to prevent XSS attacks --}}
                <h1 class="hero-title">{{ $name }}</h1>
                <p class="hero-subtitle">{{ $role }}</p>
                <p class="hero-description">
                    Building innovative solutions through code, one project at a time.
                </p>
                
                <div class="hero-buttons">
                    {{-- Laravel Concept: Using Configuration Values --}}
                    <a href="{{ $portfolioUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                        View Original Portfolio
                    </a>
                    <a href="{{ asset('resume.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        View Resume
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Contact Cards Section --}}
    <section class="contact-cards-section">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Feel free to reach out through any of these channels</p>
            
            <div class="cards-grid">
                {{-- Laravel Concept: Blade Loops --}}
                {{-- @foreach iterates over an array, similar to PHP's foreach --}}
                @foreach($contacts as $contact)
                    <a href="{{ $contact['url'] }}" target="_blank" rel="noopener noreferrer" class="card contact-card">
                        <div class="card-icon">{{ $contact['icon'] }}</div>
                        <h3 class="card-title">{{ $contact['type'] }}</h3>
                        <p class="card-value">{{ $contact['value'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    
    {{-- Experience Section --}}
    <section class="experience-section">
        <div class="container">
            <h2 class="section-title">Professional Journey</h2>
            
            {{-- Experience Tabs --}}
            <div class="tabs">
                <button class="tab-btn active" data-tab="experience">Experience</button>
                <button class="tab-btn" data-tab="events">Events</button>
                <button class="tab-btn" data-tab="achievements">Achievements</button>
            </div>
            
            {{-- Experience Tab Content --}}
            <div class="tab-content active" id="experience">
                <div class="journey-timeline">
                    {{-- Laravel Concept: Looping with Array Data --}}
                    @foreach($experience as $exp)
                        <div class="journey-item">
                            <div class="journey-left">
                                <div class="journey-line"></div>
                                <div class="journey-bullet"></div>
                            </div>
                            <div class="journey-right">
                                <div class="journey-year">{{ $exp['year'] }}</div>
                                <h3 class="journey-title">{{ $exp['title'] }}</h3>
                                <p class="journey-description">{{ $exp['description'] }}</p>
                                <ul class="journey-highlights">
                                    {{-- Laravel Concept: Nested Loops --}}
                                    @foreach($exp['highlights'] as $highlight)
                                        <li>{!! $highlight !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            {{-- Events Tab Content --}}
            <div class="tab-content" id="events">
                <div class="journey-timeline">
                    @foreach($events as $event)
                        <div class="journey-item">
                            <div class="journey-left">
                                <div class="journey-line"></div>
                                <div class="journey-bullet"></div>
                            </div>
                            <div class="journey-right">
                                <div class="journey-year">{{ $event['date'] }}</div>
                                <h3 class="journey-title">{{ $event['title'] }}</h3>
                                <p class="journey-description">{{ $event['description'] }}</p>
                                
                                {{-- Event Images --}}
                                @if(isset($event['images']))
                                    <div class="journey-images">
                                        @foreach($event['images'] as $image)
                                            <div class="journey-image">
                                                <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}" alt="{{ $event['title'] }}" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            {{-- Achievements Tab Content --}}
            <div class="tab-content" id="achievements">
                <div class="journey-timeline">
                    {{-- Laravel Concept: Looping with Index --}}
                    @foreach($achievements as $index => $achievement)
                        <div class="journey-item">
                            <div class="journey-left">
                                <div class="journey-line"></div>
                                <div class="journey-bullet">{{ $index + 1 }}</div>
                            </div>
                            <div class="journey-right">
                                {{-- Laravel Concept: Checking if array or string --}}
                                @if(is_array($achievement))
                                    <p class="journey-achievement-text">{{ $achievement['text'] }}</p>
                                    
                                    {{-- Achievement Images --}}
                                    @if(isset($achievement['images']))
                                        <div class="journey-images">
                                            @foreach($achievement['images'] as $image)
                                                <div class="journey-image">
                                                    <img src="{{ str_starts_with($image, 'http') ? $image : asset($image) }}" alt="Achievement" loading="lazy">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <p class="journey-achievement-text">{{ $achievement }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Laravel Concept: Additional Scripts Section --}}
@section('scripts')
<script>
    // Tab switching functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabName = this.dataset.tab;
                
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                this.classList.add('active');
                document.getElementById(tabName).classList.add('active');
            });
        });
    });
</script>
@endsection
