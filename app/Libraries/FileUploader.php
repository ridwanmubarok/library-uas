<?php

namespace App\Libraries;

use CodeIgniter\Files\File;

class FileUploader
{
    private string $uploadPath;
    private array $allowedTypes;
    private int $maxSize;

    public function __construct(string $uploadPath = 'writable/uploads', array $allowedTypes = ['jpg', 'jpeg', 'png', 'webp', 'svg'], int $maxSize = 2048)
    {
        $this->uploadPath = $uploadPath;
        $this->allowedTypes = $allowedTypes;
        $this->maxSize = $maxSize;
    }

    public function upload(File $file): ?string
    {
        if (!$file->isValid() || $file->hasMoved()) {
            return null;
        }

        // Check file type
        if (!in_array($file->getClientExtension(), $this->allowedTypes)) {
            return null;
        }

        // Check file size (in KB)
        if ($file->getSize() > ($this->maxSize * 1024)) {
            return null;
        }

        $fileName = $file->getRandomName();
        
        if ($file->move($this->uploadPath, $fileName)) {
            return $fileName;
        }

        return null;
    }

    public function delete(string $fileName): bool
    {
        $filePath = $this->uploadPath . '/' . $fileName;
        
        if (file_exists($filePath)) {
            return unlink($filePath);
        }

        return false;
    }

    public function setUploadPath(string $path): self
    {
        $this->uploadPath = $path;
        return $this;
    }

    public function setAllowedTypes(array $types): self
    {
        $this->allowedTypes = $types;
        return $this;
    }

    public function setMaxSize(int $size): self
    {
        $this->maxSize = $size;
        return $this;
    }
}