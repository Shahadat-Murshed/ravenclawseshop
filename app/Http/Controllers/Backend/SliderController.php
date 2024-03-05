<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:2000'],
            'title' => ['required', 'max:200'],
            'sub_title' => ['required', 'max:200'],
            'btn_text' => ['max:200'],
            'btn_url' => ['required'],
            'serial' => ['integer', 'required'],
            'status' => ['required'],
        ]);

        $slider = new Slider();

        $imagePath = $this->uploadImage($request, 'banner', 'uploads/slider');
        $slider->banner = $imagePath;
        
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->btn_text = $request->btn_text;
        $slider->btn_url = $request->btn_url;        
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr('Slider Created Successfully', 'success');

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
        $slider = Slider::findorFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['nullable', 'image', 'max:2000'],
            'title' => ['required', 'max:200'],
            'sub_title' => ['required', 'max:200'],
            'btn_text' => ['max:200'],
            'btn_url' => ['required'],
            'serial' => ['integer', 'required'],
            'status' => ['required'],
        ]);

        $slider = Slider::findorFail($id);

        $imagePath = $this->updateImage($request, 'banner', 'uploads/slider', $slider->banner);
        
        if(!!$imagePath){
            $slider->banner = $imagePath;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->btn_text = $request->btn_text;
        $slider->btn_url = $request->btn_url;        
        $slider->serial = $request->serial;
        $slider->status = $request->status;
        $slider->save();

        toastr('Slider Updated Successfully', 'success');

        return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::findOrFail($id);
        $this->deleteImage($slider->banner);
        $slider->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request){
        
        $slider = Slider::findOrFail($request->id);
        $slider->status = $request->status == 'true' ? 1 : 0;
        $slider->save();

        return response(['message' => 'Status has been updated!']);
    }
}
