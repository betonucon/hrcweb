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
use App\Models\Employejadwal;
use App\Models\Riwayatkontrak;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Vjadwal;
use App\Models\Cuti;
use App\Models\Vemploye;
use App\Models\Sertifikat;
use App\Models\Employedokumen;

class EmployeController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('employe.index',compact('template'));
    }

    public function index_dokumen(request $request)
    {
        $template='top';
        return view('employe.index_dokumen',compact('template'));
    }

    public function index_cuti(request $request)
    {
        $template='top';
        return view('employe.index_cuti',compact('template'));
    }

    public function index_jadwal(request $request)
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
        return view('employe.index_jadwal',compact('template','bulan','tahun'));
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
        return view('employe.create',compact('template','data','disabled','id'));
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
        return view('employe.create_dokumen',compact('template','data','disabled','id'));
    }
    
    public function tampil_dokumen(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Employe::where('no_ktp',$request->no_ktp)->first();
        return view('employe.tampil_dokumen',compact('template','data'));
    }

    public function dashboard(request $request){
        return view('employe.dashboard');
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ttgl', function ($row) {
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('statuskontrak', function ($row) {
                if($row->selisih>60){
                    return '<font color="green">On</font>';
                }else{
                    if($row->selisih>0){
                        return '<font color="red">'.$row->selisih.' Hari</font>';
                    }else{
                        return '<font color="red">Off</font>';
                    } 
                }
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group btn-sm">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('employe/create?id='.$row->id).'`)"><i class="fas fa-pencil-alt text-blue"></i></span>
                        <span class="btn btn-white btn-xs"  onclick="delete_data('.$row['id'].')"><i class="fas fa-trash text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action','statuskontrak'])
            ->make(true);
    }

    public function get_data_pilih(request $request)
    {
        error_reporting(0);
        $data = Vemploye::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('ttgl', function ($row) {
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('statuskontrak', function ($row) {
                if($row->selisih>60){
                    return '<font color="green">On</font>';
                }else{
                    if($row->selisih>0){
                        return '<font color="red">'.$row->selisih.' Hari</font>';
                    }else{
                        return '<font color="red">Off</font>';
                    } 
                }
                return $row->tempat_lahir.', '.$row->tanggal_lahir;
            })
            ->addColumn('action', function ($row) {
                $btn='
                    <span class="btn btn-success btn-xs" onclick="pilih_data(`'.$row->nik.'`,`'.$row->nama.'`)">Pilih</span>
                   
                ';
                return $btn;
            })
            
            ->rawColumns(['action','statuskontrak'])
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
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('employe/create_dokumen?id='.$row->id).'`)"><i class="fas fa-clone text-green"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action','status_dokumen'])
            ->make(true);
    }

    public function get_data_cuti(request $request)
    {
        error_reporting(0);
        $data = Employe::where('aktif',1)->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('cuti_update', function ($row) {
                return cuti_update($row->nik);
            })
            ->addColumn('cuti_digunakan', function ($row) {
                return cuti_digunakan($row->nik);
            })
            
            ->addColumn('sisa_cuti', function ($row) {
                return sisa_cuti($row->nik);
            })
            
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group btn-sm" style="padding: 0px;">
                        <span class="btn btn-white btn-xs" onclick="location.assign(`'.url('employe/create_dokumen?id='.$row->id).'`)"><i class="fas fa-clone text-green"></i></span>
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

    public function delete_sertifikat(request $request){
        $data = Sertifikat::where('id',$request->id)->delete();
    }

    public function store_dokumen(request $request){
        error_reporting(0);
        $rules=[];
        $messages=[];
       
        $rules = [
            'file'=> 'required|mimes:jpg,jpeg,png,pdf',
        ];

        $messages = [
            'file.required'=> 'Upload  dokumen',
            'file.mimes'=> 'Hanya menerima file (jpg,jpeg,png,pdf)',
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
            $image = $request->file;
            $imageFileName =$request->no_ktp.no_sepasi($request->nama_dokumen).'.'.$image->getClientOriginalExtension();
            $filePath =$imageFileName;
            $file =\Storage::disk('public_dokumen');
            if($file->put($filePath, file_get_contents($image))){
                $data=Employedokumen::updateOrCreate(
                    [
                        'no_ktp'=>$request->no_ktp,
                        'dokumen_id'=>$request->dokumen_id,
                    ],
                    [
                        'file'=>$filePath
                    ]
                );
            }
            echo'@ok';
        }
        
    }

    public function proses_jadwal(Request $request)
    {
        // error_reporting(0);
        $rules=[];
        $messages=[];
        $rules['bulan'] = 'required';
        $rules['tahun'] = 'required';

        $messages['bulan.required'] = 'Tentukan bulan';
        $messages['tahun.required'] = 'Tentukan tahun';
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
            $data=Employe::where('aktif',1)->get();
            $cek=Vjadwal::whereMonth('tanggal',$request->bulan)->whereYear('tanggal',$request->tahun)->count();
            if($cek>0){
                foreach($data as $o){
                    $jadwal=Jadwal::whereMonth('tanggal',$request->bulan)->whereYear('tanggal',$request->tahun)->where('group_id',$o->group_id)->orderBy('tanggal','Asc')->get();
                    foreach($jadwal as $get){
                        $save=Employejadwal::updateOrCreate(
                            [
                                'nik'=>$o->nik,
                                'tanggal'=>$get->tanggal,
                            ],
                            [
                                'jadwal'=>$get->jadwal,
                                'group_id'=>$get->group_id,
                                'waktu_masuk'=>$get->tanggal.' '.$get->mshift['masuk'],
                                'waktu_pulang'=>$get->tanggal.' '.$get->mshift['pulang'],
                            ],
                        );
                    }
                }
                echo'@ok@'.$request->bulan.'@'.$request->tahun;
            }else{
                echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">Periode ini tidak terdaftar</div></div>';
            }
                
        }
    }
    
    public function perbaharuan_cuti(Request $request)
    {
        // error_reporting(0);
        $rules=[];
        $messages=[];
        $rules['tahun'] = 'required';
        $rules['cuti'] = 'required';

        $messages['tahun.required'] = 'Tentukan tahun';
        $messages['cuti.required'] = 'Tentukan cuti';
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
            $data=Employe::where('aktif',1)->get();
            
            
            foreach($data as $o){
                $cek=Cuti::where('tahun',$request->tahun)->where('nik',$o->nik)->count();
                if($cek>0){

                }else{
                    $save=Cuti::updateOrCreate(
                        [
                            'nik'=>$o->nik,
                            'tahun'=>$request->tahun,
                        ],
                        [
                            'cuti'=>$request->cuti,
                        ],
                    );
                }
                
            }
            echo'@ok';
            
                
        }
    }

    public function reset_cuti(Request $request)
    {
        // error_reporting(0);
        $rules=[];
        $messages=[];
        $rules['tahun'] = 'required';

        $messages['tahun.required'] = 'Tentukan tahun';
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
            $data=Cuti::where('tahun',$request->tahun)->delete();
            
            echo'@ok';
            
                
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

    public function proses_create_user(request $request){
        error_reporting(0);
        $data = Employe::where('aktif',1)->orderBy('id','Asc')->get();
        foreach($data as $o){
            $save=User::updateOrCreate(
                [
                    'username'=>$o->nik,
                    
                ],
                [
                    'name'=>$o->nama,
                    'email'=>$o->email,
                    'password'=>Hash::make(12345678),
                    'konfirmasi'=>'12345678',
                    'role_id'=>5,
                    'active_status'=>1,
                    'posisi_id'=>$o->posisi_id,
                ]
            );
        }
    }

    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        $coutfile=count($request->file);
        $getfile=$request->file('file');
        $ary = array('pdf','jpg','jpeg','png');

        if($request->id==0){
            $rules['nik']= 'required|numeric|unique:m_employe';
            $messages['nik.required']= 'Lengkapi kolom nik';
            $messages['nik.numeric']= 'Nik hanya menerima angka';
    
            $rules['no_ktp']= 'required|numeric|unique:m_employe';
            $messages['no_ktp.required']= 'Lengkapi kolom nomor KTP';
            $messages['no_ktp.numeric']= 'Nomor KTP hanya menerima angka';

            $rules['email']= 'required|email|unique:m_employe';
            $messages['email.required']= 'Lengkapi kolom email';
            $messages['email.email']= 'email hanya menerima format email';
        }
        
        if($coutfile>0){
            $acep=0;
            foreach($getfile as $no=>$gtf){
                $eks=$request->file[$no]->getClientOriginalExtension();
                if(in_array($eks,$ary) && $request->sertifikat[$no]!=null){
                    $acep+=1;
                }else{
                    $acep+=0;
                }
            }
            if($coutfile!=$acep){

                $rules['coutfile']= 'required';
                $messages['coutfile.required']= 'File sertifikat harus berformat (pdf,jpg,jpeg,png)';
            }
        }
        $rules['nama']= 'required|regex:/^[a-zA-Z\s]+$/';
        $messages['nama.required']= 'Lengkapi kolom nama';
        $messages['nama.regex']= 'Nama hanya menerima huruf';

        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Lengkapi kolom alamat';
       
        $rules['jenis_kelamin']= 'required';
        $messages['jenis_kelamin.required']= 'Lengkapi kolom jenis_kelamin';

        $rules['tempat_lahir']= 'required';
        $messages['tempat_lahir.required']= 'Lengkapi kolom tempat_lahir';

        $rules['tanggal_lahir']= 'required|date';
        $messages['tanggal_lahir.required']= 'Lengkapi kolom tanggal_lahir';
        $messages['tanggal_lahir.date']= 'tanggal_lahir hanya menerima format (YYYY-MM-DD)';

        

        $rules['no_hp']= 'required|numeric';
        $messages['no_hp.required']= 'Lengkapi kolom no handphone';
        $messages['no_hp.numeric']= 'no hp hanya menerima format angka';

        if($request->id==0){
            $rules['foto']= 'required|mimes:jpg,jpeg,png|dimensions:width=250,height=300';
            $messages['foto.required']= 'Lengkapi kolom foto';
            $messages['foto.mimes']= 'photo hanya menerima format (jpg.jpeg,png)';
            $messages['foto.dimensions']= 'photo hanya menerima ukuran (250x300)px';
        }else{
            if($request->foto!=""){
                $rules['foto']= 'required|mimes:jpg,jpeg,png|dimensions:width=250,height=300';
                $messages['foto.required']= 'Lengkapi kolom foto';
                $messages['foto.mimes']= 'photo hanya menerima format (jpg.jpeg,png)';
                $messages['foto.dimensions']= 'photo hanya menerima ukuran (250x300)px';
            }
        }

        $rules['asal_sekolah']= 'required';
        $messages['asal_sekolah.required']= 'Lengkapi kolom asal sekolah';

        $rules['pendidikan_id']= 'required';
        $messages['pendidikan_id.required']= 'Lengkapi kolom pendidikan terakhir';

        $rules['tahun_pendidikan']= 'required';
        $messages['tahun_pendidikan.required']= 'Lengkapi kolom tahun pendidikan';

        $rules['no_ijazah']= 'required';
        $messages['no_ijazah.required']= 'Lengkapi kolom No Ijazah';


        $rules['no_kontrak']= 'required';
        $messages['no_kontrak.required']= 'Lengkapi kolom no kontrak';
        
        
        $rules['mulai_kontrak']= 'required|date';
        $messages['mulai_kontrak.required']= 'Lengkapi kolom mulai kontrak';
        $messages['mulai_kontrak.date']= 'mulai kontrak hanya menerima format (YYYY-MM-DD)';

        $rules['sampai_kontrak']= 'required|date';
        $messages['sampai_kontrak.required']= 'Lengkapi kolom sampai kontrak';
        $messages['sampai_kontrak.date']= 'sampai kontrak hanya menerima format (YYYY-MM-DD)';

        $rules['jabatan_id']= 'required|numeric';
        $messages['jabatan_id.required']= 'Lengkapi kolom jabatan';
        $messages['jabatan_id.numeric']= 'jabatan hanya menerima angka';

        $rules['group_id']= 'required|numeric';
        $messages['group_id.required']= 'Lengkapi kolom group';
        $messages['group_id.numeric']= 'Group hanya menerima angka';

        $rules['kode_unit']= 'required';
        $messages['kode_unit.required']= 'Lengkapi kolom unit kerja';

        $rules['posisi_id']= 'required';
        $messages['posisi_id.required']= 'Lengkapi kolom posisi';

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
            if($request->id==0){
                $image = $request->foto;
                $imageFileName =$request->no_ktp.'.'.$image->getClientOriginalExtension();
                $filePath =$imageFileName;
                $file =\Storage::disk('public_photo');
                if($file->put($filePath, file_get_contents($image))){
                    $data=Employe::updateOrCreate(
                        [
                            'nik'=>$request->nik,
                            'no_ktp'=>$request->no_ktp,
                            'email'=>$request->email,
                            
                            
                        ],
                        [
                            'nama'=>$request->nama,
                            'kode_unit'=>$request->kode_unit,
                            'no_hp'=>$request->no_hp,
                            'alamat'=>$request->alamat,
                            'jenis_kelamin'=>$request->jenis_kelamin,
                            'tempat_lahir'=>$request->tempat_lahir,
                            'tanggal_lahir'=>$request->tanggal_lahir,
                            'no_ijazah'=>$request->no_ijazah,
                            'ayah'=>$request->ayah,
                            'posisi_id'=>$request->posisi_id,
                            'ibu'=>$request->ibu,
                            'pekerjaan_ayah'=>$request->pekerjaan_ayah,
                            'pekerjaan_ibu'=>$request->pekerjaan_ibu,
                            'alamat_ayah'=>$request->alamat_ayah,
                            'alamat_ibu'=>$request->alamat_ibu,
                            'jabatan_id'=>$request->jabatan_id,
                            'group_id'=>$request->group_id,
                            'foto'=>$filePath,
                            'asal_sekolah'=>$request->asal_sekolah,
                            'no_bpjs'=>$request->no_bpjs,
                            'no_jkn'=>$request->no_jkn,
                            'pendidikan_id'=>$request->pendidikan_id,
                            'tahun_pendidikan'=>$request->tahun_pendidikan,
                            'no_kontrak'=>$request->no_kontrak,
                            'gaji_pokok'=>ubah_uang($request->gaji_pokok),
                            'mulai_kontrak'=>$request->mulai_kontrak,
                            'sampai_kontrak'=>$request->sampai_kontrak,
                            'status_kerja'=>$request->status_kerja,
                            'updated_at'=>date('Y-m-d H:i:s'),
                            'created_at'=>date('Y-m-d H:i:s'),
                            'aktif'=>1,
                            'status_lengkap'=>1,
                        ],
                    );

                    echo'@ok';
                }
                if($coutfile>0){
                    foreach($getfile as $no=>$gtf){
                        $fileser = $request->file[$no];
                        $fileserFileName =$request->no_ktp.'.'.$fileser->getClientOriginalExtension();
                        $fileserPath =$fileserFileName;
                        $tir=$fileser->getMimeType();
                        $tiepe=explode('/',$tir);
                        $lokfile =\Storage::disk('public_sertifikat');
                        if($lokfile->put($fileserPath, file_get_contents($fileser))){
                            $photoo=Sertifikat::create(
                                [
                                    'sertifikat'=>$request->sertifikat[$no],
                                    'no_ktp'=>$request->no_ktp,
                                    'file'=>$fileserPath,
                                    'tipe'=>$tiepe[0],
                                ]
                                
                            );
                        }
                    }
                }
            }else{
                $pgn=Employe::where('id',$request->id)->first();

                if($request->no_kontrak != $pgn->no_kontrak){
                    $rwt=Riwayatkontrak::create(
                        [
                            'nik'=>$pgn->nik,
                            'nama'=>$pgn->nama,
                            'email'=>$pgn->email,
                            'no_kontrak'=>$pgn->no_kontrak,
                            'no_hp'=>$pgn->no_hp,
                            'no_ktp'=>$pgn->no_ktp,
                            'alamat'=>$pgn->alamat,
                            'jenis_kelamin'=>$pgn->jenis_kelamin,
                            'tempat_lahir'=>$pgn->tempat_lahir,
                            'tanggal_lahir'=>$pgn->tanggal_lahir,
                            'no_ijazah'=>$pgn->no_ijazah,
                            'gaji_pokok'=>ubah_uang($pgn->gaji_pokok),
                            'jabatan_id'=>$pgn->jabatan_id,
                            'ayah'=>$pgn->ayah,
                            'ibu'=>$pgn->ibu,
                            'kode_unit'=>$pgn->kode_unit,
                            'posisi_id'=>$pgn->posisi_id,
                            'pekerjaan_ayah'=>$pgn->pekerjaan_ayah,
                            'pekerjaan_ibu'=>$pgn->pekerjaan_ibu,
                            'alamat_ayah'=>$pgn->alamat_ayah,
                            'alamat_ibu'=>$pgn->alamat_ibu,
                            'group_id'=>$pgn->group_id,
                            'no_bpjs'=>$pgn->no_bpjs,
                            'no_jkn'=>$pgn->no_jkn,
                            'status_kerja'=>$pgn->status_kerja,
                            'asal_sekolah'=>$pgn->asal_sekolah,
                            'pendidikan_id'=>$pgn->pendidikan_id,
                            'tahun_pendidikan'=>$pgn->tahun_pendidikan,
                            'mulai_kontrak'=>$pgn->mulai_kontrak,
                            'sampai_kontrak'=>$pgn->sampai_kontrak,
                            'updated_at'=>date('Y-m-d H:i:s'),
                            'status_lengkap'=>1,
                        ],
                    );
                }

                $data=Employe::updateOrCreate(
                    [
                        'id'=>$request->id,
                    ],
                    [
                        'nama'=>$request->nama,
                        'no_hp'=>$request->no_hp,
                        'alamat'=>$request->alamat,
                        'jenis_kelamin'=>$request->jenis_kelamin,
                        'tempat_lahir'=>$request->tempat_lahir,
                        'tanggal_lahir'=>$request->tanggal_lahir,
                        'no_ijazah'=>$request->no_ijazah,
                        'gaji_pokok'=>ubah_uang($request->gaji_pokok),
                        'jabatan_id'=>$request->jabatan_id,
                        'ayah'=>$request->ayah,
                        'ibu'=>$request->ibu,
                        'kode_unit'=>$request->kode_unit,
                        'posisi_id'=>$request->posisi_id,
                        'pekerjaan_ayah'=>$request->pekerjaan_ayah,
                        'pekerjaan_ibu'=>$request->pekerjaan_ibu,
                        'alamat_ayah'=>$request->alamat_ayah,
                        'alamat_ibu'=>$request->alamat_ibu,
                        'group_id'=>$request->group_id,
                        'no_bpjs'=>$request->no_bpjs,
                        'no_jkn'=>$request->no_jkn,
                        'status_kerja'=>$request->status_kerja,
                        'asal_sekolah'=>$request->asal_sekolah,
                        'pendidikan_id'=>$request->pendidikan_id,
                        'tahun_pendidikan'=>$request->tahun_pendidikan,
                        'no_kontrak'=>$request->no_kontrak,
                        'mulai_kontrak'=>$request->mulai_kontrak,
                        'sampai_kontrak'=>$request->sampai_kontrak,
                        'updated_at'=>date('Y-m-d H:i:s'),
                        'status_lengkap'=>1,
                    ],
                );

                //riwayat_kontrak jika nomor kontrak berubah
                

                if($request->foto!=""){
                    $image = $request->foto;
                    $imageFileName =$request->no_ktp.'.'.$image->getClientOriginalExtension();
                    $filePath =$imageFileName;
                    $file =\Storage::disk('public_photo');
                    if($file->put($filePath, file_get_contents($image))){
                        $photoo=Employe::updateOrCreate(
                            [
                                'id'=>$request->id,
                            ],
                            [
                                'foto'=>$filePath,
                                'updated_at'=>date('Y-m-d H:i:s'),
                            ],
                        );
                    }
                }
                if($coutfile>0){
                    foreach($getfile as $no=>$gtf){
                        $fileser = $request->file[$no];
                        $fileserFileName =$pgn->no_ktp.date('ymdhis').'.'.$fileser->getClientOriginalExtension();
                        $fileserPath =$fileserFileName;
                        $tir=$fileser->getMimeType();
                        $tiepe=explode('/',$tir);
                        $lokfile =\Storage::disk('public_sertifikat');
                        if($lokfile->put($fileserPath, file_get_contents($fileser))){
                            $fe=Sertifikat::create(
                                [
                                    'sertifikat'=>$request->sertifikat[$no],
                                    'no_ktp'=>$pgn->no_ktp,
                                    'file'=>$fileserPath,
                                    'tipe'=>$tiepe[0],
                                ]
                                
                            );
                        }
                    }
                }
                echo'@ok';
            }
        }
    }
}
