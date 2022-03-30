@extends('admin.layouts.masterAdmin')
@section('context')
    <div class="row row-sm">
        <div class="col-lg-12">
            @if (\Illuminate\Support\Facades\Session::has('slider-delete'))
                    <div class="alert alert-success text-center">
                        {{ session('slider-delete') }}
                    </div>
                @endif
            <div>
                <h5 class="main-content-label mb-1">جدول اسلایدر</h5>
                {{-- <p class="text-muted card-sub-title">برای فعال کردن حالت شناور در ردیف های جدول.</p> --}}
            </div>

            <div class="table-responsive border">
                <table class="table text-nowrap text-md-nowrap table-hover mg-b-0">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>متن</th>
                            <th>لینک</th>
                            <th>عکس</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key => $slider)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <span>
                                        {!! $slider->text !!}
                                    </span>
                                </td>
                                <td>{{ $slider->link }}</td>
                                <td>
                                    <img width="200px" src="{{ asset('photos/sliders/' . $slider->photo_path) }}"
                                        alt="slider_pic">
                                </td>
                                <td>
                                    <a href="{{ route('slider.edit',$slider->id) }}">ویرایش</a>
                                </td>
                                <td>
                                    <form action="{{ route('slider.destroy',$slider->id) }}" method="post">
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
