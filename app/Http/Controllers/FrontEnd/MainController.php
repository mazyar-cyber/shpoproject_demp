<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Basket;
use App\Models\Product;
use App\Models\ProductCat;
use App\Models\Sliders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Sliders::all();
        $mainCats = ProductCat::where('branch_id', null)->get();
        return view('frontEnd.mainPage.index', compact('sliders', 'mainCats'));
    }


    public function indexAboutPage()
    {
        $aboutData = About::orderBy('created_at', 'desc')->first();
        return view('frontEnd.about.index', compact('aboutData'));
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
        //
    }

    public function register(Request $request)
    {
        // return $request->all();

        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->back();
    }

    public function showCheckOutPage()
    {
        $baskets = Basket::where('user_id', Auth::id())->get();
        return view('frontEnd.checkOut.index', compact('baskets'));
    }

    public function showSingleProductPage()
    {
        return view('frontEnd.singleProduct.index');
    }

    public function getBaskets()
    {
        return $baskets = Basket::where('user_id', Auth::id())->with('product')->get();
    }
    public function addProductToBasket($basketId)
    {
        $model = Basket::find($basketId);
        $model->qty++;
        $model->price = ($model->qty) * $model->product->price;
        $model->save();
        return 'ok';
    }
    public function mineProductToBasket($basketId)
    {
        $model = Basket::find($basketId);
        $model->qty--;
        if ($model->qty == 0) {
            return '0';
        }
        $model->price = ($model->qty) * $model->product->price;
        $model->save();
        return 'ok';
    }

    public function removeProductFromBasket($basketId)
    {
        $model = Basket::find($basketId)->delete();
        return 'ok';
    }
}
