<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        $heading = 'All Products';
        return $dataTable->render('admin.product.index', compact('heading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        
        $request->validate([
            'icon' => ['required', 'image'],
            'cover_image' => ['required', 'image'],
            'thumb_image' => ['required', 'image'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'description' => ['required'],
            'how_to_order' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:260'],
            'status' => ['required'],
            'ign_required' => ['required'],
            'region_required' => ['required'],
            'pass_required' => ['required'],
            'ign_type' => ['nullable'],
            'ign_example' => ['nullable'],
            'region_type' => ['nullable'],
            'password_type' => ['nullable'],
        ]);

        /** Handle Image Uploads **/
        $iconPath = $this->uploadImage($request, 'icon', 'uploads/products/icons');
        $coverPath = $this->uploadImage($request, 'cover_image', 'uploads/products/covers');
        $thumbPath = $this->uploadImage($request, 'thumb_image', 'uploads/products/thumbnails');

        $product = new Product();
        
        $product->icon = $iconPath;
        $product->cover_image = $coverPath;
        $product->thumb_image = $thumbPath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->how_to_order = $request->how_to_order;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->ign_required = $request->ign_required;
        $product->region_required = $request->region_required;
        $product->pass_required = $request->pass_required;
        $product->ign_type = $request->ign_type;
        $product->ign_example = $request->ign_example;
        $product->region_type = $request->region_type;
        $product->password_type = $request->password_type;

        $product->save();

        toastr('Product Created Successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorFail($id);
        return view('admin.product.show', compact('product',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findorFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'icon' => ['nullable', 'image'],
            'cover_image' => ['nullable', 'image'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'description' => ['required'],
            'how_to_order' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:260'],
            'status' => ['required'],
            'ign_required' => ['required'],
            'region_required' => ['required'],
            'pass_required' => ['required'],
            'ign_type' => ['nullable'],
            'ign_example' => ['nullable'],
            'region_type' => ['nullable'],
            'password_type' => ['nullable'],
        ]);

        $product = Product::findorFail($id);

        /** Handling Image Update **/
        $iconPath = $this->updateImage($request, 'icon', 'uploads/products/icons', $product->icon);
        $coverPath = $this->updateImage($request, 'cover_image', 'uploads/products/covers', $product->cover_image);
        $thumbPath = $this->updateImage($request, 'thumb_image', 'uploads/products/thumbnails', $product->thumb_image);

        $product->icon = empty(!$iconPath) ? $iconPath : $product->icon;
        $product->cover_image = empty(!$coverPath) ? $coverPath : $product->cover_image;
        $product->thumb_image = empty(!$thumbPath) ? $thumbPath : $product->thumb_image;


        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->how_to_order = $request->how_to_order;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->status = $request->status;
        $product->ign_required = $request->ign_required;
        $product->region_required = $request->region_required;
        $product->pass_required = $request->pass_required;
        $product->ign_type = $request->ign_type;
        $product->ign_example = $request->ign_example;
        $product->region_type = $request->region_type;
        $product->password_type = $request->password_type;
        $product->save();

        toastr('Product Updated Successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        // if(OrderProduct::where('product_id',$product->id)->count() > 0){
        //     return response(['status' => 'error', 'message' => 'This product have orders can\'t delete it.']);
        // }

        /** Delte the main product image */
        $this->deleteImage($product->icon);
        $this->deleteImage($product->cover_image);
        $this->deleteImage($product->thumb_image);
        
        /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function products(ProductDataTable $dataTable, string $category){
        $product_category = category::where('slug', $category)->first();
        $heading = 'All '.$product_category->name;
        $category = $product_category->id;
        $dataTable->setCategory($category);
        return $dataTable->render('admin.product.index', compact('heading'));
    }
}