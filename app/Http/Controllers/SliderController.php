<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;
use Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Slider::latest()->get();

        $page  = 'slider.list';
        $title = 'Age list';
        $data  = compact('page', 'title', 'lists');

        return view('backend.layout.master', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page  = 'slider.add';
        $title = 'Add Slider';
        $data  = compact('page', 'title');

        return view('backend.layout.master', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'record'        => 'required|array',
            'record.title'   => 'required|string'
        ];

        $messages = [
            'record.title'  => 'Please Enter Name.',
            'image'  => 'Please Select Image'
        ];

        $request->validate($rules, $messages);

        $record           = new Slider;
        $input            = $request->record;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizeImage->resize(1903, 523);
            $optimizePath = public_path() . '/images/slider/';
            $name = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $name, 72);
            $input['image'] = $name;
        }

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.slider.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.slider.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SliderSliderSlider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SliderSlider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Slider $slider)
    {
        $editData =  ['record' => $slider->toArray()];
        $request->replace($editData);
        $request->flash();

        // set page and title ------------------
        $page = 'slider.edit';
        $title = 'Edit Slider';
        $data = compact('page', 'title', 'slider');

        return view('backend.layout.master', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $record     = $slider;
        $input      = $request->record;

        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizeImage->resize(1903, 523);
            $optimizePath = public_path() . '/images/slider/';
            $name = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $name, 72);
            $input['image'] = $name;
        }

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.slider.index'))->with('success', 'Success! Record has been edided');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }
}
