<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // here we need to take data from the database 
        $title = "LMS system with Auth APIs";
        $metaTag = [
            ["name" => "foo","content" => "foo contant"],
            ["name" => "bar", "content" => "bar contant"],
            ["name" => "blog", "content" => "blog contant"]
        ];
        return view('home', compact("title", 'metaTag'));
    }
}
