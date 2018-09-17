<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <title>وب سایت آموزشی لاراول</title>

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- not use this in ltr -->
    <link href="/css/bootstrap.rtl.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/css/fontiran.css" rel="stylesheet" type="text/css">


</head>

<body>
@include('admin.section.header')

    @yield('content')

@include('admin.section.footer')

</body>

</html>
