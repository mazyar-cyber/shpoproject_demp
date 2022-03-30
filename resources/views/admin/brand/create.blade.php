@extends('admin.layouts.masterAdmin')
@section('context')
    <!-- Row -->
    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row row-sm">
            <div class="col-sm-12">

                @if (\Illuminate\Support\Facades\Session::has('brand-save'))
                    <div class="alert alert-success text-center">
                        {{ session('brand-save') }}
                    </div>
                @endif

                <div class="card custom-card col-sm-12">
                    <div class="card-body">
                        <div>
                            <h5 class="main-content-label mb-1"> مقادیر زیر را وارد کنید</h5>
                        </div><br>
                        <div class="form-group">
                            <label>نام برند</label>
                            <input type="text" class="form-control input-lg" name="name">
                        </div>
                        <div class="form-group">
                            <label>متن </label>
                            <textarea name="text" id="summernote" class="form-control input-lg"></textarea>
                        </div>
                        <div class="form-group">
                            <label>عکس</label>
                            <input type="file" class="form-control" name="pic">
                        </div>
                        <div class="form-control">
                            <input type="submit" value="ارسال" class="btn btn-primary col-sm-12">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
    <!-- End Row -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
