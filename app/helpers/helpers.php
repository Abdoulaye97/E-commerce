<?php

   function fullName()
   {
	return auth()->user()->prenom." ".auth()->user()->nom;
   }
