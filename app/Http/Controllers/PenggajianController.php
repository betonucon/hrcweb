<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Imports\EmployeImport;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\Employe;
use App\Models\Tgajipokok;
use App\Models\Temployepotongan;
use App\Models\Vemploye;
use App\Models\Sertifikat;
use App\Models\Temployetunjangan;
use App\Models\Employedokumen;
use App\Models\Employepotongan;
use App\Models\Potongan;

class PenggajianController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('penggajian.index',compact('template'));
    }
    public function index_slip(request $request)
    {
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
        $template='top';
        return view('penggajian.index_slip',compact('template','bulan','tahun'));
    }
    public function index_dokumen(request $request)
    {
        $template='top';
        return view('penggajian.index_dokumen',compact('template'));
    }

    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='disabled';
        }
        return view('penggajian.create',compact('template','data','disabled','id'));
    }
    public function view_data(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::find($request->id);
        $id=$request->id;
        $bulan=$request->bulan;
        $tahun=$request->tahun;
        return view('penggajian.view',compact('template','data','bulan','id','tahun'));
    }

    public function create_dokumen(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='disabled';
        }
        return view('penggajian.create_dokumen',compact('template','data','disabled','id'));
    }
    
    public function tampil_dokumen(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::where('no_ktp',$request->no_ktp)->first();
        
        return view('penggajian.tampil_dokumen',compact('template','data'));
    }
    public function slip(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::where('id',$request->id)->first();
        $id=$request->id;
        $bulan=$request->bulan;
        $tahun=$request->tahun;
        return view('penggajian.slip_gaji',compact('template','data','bulan','id','tahun'));
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        if($request->bulan==''){
            $bulan=date('m');
        }else{
            $bulan=$request->bulan;
        }
        if($request->tahun==''){
            $tahun=date('Y');
        }else{
            $tahun=$request->tahun;
        }
        $data = Employe::where('aktif',1)->where('jabatan_id','>',0)->where('mulai_kontrak','!=',null)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ttgl', function ($row) {
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('uang_gaji_pokok', function ($row) {
                return uang($row->gaji_pokok);
            })
            ->addColumn('uang_tunjangan', function ($row) {
                return uang(sum_tunjangan($row->jabatan_id));
            })
            ->addColumn('uang_kontribusi', function ($row) {
                return uang(sum_kontribusi($row->jabatan_id));
            })
            ->addColumn('uang_potongan', function ($row) use ($bulan,$tahun){
                return uang(sum_potongan($row->nik,$row->no_ktp,$bulan,$tahun));
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group btn-sm">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('employe/penggajian/create?id='.$row->id).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                        <span class="btn btn-white btn-xs"  onclick="delete_data('.$row['id'].')"><i class="fas fa-trash text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_data_slip(request $request)
    {
        error_reporting(0);
        if($request->bulan==''){
            $bulan=date('m');
        }else{
            $bulan=$request->bulan;
        }
        if($request->tahun==''){
            $tahun=date('Y');
        }else{
            $tahun=$request->tahun;
        }
        // $data = Vemploye::where('aktif',1)->where('status_lengkap',1)->where('selisih','>',0)->orderBy('id','Asc')->get();
        $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ttgl', function ($row) {
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('uang_gaji_pokok', function ($row)  use ($bulan,$tahun){
                return uang(gaji_pokok_bulanan($row->nik,$row->no_ktp,$bulan,$tahun));
            })
            ->addColumn('uang_tunjangan', function ($row) {
                return uang(sum_tunjangan($row->jabatan_id));
            })
            ->addColumn('uang_kontribusi', function ($row) {
                return uang(sum_kontribusi($row->jabatan_id));
            })
            ->addColumn('uang_potongan', function ($row) use ($bulan,$tahun){
                return uang(sum_slip_potongan($row->nik,$row->no_ktp,$bulan,$tahun));
            })
            ->addColumn('action', function ($row) use ($bulan,$tahun){
                $btn='
                    <div class="btn-group btn-sm">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('slip/view?id='.$row->id.'&bulan='.$bulan.'&tahun='.$tahun).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_data_dokumen(request $request)
    {
        error_reporting(0);
        $data = Employe::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ttgl', function ($row) {
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('jabatan', function ($row) {
                return $row->mjabatan['jabatan'];
            })
            ->addColumn('status_dokumen', function ($row) {
                if(count_dokumen_employe($row->no_ktp)==count_dokumen()){
                    return '<label class="label label-primary">Lengkap</label>';
                }else{
                    return '('.count_dokumen_employe($row->no_ktp).'/'.count_dokumen().')';
                }
                
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group btn-sm" style="padding: 0px;">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('penggajian/create_dokumen?id='.$row->id).'`)"><i class="fas fa-clone text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action','status_dokumen'])
            ->make(true);
    }

    public function delete_data(request $request){
        $data = Employe::where('id',$request->id)->update(['aktif'=>0]);
    }

    public function dashboard(request $request){
        return view('penggajian.dashboard');
    }

    public function delete_sertifikat(request $request){
        $data = Sertifikat::where('id',$request->id)->delete();
    }

    public function store_slip(request $request){
        error_reporting(0);
        $rules=[];
        $messages=[];
        $rules['bulan'] = 'required';
        $rules['tahun'] = 'required';
        $rules['password'] = 'required';

        $messages['bulan.required'] = 'Tentukan bulan';
        $messages['tahun.required'] = 'Tentukan tahun';
        $messages['password.required'] = 'Masukan Password';
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
            if($request->password==Auth::user()->konfirmasi){
                $tanggal=$request->tahun.'-'.$request->bulan.'-27';
                foreach(get_employe_aktif() as $emp){
                    $saveslip=Tgajipokok::updateOrCreate(
                        [
                            'nik'=>$emp->nik,
                            'no_ktp'=>$emp->no_ktp,
                            'bulan'=>$request->bulan,
                            'tahun'=>$request->tahun,
                            
                        ],
                        [
                            'nilai'=>$emp->gaji_pokok,
                            'updated_at'=>date('Y-m-d H:i:s'),
                        ],
                    );

                    foreach(get_slip_potongan($emp->no_ktp,$emp->nik,$tanggal) as $potongan){
                        $saveslip=Temployepotongan::updateOrCreate(
                            [
                                'nik'=>$emp->nik,
                                'no_ktp'=>$emp->no_ktp,
                                'bulan'=>$request->bulan,
                                'tahun'=>$request->tahun,
                                'potongan_id'=>$potongan->potongan_id,
                                
                            ],
                            [
                                'potongan'=>$potongan->potongan,
                                'nilai'=>$potongan->nilai,
                                'kat'=>$potongan->kat,
                                'updated_at'=>date('Y-m-d H:i:s'),
                            ],
                        );
                    }
                    foreach(get_tunjangan($emp->jabatan_id) as $tunjangan){
                        $saveslip=Temployetunjangan::updateOrCreate(
                            [
                                'nik'=>$emp->nik,
                                'no_ktp'=>$emp->no_ktp,
                                'bulan'=>$request->bulan,
                                'tahun'=>$request->tahun,
                                'm_tunjangan_id'=>$tunjangan->id,
                                
                            ],
                            [
                                'jabatan_id'=>$tunjangan->jabatan_id,
                                'tunjangan'=>$tunjangan->tunjangan,
                                'kategori_tunjangan_id'=>$tunjangan->kategori_tunjangan_id,
                                'nilai'=>$tunjangan->nilai,
                                'kat'=>$tunjangan->kat,
                                'updated_at'=>date('Y-m-d H:i:s'),
                            ],
                        );
                    }
                    foreach(get_kontribusi($emp->jabatan_id) as $tunjangan){
                        $saveslip=Temployetunjangan::updateOrCreate(
                            [
                                'nik'=>$emp->nik,
                                'no_ktp'=>$emp->no_ktp,
                                'bulan'=>$request->bulan,
                                'tahun'=>$request->tahun,
                                'm_tunjangan_id'=>$tunjangan->id,
                                
                            ],
                            [
                                'jabatan_id'=>$tunjangan->jabatan_id,
                                'tunjangan'=>$tunjangan->tunjangan,
                                'kategori_tunjangan_id'=>$tunjangan->kategori_tunjangan_id,
                                'nilai'=>$tunjangan->nilai,
                                'kat'=>$tunjangan->kat,
                                'updated_at'=>date('Y-m-d H:i:s'),
                            ],
                        );
                    }

                    if($emp->group_id!=5){
                        foreach(get_shift($emp->jabatan_id) as $tunjangan){
                            $saveslip=Temployetunjangan::updateOrCreate(
                                [
                                    'nik'=>$emp->nik,
                                    'no_ktp'=>$emp->no_ktp,
                                    'bulan'=>$request->bulan,
                                    'tahun'=>$request->tahun,
                                    'm_tunjangan_id'=>$tunjangan->id,
                                    
                                ],
                                [
                                    'jabatan_id'=>$tunjangan->jabatan_id,
                                    'tunjangan'=>$tunjangan->tunjangan,
                                    'kategori_tunjangan_id'=>$tunjangan->kategori_tunjangan_id,
                                    'nilai'=>$tunjangan->nilai,
                                    'kat'=>$tunjangan->kat,
                                    'updated_at'=>date('Y-m-d H:i:s'),
                                ],
                            );
                        }
                    }
                }

                

                echo'@ok@'.$request->bulan.'@'.$request->tahun;
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Password salah</div></div>';
            }
        }
        
    }

    public function import(Request $request)
    {
        $rules = [
            'file'=> 'required|mimes:xlsx',
        ];

        $messages = [
            'file.required'=> 'Upload file excel',
            'file.mimes'=> 'Hanya menerima file .xlsx',
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
            Excel::import(new EmployeImport(), public_path('/file_excel_employe/'.$nama_file));
            echo '@ok';
        }
    }

    public function perbaharui_potongan(request $request){
        $data=Employe::where('aktif',1)->where('status_lengkap',1)->get();
        $datapotongan=Potongan::orderBy('id','Asc')->get();
        foreach($data as $o){
            $saveemploye=Employe::where('no_ktp',$o->no_ktp)->update([
                'status_pendapatan'=>1,
            ]);
            foreach($datapotongan as $opot){
                
                $saveslip=Employepotongan::updateOrCreate(
                    [
                        'potongan_id'=>$opot->id,
                        'nik'=>$o->nik,
                        'no_ktp'=>$o->no_ktp,
                        
                    ],
                    [
                        'nilai'=>$opot->nilai,
                        'potongan'=>$opot->potongan,
                        'mulai'=>$o->mulai_kontrak,
                        'sampai'=>$o->sampai_kontrak,
                        'kat'=>1,
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ],
                );
            }
        }
        echo'@ok';
    }

    public function gaji_pokok(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        

        $rules['gaji_pokok']= 'required';
        $messages['gaji_pokok.required']= 'Lengkapi kolom gaji pokok';

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
            
                $data=Employe::updateOrCreate(
                    [
                        'id'=>$request->id,
                    ],
                    [
                        'gaji_pokok'=>ubah_uang($request->gaji_pokok),
                        
                        'updated_at'=>date('Y-m-d H:i:s'),
                    ],
                );
                
                echo'@ok';
            
        }
    }
}
