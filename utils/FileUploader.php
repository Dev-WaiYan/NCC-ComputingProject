<?php

class FileUploader
{
    private $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
    private $maxSize = 6291456; // 6MB
    private $uploadPath;

    public function __construct($path)
    {
        $this->uploadPath = $path;
    }

    public function uploadFile($file)
    {
        $fileName = $file['name'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $file['size'];
        $fileTmp = $file['tmp_name'];

        if (!in_array($fileType, $this->allowedTypes)) {
            throw new Exception('File type not allowed.');
        }

        if ($fileSize > $this->maxSize) {
            throw new Exception('File size exceeds limit.');
        }

        $newFileName = uniqid() . '.' . $fileType;
        $destination = $this->uploadPath . '/' . $newFileName;

        if (!move_uploaded_file($fileTmp, $destination)) {
            throw new Exception('File upload failed.');
        }

        return $newFileName;
    }
}
