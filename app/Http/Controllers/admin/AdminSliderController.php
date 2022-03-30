<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Sliders::all();
        return view('admin.slider.list', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Sliders();
        $model->text = $request->text;
        $model->link = $request->link;
        //uploading part
        $file = $request->file('pic');
        $filename = time() . $file->getClientOriginalName();

        $request->file('pic')->move(public_path('photos/sliders/'), $filename);

        // file_put_contents(public_path('photos/sliders/') . $filename, $file);
        $model->photo_path = $filename;
        //end uploading part
        $model->save();
        \Illuminate\Support\Facades\Session::flash('slider-save', "اسلایدر ذخیره شد");
        return redirect()->back();
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Sliders::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->file('pic'));
        $model = Sliders::find($id);
        $model->text = $request->text;
        $model->link = $request->link;
        //uploading part
        if ($request->file('pic') != null) {
            //delete last file
            unlink(public_path('photos/sliders/'.$model->photo_path));
            $file = $request->file('pic');
            $filename = time() . $file->getClientOriginalName();

            $request->file('pic')->move(public_path('photos/sliders/'), $filename);

            // file_put_contents(public_path('photos/sliders/') . $filename, $file);
            $model->photo_path = $filename;
        }

        //end uploading part
        $model->save();
        \Illuminate\Support\Facades\Session::flash('slider-update', "اسلایدر ویرایش شد");
        return redirect()->back();
        // return $request->all();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Sliders::find($id);
        //delete pic
        @unlink(public_path('photos\sliders\\') . $model->photo_path);
        $model->delete();
        \Illuminate\Support\Facades\Session::flash('slider-delete', "اسلایدر حذف شد");
        return redirect()->back();
    }
}
