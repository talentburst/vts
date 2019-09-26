<!DOCTYPE html>
<html lang="en">
<head>
<base href="{{URL::asset('/')}}" target="_top"> 

<link rel="stylesheet" href="{{{ URL::asset('assets/css/bootstrap.min.css')}}}" />
<link rel="stylesheet" href="{{{ URL::asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}}" />
<link rel="stylesheet" href="{{{ URL::asset('assets/css/fonts.googleapis.com.css')}}}" />
<link rel="stylesheet" href="{{{ URL::asset('assets/css/ace.min.css')}}}" />
<script src="{{{ URL::asset('assets/js/jquery-2.1.4.min.js')}}}"></script>  
 
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