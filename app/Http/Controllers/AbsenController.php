<?php

namespace App\Http\Controllers;
use App\Events\KirimCreated;  
use App\Events\LemburCreated;  
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exports\AbsenExport;
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
use App\Models\Jadwal;
use App\Models\Absen;
use App\Models\Rekapabsen;

class AbsenController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        if($request->tanggal==''){
            $tanggal=date('Y-m-d');
        }else{
            $tanggal=$request->tanggal;
        }
        return view('absen.index',compact('template','tanggal'));
    }
    public function index_rekap(request $request)
    {
        $template='top';
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
        return view('absen.index_rekap',compact('template','bulan','tahun'));
    }

    public function cek_download_excel(request $request)
    {
       
                echo'@ok';
            
        
    }
    public function download_excel(request $request)
    {
       
            $tanggal=$request->tanggal;
            $nama='ABSEN'.$tanggal;
            return Excel::download(new AbsenExport($tanggal), ''.$nama.'.xlsx');
        
    }

    public function proses_rekap(request $request)
    {
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

                $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();
                $bulan=$request->bulan;
                $tahun=$request->tahun;
                foreach($data as $o){
                    $jadwal=Jadwal::whereMonth('tanggal',$bulan)->whereYear('tanggal',$tahun)->where('group_id',$o->group_id)->orderBy('tanggal','Asc')->get();
                    foreach($jadwal as $jad){
                        $tanggal=$jad->tanggal;
                        echo $o->nik.' tanggal='.$tanggal.' waktu_masuk='.jam_absen($o->nik,$tanggal,'M').'<br>';
                        if(jam_absen($o->nik,$tanggal,'M')==null || jam_absen($o->nik,$tanggal,'P')==null ){
                            $status=0;
                        }else{
                            $status=1;
                        }
                        $datapulang=Rekapabsen::updateOrCreate(
                            [
                                'nik'=>$o->nik,
                                'tanggal'=>$tanggal,
                            ],
                            [
                                'group_id'=>$o->group_id,
                                'waktu_masuk'=>jam_absen($o->nik,$tanggal,'M'),
                                'jam_masuk'=>jam(jam_absen($o->nik,$tanggal,'M')),
                                'waktu_pulang'=>jam_absen($o->nik,$tanggal,'P'),
                                'jam_pulang'=>jam(jam_absen($o->nik,$tanggal,'P')),
                                'status_absen'=>idstatusabsen($o->nik,$tanggal,'M'),
                                'telat'=>jam_selisih_absen($o->nik,$tanggal,'M'),
                                'status'=>$status
                            ]
                        );
                    }
                }

                echo'@ok@'.$request->bulan.'@'.$request->tahun;
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Password salah</div></div>';
            }
        }
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
        if($request->tanggal==''){
            $tanggal=date('Y-m-d');
        }else{
            $tanggal=$request->tanggal;
        }
        $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal_absen', function ($row) use ($tanggal){
                return jam_absen($row->nik,$tanggal,'M');
            })
            ->addColumn('jam_masuk', function ($row) use ($tanggal){
                return jam(jam_absen($row->nik,$tanggal,'M'));
            })
            ->addColumn('jam_pulang', function ($row) use ($tanggal){
                return jam(jam_absen($row->nik,$tanggal,'P'));
            })
            ->addColumn('selisih_masuk', function ($row) use ($tanggal){
                return jam_selisih_absen($row->nik,$tanggal,'M');
            })
            ->addColumn('statusabsen', function ($row) use ($tanggal){
                return statusabsen($row->nik,$tanggal,'M');
            })
           
            ->addColumn('action', function ($row) use ($tanggal){
                $btn='
                    <div class="btn-group btn-xs" style="padding:0px">
                        <span class="btn btn-white btn-xs" onclick="add_data('.$row->nik.',`'.$tanggal.'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->make(true);
    }

    public function get_data_rekap(request $request)
    {
        error_reporting(0);
        $bulan=$request->bulan;
        $tahun=$request->tahun;
        
        $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aktual', function ($row) use ($bulan,$tahun){
                return jumlah_wajid_kehadiran($bulan,$tahun,$row->group_id).' Hari';
            })
            ->addColumn('total_hadir', function ($row) use ($bulan,$tahun){
                return total_jumlah_absen($row->nik,$bulan,$tahun,jumlah_wajid_kehadiran($bulan,$tahun,$row->group_id)).' Hari';
            })
            ->addColumn('hadir', function ($row) use ($bulan,$tahun){
                return jumlah_absen($row->nik,$bulan,$tahun,1).' Hari';
            })
            ->addColumn('cuti', function ($row) use ($bulan,$tahun){
                return jumlah_absen($row->nik,$bulan,$tahun,2).' Hari';
            })
            ->addColumn('sakit', function ($row) use ($bulan,$tahun){
                return jumlah_absen($row->nik,$bulan,$tahun,3).' Hari';
            })
            ->addColumn('izin', function ($row) use ($bulan,$tahun){
                return jumlah_absen($row->nik,$bulan,$tahun,4).' Hari';
            })
            
            ->make(true);
    }
    
    public function modal(request $request)
    {
        error_reporting(0);
        $nik=$request->nik;
        $tanggal=$request->tanggal;
        $data=Employe::where('nik',$request->nik)->first();
        $cekmasuk=Absen::where('nik',$nik)->where('tanggal',$tanggal)->where('status','M')->count();
        $masuk=Absen::where('nik',$nik)->where('tanggal',$tanggal)->where('status','M')->first();
        if($cekmasuk>0){
            $absenmasuk=$masuk->waktu;
            $statusabsen=$masuk->status_absen;

        }else{
            $absenmasuk=jam_jadwal($data->group_id,$tanggal,'M');
            $statusabsen=0;
        }
        $cekpulang=Absen::where('nik',$nik)->where('tanggal',$tanggal)->where('status','P')->count();
        $pulang=Absen::where('nik',$nik)->where('tanggal',$tanggal)->where('status','P')->first();
        if($cekmasuk>0){
            $absenpulang=$pulang->waktu;
        }else{
            $absenpulang=jam_jadwal($data->group_id,$tanggal,'P');
        }
        
        return view('absen.modal',compact('data','nik','tanggal','absenmasuk','statusabsen','absenpulang'));
    }
    public function delete_data(request $request){
        $data = Employe::where('id',$request->id)->update(['aktif'=>0]);
    }

    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['status_absen']= 'required';
        $messages['status_absen.required']= 'Lengkapi  status absen';
        $rules['jam_masuk']= 'required';
        $messages['jam_masuk.required']= 'Lengkapi jam masuk';
        $rules['jam_pulang']= 'required';
        $messages['jam_pulang.required']= 'Lengkapi jam pulang';
       
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
            $employe=Employe::where('nik',$request->nik)->first();
            $waktumasuk=$request->tanggal.' '.$request->jam_masuk;
            $waktupulang=$request->tanggal.' '.$request->jam_pulang;
            $jamaktualmasuk=jam_jadwal($employe->group_id,$request->tanggal,'M');
            $jamaktualpulang=jam_jadwal($employe->group_id,$request->tanggal,'P');

            $datamasuk=Absen::updateOrCreate(
                [
                    'nik'=>$request->nik,
                    'tanggal'=>$request->tanggal,
                    'status'=>'M',
                ],
                [
                    'jam_aktual'=>$jamaktualmasuk,
                    'group_id'=>$employe->group_id,
                    'waktu'=>$waktumasuk,
                    'lat'=>0,
                    'status_absen'=>$request->status_absen,
                    'long'=>0,
                ]
            );

            $datapulang=Absen::updateOrCreate(
                [
                    'nik'=>$request->nik,
                    'tanggal'=>$request->tanggal,
                    'status'=>'P',
                ],
                [
                    'jam_aktual'=>$jamaktualpulang,
                    'group_id'=>$employe->group_id,
                    'waktu'=>$waktupulang,
                    'lat'=>0,
                    'status_absen'=>$request->status_absen,
                    'long'=>0,
                ]
            );

            KirimCreated::dispatch('sukses');
            echo'@ok';
                
            
        }
    }
}
