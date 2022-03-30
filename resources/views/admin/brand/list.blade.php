@extends('admin.layouts.masterAdmin')
@section('context')
    <div class="row row-sm">
        <div class="col-lg-12">
            @if (\Illuminate\Support\Facades\Session::has('brand-delete'))
                <div class="alert alert-success text-center">
                    {{ session('brand-delete') }}
                </div>
            @endif
            <div>
                <h5 class="main-content-label mb-1">جدول برند</h5>
            </div>

            <div class="table-responsive border">
                <table class="table text-nowrap text-md-nowrap table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>توضیحات</th>
                            <th>عکس</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <span>
                                        {!! $brand->name !!}
                                    </span>
                                </td>
                                <td>{!! $brand->text !!} </td>
                                <td>
                                    <img width="200px"
                                        src="{{ asset('photos/brands/' . $brand->name . '/' . $brand->photo_path) }}"
                                        alt="brand_pic">
                                </td>
                                <td>
                                    <a href="{{ route('brand.edit', $brand->id) }}">ویرایش</a>
                                </td>
                                <td>
                                    <form action="{{ route('brand.destroy', $brand->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" class="btn btn-danger" value="حذف">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
