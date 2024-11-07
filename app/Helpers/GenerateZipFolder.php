<?php

namespace App\Helpers;
use Illuminate\Support\Facades\File;
use ZipArchive;

trait GenerateZipFolder
{
  public function generateZip($sourcePath="",$outputPath){
    $zip = new ZipArchive();
    // Create or open the ZIP file
    if ($zip->open($outputPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Get real path for the source folder
        $files = File::allFiles($sourcePath);

        foreach ($files as $file) {
            $relativePath = $file->getRelativePathname();
            $zip->addFile($file->getRealPath(), $relativePath);
        }

        // Close the ZIP file
        $zip->close();

        return "Zip file created at: $outputPath";
    } else {
        return "Failed to create ZIP file.";
    }
  }
}
