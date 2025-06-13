<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class FileUploader
{
    protected string $disk;
    protected string $directory;
    protected ?int $width = null;
    protected ?int $height = null;
    protected ?float $scale = null;
    protected ImageManager $imageManager;

    public function __construct(string $disk = 'public', string $directory = 'uploads')
    {
        $this->disk = $disk;
        $this->directory = $directory;
        $this->imageManager = new ImageManager(new Driver());
    }
    public function setDisk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }

    public function setDirectory(string $directory): self
    {
        $this->directory = $directory;
        return $this;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    public function setScale(float $scale): self
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Upload an image file with optional resizing.
     */
    public function uploadImage(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = "{$this->directory}/{$filename}";

        $image = $this->imageManager->read($file->getRealPath());

        if ($this->scale) {
            $image = $image->scale($this->scale);
        }
        if ($this->width || $this->height) {
            $image = $image->resize($this->width, $this->height);
        }

        Storage::disk($this->disk)->put($path, (string) $image->encode());

        return $path;
    }

    /**
     * Upload a generic file (documents, videos, audio, etc.).
     */
    protected function uploadGenericFile(UploadedFile $file, array $allowedExtensions, string $subDirectory): string
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception("Invalid file type: ." . $extension);
        }

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = "{$this->directory}/{$subDirectory}/{$filename}";

        Storage::disk($this->disk)->put($path, file_get_contents($file->getRealPath()));

        return $path;
    }

    /**
     * Delete a file from storage.
     */
    public function deleteFile(?string $filepath): bool
    {
        if (empty($filepath) || !Storage::disk($this->disk)->exists($filepath)) {
            return false;
        }

        return Storage::disk($this->disk)->delete($filepath);
    }

}
