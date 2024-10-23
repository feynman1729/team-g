<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Tweet::with(['user', 'liked'])->latest()->get();
        // dd($tweets);
        return view('tweets.index', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // もしLocationがnullだったら、新しくリソースを作成
        if (is_null($request->location)) {
            $store = Store::create([
                'name' => $request->name,
                'location' => $request->location,
                'store_id' => join('-', [$request->location[0], $request->location[1]]) // locationをstore_idに変換
            ]);
        }
        return redirect()->route('{-- ルートの実装予定 --}');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
