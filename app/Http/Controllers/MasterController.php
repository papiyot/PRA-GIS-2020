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
        $field_id = $table . '_id';
        if (is_null($request[$field_id])) {
            $request->request->add([$field_id => Helper::getCode($table, $field_id, $code)]);
        }
        if (isset($request['pt_id'])) {
            $request->request->add(['pt_id' => Auth::user()->pt_id]);
        }
        if ($request[$table . '_nama'] != $request[$table . '_nama_old']) {
            $cek = DB::table($table)->where($table . '_nama', $request[$table . '_nama'])->count();
            if ($cek != 0) {
                return Redirect()->back()->withInput()->with('status', 'Data Sudah Ada');
            }
        }
        $save = DB::table($table)->updateOrInsert(
            [$field_id => $request[$field_id]],
            $request->except('_token', $table . '_nama_old')
        );
        return redirect('master/' . $table);
    }


    public function locations_delete( $id = null)
    {
        $field_id = $table . '_id';
        $delete_data = DB::table($table)->where($field_id, $id)->delete();
        return redirect('master/' . $table);
    }

    
}
