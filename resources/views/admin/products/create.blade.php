@extends('admin.layouts.masterAdmin')
@section('context')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-sm-12">

            @if (\Illuminate\Support\Facades\Session::has('product-save'))
                <div class="alert alert-success text-center">
                    {{ session('product-save') }}
                </div>
            @endif

            <div class="card custom-card col-sm-12">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div>
                            <h5 class="main-content-label mb-1"> مقادیر زیر را وارد کنید</h5>
                        </div><br>
                        <div class="form-group">
                            <label>نام محصول</label>
                            <input type="text" name="name" class="form-control input-lg" required>
                        </div>
                        <div class="form-group">
                            <label>دسته بندی</label>
                            <select name="selectedCatId" class="form-control" required>
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>برند</label>
                            <select name="selectedBrandId" class="form-control" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>توضیحات</label>
                            <textarea id="summernote" class="form-control input-lg" name="text" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>قیمت</label>
                            <input type="number" class="form-control input-lg" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>تخفیف</label>
                            <input type="number" class="form-control input-lg" name="discount_price" required>
                        </div>
                        <div class="form-group">
                            <label>عکس صفحه اصلی</label>
                            <input type="file" class="form-control input-lg" name="pic" required>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {{-- <input type="file" id="demo" type="file"  name="files"
                                    accept=".jpg, .png, image/jpeg, image/png, " multiple  data-allow-reorder="true"
                                    data-max-file-size="3MB" data-max-files="3"> --}}

                                <input type="file" class="filepond" name="fileponds[]" multiple
                                    data-max-file-size="3MB" data-max-files="3" accept="image/png, image/jpeg" />
                                @error('fileponds')
                                    <span class="col-sm-12  alert alert-danger text-center">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-control">
                            <input type="submit" value="ذخیره" class="btn btn-primary col-sm-12">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
    <script>
        $('.dropify').dropify();
    </script>
    <script>
        // FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize);
        FilePond.parse(document.body);
        FilePond.setOptions({
            server: {
                url: '/admin/storeProductUpload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }

        });
    </script>
@endsection
