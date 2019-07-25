<?php

namespace App\API\Controllers\V1;

use App\Product;
use App\Http\Requests as R;
use App\API\Resources\V1\ProductResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(R\ViewAllProducts $request)
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(R\CreateProduct $request)
    {
        $product = $request->user()->products()->create($request->only(['name']));

        $product->materials()->attach($request->input(['materials']));

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(R\ViewProduct $request, Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(R\UpdateProduct $request, Product $product)
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(R\DeleteProduct $request, Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'The resource deleted successfully.'
        ]);
    }
}
