@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">
                    <div class="btn-group">
                        <a href="{{ route('courses.create') }}" class="btn btn-primary">ایجاد دوره</a>
                        <a href="{{ route('episodes.index') }}" class="btn btn-warning">ایجاد ویدئو</a>
                    </div>

                </div>
                <h1 class="page-header float-right">دوره ها</h1>

            </div>

            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th> عنوان دوره</th>
                            <th> تعداد نظرات</th>
                            <th> تعداد بازدید</th>
                            <th> تعداد شرکت کننده</th>
                            <th>وضعیت دوره</th>
                            <th> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)

                            <tr>
                                <td><a href="{{ $course->path() }}">{{ $course->title }}</a></td>
                                <td>{{ $course->commentCount }}</td>
                                <td>{{ $course->viewCount }}</td>
                                <td>1</td>
                                <td>
                                    @if($course->type == "free")
                                        رایگان
                                    @elseif($course->type == "cash")
                                        نقدی
                                    @else
                                        ویژه
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('courses.destroy',$course->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('courses.edit' , $course->id) }}"
                                               class="btn btn-primary">ویرایش</a>
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </div>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
            <div class="text-center">
                {!! $courses->render() !!}
            </div>

            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection

