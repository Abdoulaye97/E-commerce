<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Section Informatique</title>
 <link rel="stylesheet" href="{{mix('css/app.css')}}">
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
 @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Topnav -->
 <x-Topnav /> 
<!-- /Topnav -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

<a href="#" class="brand-link">
<span class="brand-text font-weight-light">Section Informatique</span>
</a>

<div class="sidebar">

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
<div class="image">
<img src="" class="img-circle elevation-2" alt="User Image">
</div>
<div class="info">

</div> 
</div>
<!-- Menu -->
 <x-menu/> 
<!--  -->
</div>

</aside>

<div class="content-wrapper">

  @yield('contenu')

<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-6">
</div>
</div>
</div>
</div>
</div>

<!-- Aside -->

<x-aside-bar /> 
<!--  -->

<footer class="main-footer">

 <div class="float-right d-none d-sm-inline">
</div> 

<strong style="text-align:center;">Copyright &copy; 2021-2022 <a href="https://adminlte.io">Abdoulaye Diaw</a>.</strong> All rights reserved.
</footer>
</div>
   
      <script src="{{mix('js/app.js')}}"></script>
     @livewireScripts
</body>
</html>