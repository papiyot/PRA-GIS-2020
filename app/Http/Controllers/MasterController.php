<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public static function spliting($value){
        $set = explode(" ",$value);
        $hasil='';
        foreach ($set as $data){
            $hasil=$hasil.$data.'-';
        }
        return $hasil;
    }

    public static function upload( $file, $nama)
    {
        try{
            $file->move('upload/images',$nama);
            return true;
        }catch (\Throwable $th){
            return $th;
        }
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
        try{
            $delete_data = DB::table('locations')->where('locations_id', $id)->delete();
            return redirect()->route('locations.view')
                            ->with('success','Locations Deleted Successfully');
        }catch (\Throwable $th){
            return redirect()->route('locations.view')->withInput()
                            ->with('error','Locations Deleted Failingly');
        }
    }

    public function images_view( $id = null)
    {   
        $data =  new \stdClass();
        $data->action = 'Tambah';
        $data->class = 'block-mode-hidden';
        $data->edit = null;
        $data->list = DB::table('images')->join('locations', 'locations_id', '=', 'images_locations_id')->get();
        $data->select = DB::table('locations')->get();
        $data->count = count($data->list);
        if ($id != null) {
            $data->action = 'Edit';
            $data->class = '';
            $data->edit = DB::table('images')->where('images_id', $id)->first();
        }
        return view('pages.images',  compact('data'));
    }

    public function images_store( Request $request)
    {
        $message = ($request['images_id']) ? 'Images Updated' : 'Images Added' ;
        $images = DB::table('images')->orderby('images_id', 'desc')->first();
        $locations = DB::table('locations')->where('locations_id', $request->images_locations_id)->first();
        
        try{
            $num = ($images) ? $images->images_id+1 : 0 ;
            $namafile = (is_null($request->images_upload_name)) ? self::spliting($locations->locations_name).$num.'.jpg' : $request->images_upload_name ;
            $upload = ($request->image_upload) ? self::upload($request->image_upload, $namafile) : null;
            $save = [   
                'images_id' => ($request['images_id']) ? $request['images_id'] : null,
                'images_locations_id' => $request->images_locations_id,
                'images_name' => $namafile
            ];
            DB::table('images')->updateOrInsert(
                ['images_id' => $save['images_id']], $save );
            return redirect()->route('images.view')
                            ->with('success',$message.' Successfully');
        }catch (\Throwable $th){
            return $th;
            return redirect()->route('images.view')->withInput()
                            ->with('error',$message.' Failingly');
        }
        
    }


    public function images_delete( $id = null)
    {
        try{
            $delete_data = DB::table('images')->where('images_id', $id)->delete();
            return redirect()->route('images.view')
                            ->with('success','Images Deleted Successfully');
        }catch (\Throwable $th){
            return redirect()->route('images.view')->withInput()
                            ->with('error','Images Deleted Failingly');
        }
    }

    
}
