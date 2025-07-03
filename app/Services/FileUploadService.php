<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use App\Models\Volume;

class FileUploadService {
    public static function uploadPdf($file, $volume, $number) {
        // Step 1: Get the aliases from the database
        $volumeAlias = Volume::find($volume)->alias;
        $issueAlias = Volume::find($number)->alias;

        // Step 2: Create a folder name dynamically
        $folder = "Vol{$volumeAlias}No{$issueAlias}";

        // Step 3: Define the file storage path
        $path = public_path("pdf/{$folder}");

        // Step 4: Check if the directory exists, if not, create it
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Step 5: Move the uploaded file to the designated path
        return $file->move($path, $file->getClientOriginalName());
    }

    public static function uploadImages($file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        return $filename; // ✅ Return only file name
    }
}
