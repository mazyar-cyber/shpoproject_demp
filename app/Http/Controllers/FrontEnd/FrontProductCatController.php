<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('frontEnd.CategoryProducts.index', compact('id'));
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

    public function getCatProducts(Request $request, $catId)
    {
        if ($request->sortingElement == "") {
            if (count($request->selectedBrands) == 0) {
                return $products = Product::where('category_id', $catId)->with('category')->paginate(3);
            } else {
                return $products = Product::where('category_id', $catId)->whereIn('brand_id', $request->selectedBrands)->with('category')->paginate(3);
            }
        } else {
            if (count($request->selectedBrands) == 0) {
                return $products = Product::where('category_id', $catId)->orderBy($request->sortingElement, $request->ordering)->with('category')->paginate(3);
            } else {
                return $products = Product::where('category_id', $catId)->orderBy($request->sortingElement, $request->ordering)->whereIn('brand_id', $request->selectedBrands)->with('category')->paginate(3);
            }
        }
    }
    public function getBrands()
    {
        return $brands = Brand::all();
    }
    public function addProductToBasket($productId)
    {

        if (!Auth::check()) {
            return 'unAuthorized';
        }
        if (count(Basket::where('user_id', Auth::id())->where('product_id', $productId)->get()) > 0) {
            $model = Basket::where('user_id', Auth::id())->where('product_id', $productId)->first();
            $model->qty++;
            $model->price = ($model->qty) * Product::find($productId)->price;
            $model->save();
        } else {

            $model = new Basket();
            $model->product_id = $productId;
            $model->user_id = Auth::id();
            $model->price = Product::find($productId)->price;
            $model->save();
        }
    }
}
