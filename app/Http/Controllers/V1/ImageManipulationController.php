<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\ImageManipulation;
use App\Http\Requests\ResizeImageRequest;
use App\Models\Album;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageManipulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function ByAlbum(Album $album)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function resize(ResizeImageRequest $request)
    {
        $all = $request->all();

        $image = $all['image'];
        unset($all['image']);
        $data = [
            'type' => ImageManipulation::TYPE_RESIZE,
            'data' => json_encode($all),
            'user_id' => null,
        ];

        if(isset($all['album_id'])) {
            $data['album_id'] = $all['album_id'];
        }

        $dir = 'images/' . Str::random() . '/';
        $absolutePath = public_path($dir);
        File::makeDirectory($absolutePath);

        if($image instanceof UploadedFile) {
            $data['name'] = $image->getClientOriginalName();
            $filename = pathinfo($data['name'], PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $originalPath = $absolutePath . $data['name'];

            $image->move($absolutePath, $data['name']);
        } else {
            $data['name'] = pathinfo($image, PATHINFO_BASENAME);
            $filename = pathinfo($image, PATHINFO_FILENAME);
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            $originalPath = $absolutePath . $data['name'];

            copy($image, $originalPath);
        }
        $data['path'] = $dir . $data['name'];


        $w = $all['w'];
        $h = $all['h'] ?? false;

        list($width, $height) = $this->getImageSize($originalPath, $w, $h);
    }


    /**
     * Display the specified resource.
     */
    public function show(ImageManipulation $imageManipulation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageManipulation $imageManipulation)
    {
        //
    }

    public function getImageSize (String $w, String $h, String $originalPath,) {
        
    }
}
