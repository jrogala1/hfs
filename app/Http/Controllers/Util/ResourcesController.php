<?php

namespace App\Http\Controllers\Util;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function displayFile($folder, $id)
    {
        $extension = explode(".", $id );
        if ( $extension[1] == "jpg" || $extension[1] == "png" || $extension[1] == "gif" ) $type = 'image/*';
        else if ( $extension[1] == "pdf" ) $type = 'application/pdf';
        else if ( $extension[1] == "txt" ) $type = 'text/plain';

        try {
            $file = Storage::get($folder . '/' . $id);
        } catch (FileNotFoundException $e) {
            dd('file not found  ' .$folder . '/' . $id );
        }

        return response()->make($file, 200, ['content-type' => $type]);
    }

    public function getPathToFile(string $folder, string $filename)
    {
        return asset('/storage/' . $folder . '/' . $filename);
    }

}
