<?php

namespace App\Helpers;

use File;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadHelper
{
    public function deleteFile($fileName)
    {
        if (Storage::delete($fileName)) {
            return true;
        }
    }
    public function uploadFile(UploadedFile $uploadedFile, $idName, $folder)
    {
        $timeStamp = Carbon::now()->timestamp;
        $fileName = !is_null($idName) ? $idName . '_' .
            $timeStamp . '_' . uniqId() : str_random(25);
        if ($uploadedFile->storeAs('public/' . $folder, $fileName)) {
            return $folder . '/' . $fileName;
        } else {
            return false;
        }
    }
}
