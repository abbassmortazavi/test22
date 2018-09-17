@extends('admin.master')

@section('script')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body' , {/// /admin/upload
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image',
        });
    </script>
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">

                </div>
                <h1 class="page-header float-right">ویرایش دوره</h1>

            </div>

            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <form name="campaignForm" action="{{ route('courses.update' , $course->id) }}" class="form-horizontal" method="post"
                      id="form-create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @include('admin.section.errors')
                    <div class="form-group">
                        <label for="title" class="control-label">عنوان دوره</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="عنوان را وارد کنید..."
                               value="{{ $course->title }}">
                    </div>

                    <div class="form-group">
                        <label for="price" class="control-label">قیمت دوره</label>
                        <input type="text" class="form-control" id="price" name="price"
                               placeholder="قیمت را وارد کنید..."
                               value="{{ $course->price }}">
                    </div>

                    <div class="form-group">
                        <label for="type" class="control-label">نوع دوره</label>
                        <select name="type" class="form-control">
                            <option value="vip" {{ $course->type == "vip" ? "selected" : "" }}>ویژه</option>
                            <option value="cash" {{ $course->type == "cash" ? "selected" : "" }}>نقدی</option>
                            <option value="free" {{ $course->type == "free" ? "selected" : "" }}>رایگان</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="body" class="control-label">متن</label>
                        <textarea rows="5" class="form-control" id="body" name="body" placeholder="متن را وارد کنید...">
                            {{ $course->body }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <div class="div col-sm-12">
                            <label for="tags" class="control-label">تگ ها</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                   placeholder="تگ هارو را وارد کنید..." value="{{ $course->tags }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="div col-sm-12">
                            <label for="images" class="control-label">تصویر مقاله</label>
                            <input type="file" id="images" class="form-control" name="images"
                                   placeholder="تصویر را وارد کنید..." value="{{ old('images') }}">
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="row">
                                    @foreach($course->images['images'] as $key => $image)
                                        <div class="col-sm-2">
                                            <label class="control-label">
                                                {{ $key }}
                                                <input type="radio" name="thumb" value="{{ $image }}" {{ $course->images['thumb'] == $image ? 'checked' : '' }}>
                                                <a href="{{asset($image) }}" target="_blank"><img src="{{asset($image) }}" width="100%"> </a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button id="send" type="submit" class="btn btn-warning">ارسال مقاله</button>
                    </div>

                </form>
            </div>
            <!-- /.col-lg-12 -->

            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection
@section('script')
    {{--<script>
        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#send").click(function (e) {

            e.preventDefault();

            var form = document.forms.namedItem("campaignForm"); // high importance!, here you need change "yourformname" with the name of your form
            var formData = new FormData(form); // $('form')[0] high importance!

            $.ajax({
                type: 'post',
                url: "{{ route('articles.store') }}",
                //dataType: "json", // or html if you want...
                contentType: false, // high importance!
                data: formData, // high importance!
                processData: false, // high importance!
                success: function (data) {
                    //console.log(data);
                    alert(data.success);

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });



    </script>--}}


@endsection