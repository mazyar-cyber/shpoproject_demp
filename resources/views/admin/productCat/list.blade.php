@extends('admin.layouts.masterAdmin')
@section('context')
    <div class="row row-sm">
        <div class="col-lg-12" id="app">
            @if (\Illuminate\Support\Facades\Session::has('productCat-delete'))
                <div class="alert alert-success text-center">
                    {{ session('productCat-delete') }}
                </div>
            @endif
            <div>
                <h5 class="main-content-label mb-1">جدول دسته بندی </h5>
            </div>


            <product-cat-list :cats="{{$cats}}"></product-cat-list>


        </div>
    </div>
@endsection
