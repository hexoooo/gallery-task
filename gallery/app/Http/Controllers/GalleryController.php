<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use App\Http\Services\Dashboard\Gallery\GalleryService;

class GalleryController extends Controller 
{
    public function __construct( private readonly GalleryService $gallery_service)
    {
        
    }
    public function index()
    {
        return $this->gallery_service->index();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(GalleryRequest $request)
    {
        return $this->gallery_service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

        return $this->gallery_service->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, GalleryRequest $request)
    {
        return $this->gallery_service->update( $request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return $this->gallery_service->destroy($id);
    }
}
