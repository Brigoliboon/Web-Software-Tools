<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ImageService
{
    /**
     * Store image and create thumbnails.
     */
    public function storeImage(UploadedFile $file, string $directory = 'covers'): array
    {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Store original image
        $path = $file->storeAs($directory, $filename, 'public');
        
        // Create thumbnail
        $this->createThumbnail($path, $filename, 150, 150);
        
        return [
            'path' => $path,
            'thumbnail' => $directory . '/thumbnails/' . $filename,
        ];
    }

    /**
     * Create a thumbnail of the image using GD library.
     */
    public function createThumbnail(string $imagePath, string $filename, int $width, int $height): void
    {
        try {
            $fullPath = storage_path('app/public/' . $imagePath);
            
            // Get image info
            $imageInfo = getimagesize($fullPath);
            if (!$imageInfo) {
                return;
            }
            
            // Create image resource based on type
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($fullPath);
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($fullPath);
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($fullPath);
                    break;
                default:
                    return;
            }
            
            if (!$source) {
                return;
            }
            
            // Get original dimensions
            $originalWidth = imagesx($source);
            $originalHeight = imagesy($source);
            
            // Calculate thumbnail dimensions maintaining aspect ratio
            $ratio = min($width / $originalWidth, $height / $originalHeight);
            $newWidth = (int) ($originalWidth * $ratio);
            $newHeight = (int) ($originalHeight * $ratio);
            
            // Create thumbnail
            $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
            
            // Handle transparency for PNG/GIF
            if ($imageInfo[2] === IMAGETYPE_PNG || $imageInfo[2] === IMAGETYPE_GIF) {
                imagealphablending($thumbnail, false);
                imagesavealpha($thumbnail, true);
                $transparent = imagecolorallocatealpha($thumbnail, 0, 0, 0, 127);
                imagefilledrectangle($thumbnail, 0, 0, $newWidth, $newHeight, $transparent);
            }
            
            // Resize
            imagecopyresampled(
                $thumbnail, $source,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $originalWidth, $originalHeight
            );
            
            // Ensure thumbnail directory exists
            $dirname = dirname($fullPath);
            $thumbnailDir = $dirname . '/thumbnails';
            if (!file_exists($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }
            
            // Save thumbnail
            $thumbnailPath = $thumbnailDir . '/' . $filename;
            
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($thumbnail, $thumbnailPath, 85);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($thumbnail, $thumbnailPath);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($thumbnail, $thumbnailPath);
                    break;
            }
            
            // Free memory
            imagedestroy($source);
            imagedestroy($thumbnail);
            
        } catch (\Exception $e) {
            Log::error('Thumbnail creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Delete image and its thumbnail.
     */
    public function deleteImage(?string $imagePath): void
    {
        if (!$imagePath) {
            return;
        }

        // Delete main image
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        // Delete thumbnail
        $dirname = dirname($imagePath);
        $basename = basename($imagePath);
        $thumbnailPath = $dirname . '/thumbnails/' . $basename;
        
        if (Storage::disk('public')->exists($thumbnailPath)) {
            Storage::disk('public')->delete($thumbnailPath);
        }
    }

    /**
     * Get the URL for an image or return placeholder.
     */
    public function getImageUrl(?string $imagePath, string $type = 'full'): string
    {
        if (!$imagePath) {
            return '';
        }

        if ($type === 'thumbnail') {
            $dirname = dirname($imagePath);
            $basename = basename($imagePath);
            $thumbnailPath = $dirname . '/thumbnails/' . $basename;
            
            if (Storage::disk('public')->exists($thumbnailPath)) {
                return asset('storage/' . $thumbnailPath);
            }
        }

        if (Storage::disk('public')->exists($imagePath)) {
            return asset('storage/' . $imagePath);
        }

        return '';
    }
}
