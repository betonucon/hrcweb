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
use App\Models\Unit;

class UnitController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('unit.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Unit::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='disabled';
        }
        return view('unit.create',compact('template','data','disabled','id'));
    }
    public function get_data(request $request)
    {
        error_reporting(0);
        $data = Unit::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tingkatanunit', function ($row) {
                return $row->mtingkatunit['tingkatan'];
            })
            ->addColumn('pimpinan', function ($row) {
                return '['.$row->nik_atasan.'] '.$row->memploye['nama'];
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-white btn-sm" onclick="location.assign(`'.url('master/unit/create?id='.$row->id).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                        <span class="btn btn-white btn-sm"  onclick="delete_data('.$row['id'].')"><i class="fas fa-trash text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete_data(request $request){
        $data = Unit::where('id',$request->id)->update(['aktif'=>0]);
    }

   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        if($request->id==0){
            $rules['kode_unit']= 'required|unique:m_unit';
            $messages['kode_unit.required']= 'Lengkapi kolom kode unit';
        }
        
        
        $rules['singkatan']= 'required';
        $messages['singkatan.required']= 'Lengkapi kolom singkatan';
        
        $rules['nama_unit']= 'required';
        $messages['nama_unit.required']= 'Lengkapi kolom nama unit';
        
        $rules['tingkatan_unit_id']= 'required';
        $messages['tingkatan_unit_id.required']= 'Lengkapi kolom kategori';
        
        $rules['nik_atasan']= 'required';
        $messages['nik_atasan.required']= 'Pilih pimpinan';
       
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
                $data=Unit::create(
                    [
                        'kode_unit'=>$request->kode_unit,
                        'singkatan'=>$request->singkatan,
                        'nama_unit'=>$request->nama_unit,
                        'tingkatan_unit_id'=>$request->tingkatan_unit_id,
                        'nik_atasan'=>$request->nik_atasan,
                        'kode_unit_atasan'=>$request->kode_unit_atasan,
                        'aktif'=>1,
                    ]
                );

                echo'@ok';
            }else{
                $data=Unit::where('id',$request->id)->update(
                    [
                        'singkatan'=>$request->singkatan,
                        'nama_unit'=>$request->nama_unit,
                        'tingkatan_unit_id'=>$request->tingkatan_unit_id,
                        'nik_atasan'=>$request->nik_atasan,
                        'kode_unit_atasan'=>$request->kode_unit_atasan,
                        'aktif'=>1,
                    ]
                );

                echo'@ok';
            }
                
            
        }
    }
}
