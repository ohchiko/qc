<?php

namespace App\API\Controllers\V1;

use App\Work;
use App\API\Resources\V1\WorkResource;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\ViewAllWorks $request)
    {
        return WorkResource::collection(Work::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateWork $request)
    {
        return new WorkResource($request->user()->works()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Requests\ViewWork $request, Work $work)
    {
        return new WorkResource($work);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateWork $request, Work $work)
    {
        $work->update($request->validated());

        return new WorkResource($work);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\DeleteWork $request, Work $work)
    {
        $work->delete();

        return response()->json([
            'message' => 'The resource deleted successfully.'
        ]);
    }
}
