<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Jabatan;
use App\Models\Sertifikat;

class JabatanController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('jabatan.index',compact('template'));
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
        return view('jabatan.create',compact('template','data','disabled','id'));
    }
    public function get_data(request $request)
    {
        error_reporting(0);
        $data = Jabatan::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-white btn-sm" onclick="location.assign(`'.url('master/jabatan/create?id='.$row->id).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                        <span class="btn btn-white btn-sm"  onclick="delete_data('.$row['id'].')"><i class="fas fa-trash text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete_data(request $request){
        $data = Jabatan::where('id',$request->id)->update(['aktif'=>0]);
    }

   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['jabatan']= 'required';
        $messages['jabatan.required']= 'Lengkapi kolom jabatan';
       
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
                
                $data=Jabatan::create([
                    'jabatan'=>$request->jabatan,
                    'aktif'=>1,
                ]);

                echo'@ok';
                
            }else{
                $data=Jabatan::where('id',$request->id)->update([
                    'jabatan'=>$request->jabatan,
                ]);

                echo'@ok';
            }
        }
    }
}
