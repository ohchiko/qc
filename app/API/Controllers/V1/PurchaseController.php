<?php

namespace App\API\Controllers\V1;

use App\Purchase;
use App\API\Resources\V1\PurchaseResource;
use App\Http\Requests\ViewAllPurchases;
use App\Http\Requests\ViewPurchase;
use App\Http\Requests\CreatePurchase;
use App\Http\Requests\UpdatePurchase;
use App\Http\Requests\DeletePurchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAllPurchases $request)
    {
        return PurchaseResource::collection(Purchase::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchase $request)
    {
        return new PurchaseResource($request->user()->purchases()->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ViewPurchase $request, Purchase $purchase)
    {
        return new PurchaseResource($purchase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchase $request, Purchase $purchase)
    {
        $purchase->update($request->validated());

        return new PurchaseResource($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeletePurchase $request, Purchase $purchase)
    {
        $purchase->delete();

        return response()->json([
            'message' => 'The resource deleted successfully.'
        ]);
    }
}
