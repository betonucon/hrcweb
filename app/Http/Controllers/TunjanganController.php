<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Jabatan;
use App\App\Models\Tunjangan;

class TunjanganController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('tunjangan.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Jabatan::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='disabled';
        }
        return view('tunjangan.create',compact('template','data','disabled','id'));
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        $data = Jabatan::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group" style="padding:0px">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('master/tunjangan/create?id='.$row->id).'`)"><i class="fas fa-cog text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            ->addColumn('total_tunjangan', function ($row) {
                return uang(sum_tunjangan($row->id));
            })
            ->addColumn('total_kontribusi', function ($row) {
                return uang(sum_kontribusi($row->id));
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_data_tunjangan(request $request)
    {
        error_reporting(0);
        $data = Tunjangan::where('jabatan_id',$request->id)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group" style="padding:0px">
                        <span class="btn btn-white btn-xs" onclick="add_modal('.$row->id.')"><i class="fas fa-cog text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            ->addColumn('kategori', function ($row) {
                return $row->mkategoritunjangan['kategori_tunjangan'];
            })
            ->addColumn('nominal', function ($row) {
                return uang($row->nilai);
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function modal(request $request)
    {
        error_reporting(0);
        $id=$request->id;
        $data=Tunjangan::where('id',$request->id)->first();
        // dd($data->kategori_tunjangan_id);
        return view('tunjangan.modal',compact('data','id'));
    }

    public function delete_data(request $request){
        $data = Jabatan::where('id',$request->id)->update(['aktif'=>0]);
    }

   
    public function store(request $request){
        // error_reporting(0);
        $rules = [];
        $messages = [];
       
        $rules['tunjangan']= 'required';
        $messages['tunjangan.required']= 'Lengkapi kolom tunjangan';
        $rules['kategori_tunjangan_id']= 'required';
        $messages['kategori_tunjangan_id.required']= 'Lengkapi kolom kategori_tunjangan';
        $rules['nilai']= 'required';
        $messages['nilai.required']= 'Lengkapi kolom nilai';
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            if($request->id==0){
                
                $data=Tunjangan::create([
                    'tunjangan'=>$request->tunjangan,
                    'jabatan_id'=>$request->jabatan_id,
                    'kategori_tunjangan_id'=>$request->kategori_tunjangan_id,
                    'nilai'=>ubah_uang($request->nilai),
                ]);

                echo'@ok';
                
            }else{
                $data=Tunjangan::where('id',$request->id)->update([
                    'tunjangan'=>$request->tunjangan,
                    'jabatan_id'=>$request->jabatan_id,
                    'kategori_tunjangan_id'=>$request->kategori_tunjangan_id,
                    'nilai'=>ubah_uang($request->nilai),
                ]);

                echo'@ok';
            }
        }
    }
}
