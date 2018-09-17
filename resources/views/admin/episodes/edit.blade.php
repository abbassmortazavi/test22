@extends('admin.master')

@section('script')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {/// /admin/upload
            filebrowserUploadUrl: '/admin/panel/upload-image',
            filebrowserImageUploadUrl: '/admin/panel/upload-image',
        });
    </script>
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">

                </div>
                <h1 class="page-header float-right">ویرایش ویدئو</h1>

            </div>

            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <form name="campaignForm" action="{{ route('episodes.update' , $episode->id) }}" class="form-horizontal" method="post"
                      id="form-create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @include('admin.section.errors')
                    <div class="form-group">
                        <label for="title" class="control-label">عنوان ویدئو</label>
                        <input type="text" class="form-control" id="title" name="title"
                               placeholder="عنوان را وارد کنید..."
                               value="{{ $episode->title }}">
                    </div>

                    <div class="form-group">
                        <label for="course_id" class="control-label">دوره مرتبط</label>
                        <select class="form-control" id="course_id" name="course_id">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{  $course->id == $episode->course_id ? "selected" : "" }}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type" class="control-label">نوع ویدئو</label>
                        <select name="type" class="form-control">
                            <option value="vip" {{ $episode->type == "vip" ? "selected" : "" }}>ویژه</option>
                            <option value="cash" {{ $episode->type == "cash" ? "selected" : "" }}>نقدی</option>
                            <option value="free" {{ $episode->type == "free" ? "selected" : "" }}>رایگان</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description" class="control-label">متن</label>
                        <textarea rows="5" class="form-control" id="description" name="description"
                                  placeholder="متن را وارد کنید...">
                            {{ $episode->description }}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <div class="div col-sm-6">
                            <label for="time" class="control-label">زمان دوره</label>
                            <input type="text" class="form-control" name="time" id="time"
                                   placeholder="زمان را وارد کنید..." value="{{ $episode->time }}">
                        </div>

                        <div class="div col-sm-6">
                            <label for="number" class="control-label">شماره قسمت</label>
                            <input type="text" id="number" class="form-control" name="number"
                                   placeholder="لینک را وارد کنید..." value="{{ $episode->number }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="div col-sm-6">
                            <label for="tags" class="control-label">تگ ها</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                   placeholder="تگ هارو را وارد کنید..." value="{{ $episode->tags }}">
                        </div>

                        <div class="div col-sm-6">
                            <label for="videoUrl" class="control-label">لینک را وارد کنید</label>
                            <input type="text" id="videoUrl" class="form-control" name="videoUrl"
                                   placeholder="لینک را وارد کنید..." value="{{ $episode->videoUrl }}">
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