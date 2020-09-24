<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Helpers\Helper;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function locations_view( $id = null)
    {   
        $data =  new \stdClass();
        $data->action = 'Tambah';
        $data->class = 'block-mode-hidden';
        $data->edit = null;
        $data->list = DB::table('locations')->get();
        $data->count = count($data->list);
        if ($id != null) {
            $data->action = 'Edit';
            $data->class = '';
            $data->edit = DB::table('locations')->where('locations_id', $id)->first();
        }
        return view('pages.locations',  compact('data'));
    }

    public function locations_store( Request $request)
    {
        $message = ($request['locations_id']) ? 'Locations Updated' : 'Locations Added' ;
        try{
            $save = DB::table('locations')->updateOrInsert(
                ['locations_id' => $request['locations_id']],
                $request->except('_token', )
            );
            return redirect()->route('locations.view')
                            ->with('success',$message.' Successfully');
        }catch (\Throwable $th){
            return redirect()->route('locations.view')->withInput()
                            ->with('error',$message.' Failingly');
        }
        
    }


    public function locations_delete( $id = null)
    {
        $field_id = $table . '_id';
        $delete_data = DB::table($table)->where($field_id, $id)->delete();
        return redirect('master/' . $table);
    }

    
}
