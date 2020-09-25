<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data =  new \stdClass();
        $data->locations = DB::table('locations')->get();
        $data->images = DB::table('images')->get();
        // return response()->json($data,200);
        return view('pages.map',  compact('data'));
    }
}
