<!DOCTYPE html>
<html lang="en">
<head>
<base href="{{URL::asset('/')}}" target="_top"> 
  <link rel="stylesheet" href="{{{ URL::asset('css/bootstrap.min.css')}}}" />
  <link rel="stylesheet" href="{{{ URL::asset('font-awesome/4.2.0/css/font-awesome.min.css')}}}" />
  <link rel="stylesheet" href="{{{ URL::asset('css/theme.min.css') }}}" class="theme-stylesheet" id="theme-style" />
  <link rel="stylesheet" href="{{{ URL::asset('fonts/fonts.googleapis.com.css')}}}" />
  <script type="text/javascript" src="{{{ URL::asset('js/jquery.2.1.1.min.js')}}}"></script>
  <script src="{{{ URL::asset('js/bootstrap.min.js')}}}"></script>
  <script src="{{{ URL::asset('js/theme.min.js')}}}"></script>
</head>
<body class="no-skin">

@include('partials.header')
@include('partials.navbar')

<div class="main-container ace-save-state" id="main-container">

@include('partials.sidebar')

  <div class="main-content"> 
    <div class="main-content-inner">

    @yield('content') 

    </div>
  </div>

@include('partials.footer')

</div>

</body>
</html>