<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    
    <title> @yield('pageTitle','Control Loayza') </title>

    <link rel="shortcut icon" type="image/png" href="{{asset('src/assets/img/logo/logo.png')}}"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/notiflix/css/notiflix-3.2.5.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/jquery/jquery-ui.min.css')}}">

    @if (isset($styles))
        @foreach ($styles as $style)
            <link rel="stylesheet" href="{{asset($style)}}">
        @endforeach
    @endif

</head>