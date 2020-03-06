<?php

declare(strict_types = 1);

namespace App\Helpers;

class FileHelper {

    /**
     * Get File Content
     *
     * @param string $fileName
     * @return array
     */
    public static function getFileContent(string $fileName): array
    {
        $fileContent = [];
        $filePath = dirname(dirname(__DIR__)) . '/' . $fileName;
        if (file_exists($filePath)) {
            $fileContent = array_map('str_getcsv', file($filePath));
            return $fileContent;
        }
    }
}