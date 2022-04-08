@extends('admin.layouts.masterAdmin')
@section('context')
    <!-- Row -->
    <form action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row row-sm">
            <div class="col-sm-12">

                @if (\Illuminate\Support\Facades\Session::has('about-save'))
                    <div class="alert alert-success text-center">
                        {{ session('about-save') }}
                    </div>
                @endif

                <div class="card custom-card col-sm-12">
                    <div class="card-body">
                        <div>
                            <h5 class="main-content-label mb-1"> مقادیر زیر را وارد کنید</h5>
                        </div><br>
                        <div class="form-group">
                            <label>متن خود را اینجا بنویسید</label>
                            <textarea type="text" id="summernote" class="form-control input-lg" name="text"></textarea>
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
