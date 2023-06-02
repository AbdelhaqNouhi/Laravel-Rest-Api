<?php

namespace App\Http\Controllers\V1;

use App\Models\Album;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Http\Resources\V1\AlbumResource;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = AlbumResource::collection(Album::paginate());
        return $albums;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $albums = Album::create($request->all());
        return $albums;
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album = Album::find($album);
        return $album;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $album->update($request->all());
        return $album;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return response(204);
    }
}
