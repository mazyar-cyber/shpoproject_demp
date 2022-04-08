<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use Illuminate\Http\Request;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = ProductCat::all();
        return view('admin.productCat.list', compact('cats'));
    }

    public function getData()
    {
        return $cats = ProductCat::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = ProductCat::all();
        return view('admin.productCat.create', compact('cats'));
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
        $model = new ProductCat();
        $model->name = $request->name;
        $model->description = $request->text;

        if ($request->branchId != "main") {
            $model->branch_id = $request->branchId;
        }

        $model->save();
        \Illuminate\Support\Facades\Session::flash('cat-save', "دسته بندی ایجاد شد");
        return redirect()->back();
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
        $model = ProductCat::find($id)->delete();
        return 'ok';
    }
    public function editName(Request $request, $catId)
    {
        // return [$catId, $request->all()];
        $model = ProductCat::find($catId);
        $model->name = $request->name;
        $model->save();
        return 'ok';
    }
}
