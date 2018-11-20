<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function __Construct()
	{
		/* $this->middleware->auth(); */
			$this->middleware('auth');
	}
	public function index()
	{
		return view('adminpages.dashboard.index');
	}
}
