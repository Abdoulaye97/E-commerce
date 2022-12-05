<?php

use Illuminate\Support\Str;

  define('PAGELIST','liste_utilisateur');
  define('PAGEEDIT','update_utilisateur');
  define('PAGECREATE','editer_utilisateur');
   function fullName()
   {
	return auth()->user()->prenom." ".auth()->user()->nom;
   }
   function contains($container,$contenu)
   {
      return Str::contains($container,$contenu);
   }
   function setMenuClass($route,$class)
   {
      $routeActuel = request()->route()->getName();
      if(contains($routeActuel,$route))
      {
         return $class;
      }

   }
   function setMenuActive($route){
      $routeActuel = request()->route()->getName();
      if($routeActuel === $route)
      {
         return "active";
      }
      return "";
   }