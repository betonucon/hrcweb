<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Imports\JadwalImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Jadwal;
use App\Models\Sertifikat;

class JadwalController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        if($request->bulan==""){
            $bulan=date('m');
        }else{
            $bulan=$request->bulan;
        }
        if($request->tahun==""){
            $tahun=date('Y');
        }else{
            $tahun=$request->tahun;
        }
        
        return view('jadwal.index',compact('template','bulan','tahun'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Jadwal::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='disabled';
        }
        return view('jadwal.create',compact('template','data','disabled','id'));
    }
    public function get_data(request $request)
    {
        error_reporting(0);
        $data = Jadwal::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-white btn-sm" onclick="location.assign(`'.url('group/create?id='.$row->id).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                        <span class="btn btn-white btn-sm"  onclick="delete_data('.$row['id'].')"><i class="fas fa-trash text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function delete_data(request $request){
        $data = Jadwal::where('id',$request->id)->update(['aktif'=>0]);
    }

    public function import(Request $request)
    {
        error_reporting(0);
        $rules = [
            'file'=> 'required|mimes:xlsx',
        ];
        $rules = [
            'tahun'=> 'required',
        ];
        $rules = [
            'bulan'=> 'required',
        ];

        $messages = [
            'file.required'=> 'Upload file excel',
            'file.mimes'=> 'Hanya menerima file .xlsx',
        ];
        $messages = [
            'tahun.required'=> 'isi tahun',
        ];
        $messages = [
            'bulan.required'=> 'isi bulan',
        ];
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
            $filess = $request->file('file');
            $nama_file = rand().$filess->getClientOriginalName();
            $filess->move('public/file_excel_employe',$nama_file);
            $data=Excel::toArray([],public_path('/file_excel_employe/'.$nama_file));
            foreach($data[0] as $no=>$awal){
                if($no>0 && $no<6){
                    foreach($awal as $no2=>$kedua){
                        if($no2>0){
                            $tanggal=$request->tahun.'-'.$request->bulan.'-'.$no2;
                            if($kedua!=null){
                                $save=Jadwal::updateOrCreate(
                                    [
                                        'group_id'=>$no,
                                        'tanggal'=>$tanggal,
                                    ],
                                    [
                                        'jadwal'=>$kedua,
                                    ],
                                );
                            }
                        }
                    }                
                }
                
            }
            echo'@ok@'.$request->bulan.'@'.$request->tahun;
            
        }
    }
    

    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['Jadwal']= 'required';
        $messages['Jadwal.required']= 'Lengkapi kolom Jadwal';
       
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
                
                $data=Jadwal::create([
                    'Jadwal'=>$request->Jadwal,
                    'aktif'=>1,
                ]);

                echo'@ok';
                
            }else{
                $data=Jadwal::where('id',$request->id)->update([
                    'Jadwal'=>$request->Jadwal,
                ]);

                echo'@ok';
            }
        }
    }
}
