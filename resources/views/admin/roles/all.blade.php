@extends('admin.master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-header">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">ایجاد مقام</a>
                    <a href="{{ route('permissions.index') }}" class="btn btn-info">بخش دسترسی</a>
                </div>
                <h1 class="page-header float-right">مقام ها</h1>

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
                            <th>نام مقام</th>
                            <th>توضیحات</th>
                            <th> تنظیمات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)

                            <tr>
                                <td><a href="{{ $role->name }}"></a>{{ $role->name }}</td>
                                <td>{{ $role->label }}</td>
                                <td>
                                    <form action="{{ route('roles.destroy',$role->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs">
                                            <a href="{{ route('roles.edit' , $role->id) }}"
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
                {!! $roles->render() !!}
            </div>

            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection

