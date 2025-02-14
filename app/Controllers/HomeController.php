<?php

namespace App\Controllers;
use App\Models\UserModel;


class HomeController
{
	 public function index()
	 {
		 return view("Backend/home");
	 }
}