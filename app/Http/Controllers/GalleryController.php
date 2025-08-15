<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Helpers\ResponseMessages;

class GalleryController extends BaseController
{
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:5120', // max 5MB
        ]);

        $path = $request->file('photo')->store('photos', 's3');

        // Hacer público el archivo (opcional)
        Storage::disk('s3')->setVisibility($path, 'public');

        $url = Storage::disk('s3')->url($path);

        return response()->json(['url' => $url]);
    }

    public function list()
    {
        $files = Storage::disk('s3')->allFiles();

        $urls = array_map(function($file) {
            return Storage::disk('s3')->url($file);
        }, $files);

        return $this->sendResponse($urls, ResponseMessages::successList(), 200);
    }
}
