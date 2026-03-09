<?php

/**
 * Portfolio Configuration File
 * 
 * Laravel Concept: Configuration Files
 * This file stores all portfolio data in a structured, maintainable way.
 * Access this data using config('portfolio.key') throughout the application.
 */

return [
    // Personal Information
    'name' => 'Boon Jefferson S. Brigoli',
    'role' => 'Full-Stack Developer',
    'email' => 'brigoliboonjefferson@gmail.com',
    'portfolio_url' => 'https://boonjf-dev.vercel.app/',
    'github' => 'https://github.com/Brigoliboon',
    'linkedin' => 'https://linkedin.com/in/boon-jefferson-brigoli-a1a4a628a',
    
    // Biograph
    'bio' => "An Information Technology student specialized in Software Development, passionate about building innovative software solutions. With expertise in full-stack development, I specialize in creating scalable web and mobile applications that solve real-world problems. My journey spans from Android development to modern web technologies, always driven by curiosity and a commitment to excellence.",
    
    // Contact Information
    'contacts' => [
        [
            'type' => 'Email',
            'value' => 'brigoliboonjefferson@gmail.com',
            'url' => 'mailto:brigoliboonjefferson@gmail.com',
            'icon' => '📧'
        ],
        [
            'type' => 'GitHub',
            'value' => 'Brigoliboon',
            'url' => 'https://github.com/Brigoliboon',
            'icon' => '💻'
        ],
        [
            'type' => 'LinkedIn',
            'value' => 'Boon Jefferson Brigoli',
            'url' => 'https://linkedin.com/in/boon-jefferson-brigoli-a1a4a628a',
            'icon' => '💼'
        ]
    ],
    
    // Work Experience
    'experience' => [
        [
            'year' => '2025',
            'title' => 'Full-Stack Developer & Innovator',
            'description' => 'Continued to build and refine production-grade applications, blending backend, frontend, and mobile development. Participated in major national tech events, further sharpening skills in systems design, pitching, and collaborative innovation.',
            'highlights' => [
                'Developed scalable applications using FastAPI and Firebase for authentication and data handling.',
                'Built and optimized Android apps using Java and Kotlin with modular, SOLID-driven architecture.',
                'Integrated cloud storage, REST APIs, and asynchronous processing to improve performance and maintainability.',
                'Led product ideation and prototyping that won 1st Place at Digi MC 2025 and Top 10 finalist in the Philippine Startup Competition.',
                'Explored Next.js for full-stack web development and began unifying backend services across projects.'
            ]
        ],
        [
            'year' => '2024',
            'title' => 'Android Developer & Systems Engineer',
            'description' => 'Focused on building complex Android applications integrated with real-world data sources. Refined backend API architecture, improved UI flows, and introduced modular patterns to enhance maintainability.',
            'highlights' => [
                'Built Biovision — an AI-powered plant disease detection app using FastAPI backend and Android frontend.',
                'Developed hazard mapping system leveraging Mapbox and PHIVOLCS/PAGASA datasets for real-time awareness.',
                'Designed authentication, caching, and push notification systems for a seamless user experience.',
                'Created QuizIT — a modular quiz platform using SQLite, designed for category-based assessments.',
                'Improved code quality through refactoring and implemented clean UI principles across projects.'
            ]
        ],
        [
            'year' => '2023',
            'title' => 'Independent Developer & Tech Explorer',
            'description' => 'The year of discovery and foundation — began exploring software development deeply, experimenting with new tools, languages, and frameworks to establish a strong technical base.',
            'highlights' => [
                'Learned Python and backend fundamentals through project-based learning and API design.',
                'Explored ethical hacking and CTFs (Capture the Flag) to understand network and system vulnerabilities.',
                'Started building small utility scripts and personal automation tools using Python and Bash.',
                'Engaged in design and UX prototyping using Figma and Canva to visualize app concepts.'
            ]
        ],
        [
            'year' => '2022 & Earlier',
            'title' => 'Early Development & Skill Foundation',
            'description' => 'Built the groundwork for future projects — developing curiosity for software systems, understanding problem-solving, and forming the mindset of a builder.',
            'highlights' => [
                '2018: Began experimenting with Sketchware, building small apps that sharpen critical thinking, spark innovative ideas, and explore basic concepts of data structures and logic.',
                'Studied computing fundamentals, programming logic, and debugging techniques.',
                'Explored web technologies like HTML, CSS, and JavaScript to understand frontend development basics.',
                'Developed an early interest in automation, AI, and cybersecurity concepts.'
            ]
        ]
    ],
    
    // Events
    'events' => [
        [
            'date' => 'Jun 2024',
            'title' => 'InnoVa Hackathon (KERNEL 2024 ICT EXPO)',
            'description' => 'Competed nationally during the National ICT Month celebration. Achieved 2nd Place for an innovative ICT solution that addressed real-world problems.',
            'images' => [
                'https://boonjf-dev.vercel.app/innovahackathon.jpg',
                'https://boonjf-dev.vercel.app/innovahackathon2.jpg'
            ]
        ],
        [
            'date' => 'Oct 2024',
            'title' => 'NASA International Space Apps Challenge 2024',
            'description' => 'Participated globally in NASA\'s innovation challenge, contributing solutions for space and Earth science projects. Received the Galactic Problem Solver recognition.',
            'images' => [
                'https://boonjf-dev.vercel.app/spaceapps.jpg',
                'https://boonjf-dev.vercel.app/spaceapps2.jpg'
            ]
        ],
        [
            'date' => 'Feb 2025',
            'title' => 'HackForGov 2025 – Regional Qualifier',
            'description' => 'Qualified to represent the university in a government-sponsored cybersecurity Capture the Flag event focusing on forensics, network security, and ethical hacking.',
            'images' => [
                'https://boonjf-dev.vercel.app/events/hack4gov_2.jpg',
                'https://boonjf-dev.vercel.app/events/hack4gov.jpg'
            ]
        ],
        [
            'date' => 'Nov 2025',
            'title' => 'Philippine Startup Competition 2025',
            'description' => 'Presented a tech-driven startup solution, placing in the Top 10 out of 60 participants and winning the Best in Video Pitch award for clarity and creativity.',
            'images' => [
                'https://boonjf-dev.vercel.app/PSC2025.jpg',
                'https://boonjf-dev.vercel.app/PSC2025_2.jpg'
            ]
        ],
        [
            'date' => 'Nov 2025',
            'title' => 'Digi MC 2025 – Malaybalay City',
            'description' => 'A reverse pitching event focused on solving real city challenges. Our team presented the winning solution and became the 1st Place/Champion.',
            'images' => [
                'https://boonjf-dev.vercel.app/events/DIGIMC2025_2.jpg',
                'https://boonjf-dev.vercel.app/events/DIGIMC2025_3.jpg'
            ]
        ],
        [
            'date' => 'Dec 2025',
            'title' => 'Malaybalay Municipal Innovation Pitch',
            'description' => 'Professionally pitched a tech-driven solution to the City of Malaybalay, presenting system features, implementation timeline, and cost analysis directly to municipal offices and the City Mayor.',
            'images' => [
                'https://boonjf-dev.vercel.app/malaybalay_pitch1.jpg',
                'https://boonjf-dev.vercel.app/malaybalay_pitch2.jpg'
            ]
        ]
    ],
    
    // Achievements
    'achievements' => [
        [
            'text' => '🥈 2nd Place – InnoVa Hackathon (KERNEL 2024 ICT EXPO)',
            'images' => [
                'https://boonjf-dev.vercel.app/events/innovahackathon_award.jpg',
                'https://boonjf-dev.vercel.app/events/innovahackathon_award2.jpg'
            ]
        ],
        [
            'text' => '🌌 Galactic Problem Solver – NASA Space Apps Challenge 2024',
            'images' => [
                'https://boonjf-dev.vercel.app/events/nasa_award.jpg',
                'https://boonjf-dev.vercel.app/events/nasa_award1.jpg'
            ]
        ],
        [
            'text' => '🏆 Top 10 & Best in Video Pitch – Philippine Startup Competition 2025',
            'images' => [
                'https://boonjf-dev.vercel.app/events/psc_award2.jpg',
                'https://boonjf-dev.vercel.app/events/psc_award.jpg'
            ]
        ],
        [
            'text' => '🥇 1st Place/Champion – Digi MC 2025',
            'images' => [
                'https://boonjf-dev.vercel.app/events/digimc2025_award2.jpg',
                'https://boonjf-dev.vercel.app/events/digimc2025_awarding.jpg'
            ]
        ]
    ],
    
    // Projects
    'projects' => [
        // Mobile Applications
        [
            'title' => 'CommLink',
            'description' => 'A peer-to-peer push-to-talk (PTT) walkie-talkie mobile app built with Flutter. It enables real-time voice streaming over local Wi-Fi using UDP multicast, peer discovery, and low-latency audio processing—designed for campus-wide offline communication.',
            'category' => 'Mobile Application',
            'technologies' => ['Flutter', 'Dart', 'Android', 'Wi-Fi', 'Audio Processing'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/commlink.jpg'
        ],
        [
            'title' => 'Biovision',
            'description' => 'An AI-powered mobile application that identifies plant diseases through image analysis. Features Firebase authentication, FastAPI backend, and detailed disease assessments built with SOLID principles.',
            'category' => 'Mobile Application',
            'technologies' => ['FastAPI', 'Firebase', 'Android', 'Python', 'AI'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/biovision.jpg'
        ],
        [
            'title' => 'Hazard Mapper PH',
            'description' => 'A disaster preparedness and hazard-mapping app that visualizes PHIVOLCS and PAGASA data. Includes user authentication, friend visibility, and real-time hazard alerts within a defined radius.',
            'category' => 'Mobile Application',
            'technologies' => ['Java', 'Firebase', 'SQLite', 'Mapbox', 'MongoDB'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/hazardmapper.jpg'
        ],
        [
            'title' => 'QuizIT',
            'description' => 'A category-based quiz app covering Programming, Networking, and Scripting topics. Uses SQLite for offline access and offers customizable question sets for each topic.',
            'category' => 'Mobile Application',
            'technologies' => ['Android', 'Java', 'SQLite'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/quizit.jpg'
        ],
        [
            'title' => 'PocketPlan',
            'description' => 'A minimalist personal finance tracker that visualizes expenses and income trends with charts and categorized transaction history. Designed with a teal/green theme for clarity and simplicity.',
            'category' => 'Mobile Application',
            'technologies' => ['Kotlin', 'Java', 'Gradle', 'Firebase'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/pocketplan.jpg'
        ],
        [
            'title' => 'Bant.AI Mobile Client',
            'description' => 'A mobile client application for Bant.AI designed to deliver real-time flood warnings, risk levels, and sensor updates directly to users. Built with a clean, responsive interface and integrated with Firebase Cloud Messaging for alert notifications.',
            'category' => 'Mobile Application',
            'technologies' => ['Next.js', 'Java', 'Tailwind', 'PostgreSQL', 'Supabase'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/bantai-mobile.jpg'
        ],
        
        // Web Applications
        [
            'title' => 'PlantBase',
            'description' => 'A plant identification and researcher platform using Next.js and Supabase. Supports plant sampling, researcher profiles, authenticated image uploads, and location-based documentation with RLS-secured data models.',
            'category' => 'Web Application',
            'technologies' => ['React', 'Next.js', 'Supabase', 'TypeScript', 'Tailwind', 'PostgreSQL'],
            'liveUrl' => 'https://plantbase-ten.vercel.app/',
            'githubUrl' => 'https://github.com/Brigoliboon/plantbase',
            'image' => 'images/projects/plantbase.jpg'
        ],
        [
            'title' => 'Streamio',
            'description' => 'A streaming website with responsive UI, video categorization, and sleek dark mode design. Built for performance and scalability with modern Next.js architecture.',
            'category' => 'Web Application',
            'technologies' => ['Next.js', 'React', 'Tailwind', 'Node.js', 'Vercel', 'Auth0', 'PostgreSQL'],
            'liveUrl' => 'https://streamio-nu.vercel.app/',
            'githubUrl' => '',
            'image' => 'images/projects/streamio.jpg'
        ],
        [
            'title' => 'Biovision Landing Page',
            'description' => 'A landing interface for Biovision backend that handles authentication, error responses, and static file management. Integrates Firebase for secure user login and account handling.',
            'category' => 'Web Application',
            'technologies' => ['FastAPI', 'Python', 'Firebase', 'HTML', 'CSS', 'Vercel'],
            'liveUrl' => 'https://bio-vision-api.vercel.app',
            'githubUrl' => '',
            'image' => 'images/projects/biovision-web.jpg'
        ],
        [
            'title' => 'OrreyVision',
            'description' => 'An orrery website with 3D rendered solar system featuring celestial bodies and asteroid, comet trajectories. Built using vanilla JavaScript with Three.js Library, HTML, and CSS.',
            'category' => 'Web Application',
            'technologies' => ['JavaScript', 'Three.js', 'HTML', 'CSS'],
            'liveUrl' => 'https://final-orrery.vercel.app/',
            'githubUrl' => '',
            'image' => 'images/projects/orreyvision.jpg'
        ],
        
        // RESTful APIs
        [
            'title' => 'VidSrc Ad Remover API',
            'description' => 'A lightweight Node.js API that fetches VidSrc pages, strips intrusive ad scripts, and returns a clean, parsed HTML response. Built using Axios and Cheerio for fast server-side extraction.',
            'category' => 'RESTful APIs',
            'technologies' => ['Node.js', 'JavaScript', 'Axios', 'HTML', 'Vercel'],
            'liveUrl' => 'https://vidsrc-no-ads-script.vercel.app/',
            'githubUrl' => '',
            'image' => 'images/projects/vidsrc-api.jpg'
        ],
        [
            'title' => 'Hazard PH API',
            'description' => 'A FastAPI backend for the Hazard PH Android application. Handles Firebase user authentication, real-time user monitoring and logging, app activation/deactivation via server requests, and user blocklisting to manage access and security.',
            'category' => 'RESTful APIs',
            'technologies' => ['FastAPI', 'Python', 'Firebase', 'Pydantic'],
            'liveUrl' => 'https://hazardph-api.vercel.app/',
            'githubUrl' => '',
            'image' => 'images/projects/hazardph-api.jpg'
        ],
        [
            'title' => 'Biovision API',
            'description' => 'Handles user authentication using Firebase, integrates multiple APIs into one workflow, receives images from the client by converting them into Base64, performs a POST request, identifies the plant, and returns the identification result in a uniform JSON format.',
            'category' => 'RESTful APIs',
            'technologies' => ['FastAPI', 'Python', 'Firebase', 'Pydantic'],
            'liveUrl' => 'https://bio-vision-api.vercel.app/api',
            'githubUrl' => '',
            'image' => 'images/projects/biovision-api.jpg'
        ],
        
        // Ideas & Concepts
        [
            'title' => 'SyncLife',
            'description' => 'A productivity, monitoring, and tracking app concept with three main functionalities: a Calendar for scheduling events and appointments, a Wallet to log expenses, and a Calorie Tracker/Meal Planner to monitor meals and nutrition.',
            'category' => 'Ideas & Concepts',
            'technologies' => ['Next.js', 'React', 'Tailwind', 'Auth0', 'PostgreSQL', 'Supabase'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/synclife.jpg'
        ],
        [
            'title' => 'Bant.AI',
            'description' => 'A barangay-level early warning and monitoring system that uses IoT sensors, multi-layer connectivity (LoRa, GSM/2G, Wi-Fi), and cloud-based analytics to detect flood risks and deliver real-time alerts even in low-signal or disaster-prone areas.',
            'category' => 'Ideas & Concepts',
            'technologies' => ['Next.js', 'React', 'Node.js', 'Firebase', 'PostgreSQL', 'Arduino', 'ESP32', 'Docker', 'AWS'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/bantai-concept.jpg'
        ],
        
        // Prototypes
        [
            'title' => 'SyncLife Prototype',
            'description' => 'A frontend prototype of the SyncLife app built with Next.js and Tailwind. Demonstrates the Calendar, Wallet, and Calorie Tracker/Meal Planner functionalities using dummy data for visualization and interaction.',
            'category' => 'Prototypes',
            'technologies' => ['Next.js', 'Tailwind', 'React'],
            'liveUrl' => '',
            'githubUrl' => '',
            'image' => 'images/projects/synclife-proto.jpg'
        ],
        [
            'title' => 'Bant.AI Prototype',
            'description' => 'An IoT-powered early warning and monitoring system built for barangay-level flood detection. Includes a fully developed Next.js admin dashboard and client interface connected to a Node.js backend.',
            'category' => 'Prototypes',
            'technologies' => ['Next.js', 'Node.js', 'Tailwind', 'Firebase', 'MongoDB', 'Arduino', 'ESP32'],
            'liveUrl' => 'https://bant-ai.vercel.app/',
            'githubUrl' => '',
            'image' => 'images/projects/bantai-proto.jpg'
        ]
    ],
    
    // Tech Stack
    'tech_stack' => [
        'Frontend' => [
            'JavaScript', 'TypeScript', 'HTML', 'CSS', 'React', 'Next.js',
            'Tailwind CSS', 'Redux', 'Axios', 'Expo', 'Framer Motion', 'Shadcn UI', 'React Query'
        ],
        'Backend' => [
            'Node.js', 'Express', 'Python', 'FastAPI', 'Flask', 'Django',
            'Java', 'PHP', 'Laravel', 'Dart', 'Flutter', 'WebSockets', 'Prisma'
        ],
        'Databases' => [
            'MongoDB', 'PostgreSQL', 'MySQL', 'SQLite', 'Firebase', 'Supabase'
        ],
        'DevOps & Tools' => [
            'Docker', 'AWS', 'Git', 'GitHub', 'Vercel', 'Netlify',
            'VS Code', 'Android Studio', 'IntelliJ IDEA', 'Postman'
        ],
        'Graphics & Design' => [
            'Figma', 'Adobe Illustrator', 'Adobe Photoshop', 'Adobe After Effects'
        ]
    ]
];
