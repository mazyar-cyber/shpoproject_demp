@extends('frontEnd.layouts.master')
@section('context')
    <!-- checkout page -->
    <div class="privacy py-sm-5 py-4" id="app">
        @if (\Illuminate\Support\Facades\Session::has('payment-success'))
            <div class="alert alert-success text-center">
                {{ session('payment-success') }}
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('payment-error'))
            <div class="alert alert-danger text-center">
                {{ session('payment-error') }}
            </div>
        @endif

        <div class="container py-xl-4 py-lg-2">
            <!-- tittle heading -->
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
                <span>C</span>heckout
            </h3>
            <!-- //tittle heading -->
            <div class="checkout-right">
                {{-- <h4 class="mb-sm-4 mb-3">Your shopping cart contains:
                    <span>{{ count($baskets) }} Products</span>
                </h4> --}}

                <basket-table></basket-table>

            </div>
            <div class="checkout-left">
                <div class="address_form_agile mt-sm-5 mt-4">
                    <form action="{{ url('order') }}" method="POST">
                        @csrf
                        <div class="checkout-right-basket">
                            <input type="hidden" name="amount" value="12000">
                            <button class="btn">Make a Payment
                                <span class="far fa-hand-point-right"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //checkout page -->
@endsection
