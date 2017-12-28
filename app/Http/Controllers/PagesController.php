<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index', 'about','services']]);
    }

    public function index()
    {
        return view('pages.index');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        $services =['Web Design','Web Development','Programming'];
        return view('pages.services',compact('services'));
    }


}
