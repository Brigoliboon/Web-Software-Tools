# Images Directory

This directory contains all images for the portfolio website.

## Directory Structure

```
images/
├── events/          # Event photos (2 images per event)
├── achievements/    # Achievement photos (2 images per event)
└── projects/        # Project screenshots/thumbnails
```

## Adding Images

### Events Images
Place event photos in `images/events/` with the following naming:
- `innova1.jpg`, `innova2.jpg` - InnoVa Hackathon
- `nasa1.jpg`, `nasa2.jpg` - NASA Space Apps Challenge
- `hackforgov1.jpg`, `hackforgov2.jpg` - HackForGov 2025
- `psc1.jpg`, `psc2.jpg` - Philippine Startup Competition
- `digimc1.jpg`, `digimc2.jpg` - Digi MC 2025
- `malaybalay1.jpg`, `malaybalay2.jpg` - Malaybalay Municipal Pitch

### Achievement Images
Place achievement photos in `images/achievements/` with the following naming:
- `innova-award1.jpg`, `innova-award2.jpg` - InnoVa Hackathon Award
- `nasa-award1.jpg`, `nasa-award2.jpg` - NASA Award
- `psc-award1.jpg`, `psc-award2.jpg` - PSC Award
- `digimc-award1.jpg`, `digimc-award2.jpg` - Digi MC Award

### Project Images
Place project screenshots in `images/projects/` with descriptive names:
- `commlink.jpg` - CommLink project
- `biovision.jpg` - Biovision project
- `hazardmapper.jpg` - Hazard Mapper PH
- `quizit.jpg` - QuizIT
- `pocketplan.jpg` - PocketPlan
- `bantai-mobile.jpg` - Bant.AI Mobile
- `plantbase.jpg` - PlantBase
- `streamio.jpg` - Streamio
- `biovision-web.jpg` - Biovision Landing Page
- `orreyvision.jpg` - OrreyVision
- `vidsrc-api.jpg` - VidSrc API
- `hazardph-api.jpg` - Hazard PH API
- `biovision-api.jpg` - Biovision API
- `synclife.jpg` - SyncLife Concept
- `bantai-concept.jpg` - Bant.AI Concept
- `synclife-proto.jpg` - SyncLife Prototype
- `bantai-proto.jpg` - Bant.AI Prototype

## Image Guidelines

- **Format**: JPG, PNG, or WebP
- **Size**: Recommended max width 1200px for optimal loading
- **Aspect Ratio**: 
  - Events/Achievements: 16:9 or 4:3
  - Projects: 16:9 recommended
- **File Size**: Keep under 500KB per image for fast loading

## Placeholder Images

If you don't have images yet, the website will display:
- A placeholder icon for projects without images
- Empty image slots for events/achievements (won't break the layout)

## Updating Image Paths

To change image paths, edit `config/portfolio.php`:

```php
'events' => [
    [
        'title' => 'Event Name',
        'images' => [
            'images/events/your-image1.jpg',
            'images/events/your-image2.jpg'
        ]
    ]
]
```
