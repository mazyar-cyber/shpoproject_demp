<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCat;
use App\Models\Temp;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = ProductCat::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('cats', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        if (count($request->fileponds) < 3) {
            throw ValidationException::withMessages(['fileponds' => 'تعداد فایل های آپلودی شما باید 3 باشد']);
        }
        $model = new Product();
        $model->name = $request->name;
        $model->category_id = $request->selectedCatId;
        $model->text = $request->text;
        $model->price = $request->price;
        $model->discount_price = $request->discount_price;
        $file = $request->file('pic');
        $filename = time() . $file->getClientOriginalName();
        $request->file('pic')->move(public_path('photos/products/' . $request->name . '/'), $filename);


        $model->photo_path_1 = $request->fileponds[0];
        $model->photo_path_2 = $request->fileponds[1];
        $model->photo_path_3 = $request->fileponds[2];
        $model->photo_path = $filename;
        $model->save();
        //moving pictures:
        rename(
            public_path('photos/products/tmp/' . $model->photo_path_1),
            public_path("photos/products/" . $model->name . "/" . $model->photo_path_1)
        );
        rename(
            public_path('photos/products/tmp/' . $model->photo_path_2),
            public_path("photos/products/" . $model->name . "/" . $model->photo_path_2)
        );
        rename(
            public_path('photos/products/tmp/' . $model->photo_path_3),
            public_path("photos/products/" . $model->name . "/" . $model->photo_path_3)
        );
        \Illuminate\Support\Facades\Session::flash('product-save', "محصول ایجاد شد");
        return redirect()->back();
    }

    public function upload(Request $request)
    {
        $file = $request->file('fileponds');
        $filename = time() . "_" . $file[0]->getClientOriginalName();
        $file[0]->move(public_path('photos/products/tmp/'), $filename);
        //here we should create a model and save filename
        $model = new Temp();
        $model->filename = $filename;
        $model->save();
        return $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
