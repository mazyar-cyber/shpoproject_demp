@extends('frontEnd.layouts.master')
@section('context')
    <!-- //navigation -->

    <!-- banner-2 -->

    <!-- //banner-2 -->
    <!-- page -->
    <div class="services-breadcrumb">
        <div class="agile_inner_breadcrumb">
            <div class="container">
                <ul class="w3_short">
                    <li>
                        <a href="index.html">Home</a>
                        <i>|</i>
                    </li>
                    <li>Electronics</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- //page -->

    <!-- top Products -->
    <div class="ads-grid py-sm-5 py-4" id="app">
        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>M</span>obiles
                <span>&</span>
                <span>C</span>omputers
            </h3>
            <!-- //tittle heading -->
            <category-products :catid="{{ $id }}"></category-products>

        </div>
    </div>
    <!-- //top products -->
@endsection
