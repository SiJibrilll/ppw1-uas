<?php

class ImageHandler
{
    private $uploadDir = 'public/uploads/';
    private $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    public function upload($file)
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'Upload failed.'];
        }

        if (!in_array($file['type'], $this->allowedTypes)) {
            return ['error' => 'Only JPEG, PNG, and GIF files are allowed.'];
        }

        // Get file extension
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

        // Generate unique filename: originalname_timestamp.ext
        $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $baseName);
        $uniqueName = $safeName . '_' . time() . '.' . $ext;

        $targetPath = $this->uploadDir . $uniqueName;

        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            return ['path' => '/uploads/' . $uniqueName];
        }

        return ['error' => 'Failed to move uploaded file.'];
    }

    public function getImagePath($filename)
    {
        $fullPath = $this->uploadDir . $filename;

        if (file_exists($fullPath)) {
            return '/uploads/' . $filename;
        }

        return null;
    }
}
