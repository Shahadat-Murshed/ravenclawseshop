<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProductVariantDataTable $dataTable)
    {
        $heading = 'All Items';
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        // $products = Product::all();
        return view('admin.product-variants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product' => ['required',],
            'category' => ['required',],
            'unit' => ['required'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'price_rm' => ['nullable'],
            'discount_price_rm' => ['nullable'],
            'in_stock' => ['required'],            
            'status' => ['required'],
        ]);

        $product_variant = new ProductVariant();

        $product_variant->product_id = $request->product;
        $product_variant->category_id = $request->category;
        $product_variant->unit = $request->unit;
        $product_variant->price = $request->price;
        $product_variant->discount_price = $request->discount_price;
        $product_variant->price_rm = $request->price_rm;
        $product_variant->discount_price_rm = $request->discount_price_rm;
        $product_variant->in_stock = $request->in_stock;
        $product_variant->status = $request->status;

        $product_variant->save();

        toastr('Created Successfully', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_variant = ProductVariant::findorFail($id);
        $categories = Category::all();
        $products = Product::where('category_id', $product_variant->category_id)->get();

        return view('admin.product-variants.edit', compact('products', 'categories', 'product_variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'product' => ['required',],
            'category' => ['required',],
            'unit' => ['required'],
            'price' => ['required'],
            'discount_price' => ['nullable'],
            'price_rm' => ['nullable'],
            'discount_price_rm' => ['nullable'],
            'in_stock' => ['required'],            
            'status' => ['required'],
        ]);

        $product_variant = ProductVariant::findorFail($id);

        $product_variant->product_id = $request->product;
        $product_variant->category_id = $request->category;
        $product_variant->unit = $request->unit;
        $product_variant->price = $request->price;
        $product_variant->discount_price = $request->discount_price;
        $product_variant->price_rm = $request->price_rm;
        $product_variant->discount_price_rm = $request->discount_price_rm;
        $product_variant->in_stock = $request->in_stock;
        $product_variant->status = $request->status;

        $product_variant->save();

        toastr('Updated Successfully', 'success');

        return redirect()->route('admin.products-variants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $product_variant = ProductVariant::findOrFail($id);
        $product_variant->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $product_variant = ProductVariant::findOrFail($request->id);
        $product_variant->status = $request->status == 'true' ? 1 : 0;
        $product_variant->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function changeStock(Request $request)
    {
        $product_variant = ProductVariant::findOrFail($request->id);
        $product_variant->in_stock = $request->in_stock == 'true' ? 1 : 0;
        $product_variant->save();

        return response(['message' => 'Stock has been updated!']);
    }

    public function getProducts(Request $request)
    {
        $products = Product::where('category_id', $request->id)->get();

        return $products;
    }

    public function pcGames(ProductVariantDataTable $dataTable){
        $heading = 'All PC Games Items';
        $category = 1;
        $dataTable->setCategory($category);
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }

    public function mobileGames(ProductVariantDataTable $dataTable){
        $heading = 'All Mobile Games Items';
        $category = 2;
        $dataTable->setCategory($category);
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }

    public function giftCards(ProductVariantDataTable $dataTable){
        $heading = 'All Gift Cards Items';
        $category = 3;
        $dataTable->setCategory($category);
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }
    
    public function subscriptions(ProductVariantDataTable $dataTable){
        $heading = 'All Subscription Items';
        $category = 4;
        $dataTable->setCategory($category);
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }


    public function productVariants(ProductVariantDataTable $dataTable, string $slug){
        $product = Product::where('slug', $slug)->first();
        $heading = $product->name;
        $product = $product->id;
        $dataTable->setProduct($product);
        return $dataTable->render('admin.product-variants.index', compact('heading'));
    }
}
