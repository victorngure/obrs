<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <title>OBRS</title>

    <link href="{{ asset('//use.fontawesome.com/releases/v5.7.2/css/all.css') }}" rel="stylesheet" 
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <link href="{{ asset('//fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}" rel="stylesheet">

    <link href="/public/css/sb-admin-2.css" rel="stylesheet">

    <link href="{{ asset('//cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css') }}" rel="stylesheet">

    <link href="//cdn.datatables.net/responsive/2.1.1/css/dataTables.responsive.css" />

    <link href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap2.min.css" rel="stylesheet">

    <link href="/public//css/style.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div id="wrapper">
            @include('layouts.partials._navigation')       
            @yield('content')    
        </div>
        @include('layouts.partials._footer')
    </div>
</body>
</html>