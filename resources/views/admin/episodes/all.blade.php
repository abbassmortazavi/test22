@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">
                    <a href="{{ route('episodes.create') }}" class="btn btn-primary">ایجاد ویدئو</a>
                </div>
                <h1 class="page-header float-right">ویدئو ها</h1>

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
                            <th> تعداد دانلود ها</th>
                            <th>وضعیت ویدئو</th>
                            <th> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($episodes as $episode)

                            <tr>
                                <td><a href="{{ $episode->title }}"></a>{{ $episode->title }}</td>
                                <td>{{ $episode->commentCount }}</td>
                                <td>{{ $episode->viewCount }}</td>
                                <td>{{ $episode->downloadCount }}</td>
                                <td>
                                    @if($episode->type == "free")
                                        رایگان
                                    @elseif($episode->type == "cash")
                                        نقدی
                                    @else
                                        ویژه
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('episodes.destroy',$episode->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('episodes.edit' , $episode->id) }}"
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
                {!! $episodes->render() !!}
            </div>

            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection

