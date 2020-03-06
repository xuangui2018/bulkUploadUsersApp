<?php

declare(strict_types = 1);

namespace App\Helpers;

use App\Exceptions\FileNotFoundException;

class FileHelper {

    /**
     * Get File Content
     *
     * @param string $fileName
     * @return array
     * @throws FileNotFoundException
     */
    public static function getFileContent(string $fileName): array
    {
        $fileContent = [];
        $filePath = dirname(dirname(__DIR__)) . '/' . $fileName;
        if (file_exists($filePath)) {
            $fileContent = array_map('str_getcsv', file($filePath));
        } else {
            throw new FileNotFoundException(sprintf('The specified file: %s was not found', $fileName));
        }
        return $fileContent;
    }
}