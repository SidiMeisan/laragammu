<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function __construct() {
		$this->middleware('webAuth');
	}

    public function index() {
    	return view('dashboard')->withTitle('Selamat datang di dashboard');
    }
}
