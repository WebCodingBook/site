<?php

namespace WebCoding\Http\Controllers;

use Illuminate\Http\Request;
use WebCoding\Http\Requests;
use WebCoding\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('pages.front');
    }

    public function contact()
    {

    }

}
