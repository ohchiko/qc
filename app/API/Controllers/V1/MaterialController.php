<?php

namespace App\API\Controllers\V1;

use App\Material;
use App\Http\Requests as R;
use App\API\Resources\V1\MaterialResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(R\ViewAllMaterials $request)
    {
        return MaterialResource::collection(Material::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(R\CreateMaterial $request)
    {
        return new MaterialResource($request->user()->materials()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(R\ViewMaterial $request, Material $material)
    {
        return new MaterialResource($material);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(R\UpdateMaterial $request, Material $material)
    {
        $material->update($request->validated());

        return new MaterialResource($material);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(R\DeleteMaterial $request, Material $material)
    {
        $material->delete();

        return response()->json([
            'message' => 'The resource deleted successfully.'
        ]);
    }
}
