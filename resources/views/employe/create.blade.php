@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Form employe</li>
    </ol>
    <h1 class="page-header">Form employe <small>(Penginputan master employe)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">FORM EMPLOYE</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body panel-form" style="background: #c1c1c7; padding: 1% !important;">
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('employe') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <input type="hidden" name="id" value="{{$id}}">
                    <ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">1.Personal</span>
								<span class="d-sm-block d-none">1.Personal</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">2.Pendidikan</span>
								<span class="d-sm-block d-none">2.Pendidikan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-3" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">3.Data Keluarga</span>
								<span class="d-sm-block d-none">3.Data Keluarga</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-4" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">4.Kontrak</span>
								<span class="d-sm-block d-none">4.Kontrak</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-5" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">5.Gaji Pokok, Tunjangan dan Kontribusi</span>
								<span class="d-sm-block d-none">5.Gaji Pokok, Tunjangan dan Kontribusi</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
                            <div class="row">
                                <div class="col-xl-12 ui-sortable">
                                    <h1 class="page-header"><small><b><i class="fas fa-users"></i> Data Diri</b> (Penginputan data diri)</small></h1>
                                </div>
                                <div class="col-xl-7 ui-sortable">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">NIK</label>
                                        <div class="col-lg-4">
                                            <input type="text" maxlength="10" {{$disabled}} name="nik" value="{{$data->nik}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nomor KTP</label>
                                        <div class="col-lg-6">
                                            <input type="text"  maxlength="20"  {{$disabled}}  name="no_ktp" value="{{$data->no_ktp}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nama</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="nama" value="{{$data->nama}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label" style="align-items: baseline;">Alamat</label>
                                        <div class="col-lg-8">
                                            <textarea name="alamat" rows="4" class="form-control form-control-sm" placeholder="ketik disini...">{{$data->alamat}}</textarea>
                                                
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-lg-8">
                                    
                                                <div class="custom-control custom-radio mb-1">
                                                    <input type="radio" id="customRadio1" @if($data->jenis_kelamin=="L") checked @endif value="L"  name="jenis_kelamin" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio2"  @if($data->jenis_kelamin=="P") checked @endif value="P" name="jenis_kelamin" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Perempuan</label>
                                                </div>

                                                
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label"  style="align-items: baseline;">TTGL</label>
                                        <div class="col-lg-5">
                                            <input type="text" name="tempat_lahir" value="{{$data->tempat_lahir}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            <small class="f-s-12 text-grey-darker">Tempat lahir</small>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="input-group date" id="datetimepicker1">
                                                <input type="text" name="tanggal_lahir" readonly value="{{$data->tanggal_lahir}}" class="form-control form-control-sm">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <small class="f-s-12 text-grey-darker">Tanggal lahir</small>
                                        </div>
                                    </div>
                                   
                                    
                                </div>
                                <div class="col-xl-5 ui-sortable">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Email</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="email"   {{$disabled}} value="{{$data->email}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">No Handphone</label>
                                        <div class="col-lg-8">
                                            <input type="text" name="no_hp" value="{{$data->no_hp}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"  style="align-items: baseline;">Foto</label>
                                        <div class="col-lg-5">
                                            <input type="file" name="foto" value="{{$data->foto}}" class="form-control form-control-sm" placeholder="ketik disini..." accept="image/*" onchange="loadFile(event)">
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="widget-icon widget-icon-xl user rounded bg-grey pull-left m-r-1 m-b-5 text-white" data-id="widget-elm" data-light-class="widget-icon widget-icon-xl user rounded bg-grey pull-left m-r-5 m-b-5 text-white" data-dark-class="widget-icon widget-icon-xl user rounded bg-inverse pull-left m-r-5 m-b-5 text-white-transparent-5">
                                                <div id="output" width="100%">
                                                    @if($id>0)
                                                        <img src="{{url_plug()}}/file/photo/{{$data->foto}}?v={{date('ymdhis')}}" class="photo_akun"/>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">BPJS Kesehatan</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="no_bpjs" value="{{$data->no_bpjs}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-5 col-form-label">BPJS Tenaga Kerja</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="no_jkn" value="{{$data->no_jkn}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                        </div>

                        <div class="tab-pane fade" id="default-tab-2">
                            <div class="col-xl-12 ui-sortable">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Asal Sekolah</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="asal_sekolah" value="{{$data->asal_sekolah}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Pendidikan</label>
                                    <div class="col-lg-4">
                                        <select class="default-select2 form-control form-control-sm" name="pendidikan_id">
                                            
                                            <option value="">Pilih</option>
                                            @foreach(get_pendidikan() as $pendidikan)
                                                <option value="{{$pendidikan->id}}" @if($data->pendidikan_id==$pendidikan->id) selected @endif >{{$pendidikan->pendidikan}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="input-group date" id="datetimepicker6">
                                            <input type="text" name="tahun_pendidikan" readonly value="{{$data->tahun_pendidikan}}" class="form-control form-control-sm">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">No Ijazah</label>
                                    <div class="col-lg-3">
                                        <input type="text" name="no_ijazah" value="{{$data->no_ijazah}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 ui-sortable">
                                <hr>
                                <span id="tambahadd" class="btn btn-sm btn-primary">Tambah</span>
                                <div class="widget-list widget-list-rounded m-b-30" style="margin-top:2%" data-id="widget">
                                    @if($id>0)
                                        @foreach(get_sertifikat($data->no_ktp) as $ser)
                                            <a href="javascript:;" class="widget-list-item" style="background: #d8fbd4;border:solid 1px #fff">
                                                <div class="widget-list-media icon" onclick="window.open(`{{url_plug()}}/file/sertifikat/{{$ser->file}}`)">
                                                    @if($ser->tipe=='image')
                                                        <i class="fas fa-image bg-green text-white"></i>
                                                    @else
                                                        <i class="fas fa-file-pdf bg-green text-white"></i>
                                                    @endif
                                                    
                                                </div>
                                                <div class="widget-list-content">
                                                    <h4 class="widget-list-title">{{$ser->sertifikat}}</h4>
                                                </div>
                                                <div class="widget-list-action text-right" onclick="delete_data({{$ser->id}})" title="hapus">
                                                    <i class="fas fa-trash text-red"></i>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                                <div id="upload_pengalaman"></div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="default-tab-3">
                            <div class="row">
                                <div class="col-xl-12 ui-sortable">
                                    <h1 class="page-header"><small><b><i class="fas fa-users"></i> Data Orang Tua</b> (Penginputan data orang tua)</small></h1>
                                </div>
                                <div class="col-xl-6 ui-sortable">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nama Ayah</label>
                                        <div class="col-lg-9">
                                            <input type="text"   name="ayah" value="{{$data->ayah}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label" style="align-items: baseline;">Alamat</label>
                                        <div class="col-lg-8">
                                            <textarea name="alamat_ayah" rows="4" class="form-control form-control-sm" placeholder="ketik disini...">{{$data->alamat_ayah}}</textarea>
                                                
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pekerjaan</label>
                                        <div class="col-lg-9">
                                            <input type="text"   name="pekerjaan_ayah" value="{{$data->pekerjaan_ayah}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="col-xl-6 ui-sortable">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Nama Ibu</label>
                                        <div class="col-lg-9">
                                            <input type="text"   name="ibu" value="{{$data->ibu}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label" style="align-items: baseline;">Alamat</label>
                                        <div class="col-lg-8">
                                            <textarea name="alamat_ibu" rows="4" class="form-control form-control-sm" placeholder="ketik disini...">{{$data->alamat_ibu}}</textarea>
                                                
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Pekerjaan</label>
                                        <div class="col-lg-9">
                                            <input type="text"   name="pekerjaan_ibu" value="{{$data->pekerjaan_ibu}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                        </div>

                        <div class="tab-pane fade" id="default-tab-4">
                            <div class="col-xl-12 ui-sortable">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">No Kontrak</label>
                                    <div class="col-lg-2">
                                        <input type="text" name="no_kontrak" value="{{$data->no_kontrak}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Tanggal Kontrak</label>
                                    <div class="col-lg-6">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6 mb-2 mb-sm-0">
                                                <div class="input-group date" id="datetimepickerend2">
                                                    <input type="text" name="mulai_kontrak" readonly value="{{$data->mulai_kontrak}}" class="form-control form-control-sm">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <small class="f-s-12 text-grey-darker">Tanggal Mulai Kontrak</small>
                                            </div>
                                            
                                            <div class="col-xs-6">
                                                <div class="input-group date" id="datetimepickerend3">
                                                    <input type="text" name="sampai_kontrak" id="endate" readonly value="{{$data->sampai_kontrak}}" class="form-control form-control-sm">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <small class="f-s-12 text-grey-darker">Tanggal Sampai Kontrak</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Jabatan</label>
                                    <div class="col-lg-5">
                                        <select class="default-select2 form-control form-control-sm" name="jabatan_id">
                                            
                                            <option value="">Pilih</option>
                                            @foreach(get_jabatan() as $jabatan)
                                                <option value="{{$jabatan->id}}" @if($data->jabatan_id==$jabatan->id) selected @endif >{{$jabatan->jabatan}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Kategori Group</label>
                                    <div class="col-lg-4">
                                        <select class="form-control form-control-sm" onchange="pilih_group(this.value)" name="group_id">
                                            
                                            <option value="">Pilih</option>
                                            @foreach(get_group() as $group)
                                                <option value="{{$group->id}}" @if($data->group_id==$group->id) selected @endif >{{$group->group}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Unit Kerja</label>
                                    <div class="col-lg-5">
                                        <select class="form-control form-control-sm default-select3"  name="kode_unit">
                                            
                                            <option value="">Pilih</option>
                                            @foreach(get_unit() as $unit)
                                                <option value="{{$unit->kode_unit}}" @if($data->kode_unit==$unit->kode_unit) selected @endif >{{$unit->nama_unit}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Posisi</label>
                                    <div class="col-lg-3">
                                        <select class="form-control form-control-sm default-select3"  name="posisi_id">
                                            
                                            <option value="">Pilih</option>
                                            @foreach(get_posisi() as $posisi)
                                                <option value="{{$posisi->id}}" @if($data->posisi_id==$posisi->id) selected @endif >{{$posisi->posisi}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="default-tab-5">
                            <div class="col-xl-12 ui-sortable">
                                
                                
                                <div class="row" style="background:#fafaff">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">1.Gaji Pokok</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currency1" name="gaji_pokok" value="{{$data->gaji_pokok}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">2.Tunjangan dibayar</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currencysum1" disabled value="{{sum_tunjangan($data->id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">3.Kontribusi dibayar</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currencysum2" disabled value="{{sum_kontribusi($data->id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        @if(in_array($data->group_id,array(1,2,3,4)))
                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label">4.Uang Shift</label>
                                                <div class="col-lg-3">
                                                    <input type="text" id="currencysum3" disabled value="{{uang_shift($data->jabatan_id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row" style="background:#fafaff;border:solid 1px #d1d1d1;margin-top:2%">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Rincian Tunjangan</label>
                                        </div>
                                        @foreach(get_tunjangan($data->jabatan_id) as $tg=>$tujn)
                                        <div class="form-group row">
                                            <label class="col-lg-8 col-form-label">&nbsp;&nbsp;&nbsp;-{{$tujn->tunjangan}} </label>
                                            <div class="col-lg-4">
                                                <input type="text" id="currency1{{$tg}}" disabled value="{{$tujn->nilai}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Rincian Kontribusi Perusahaan</label>
                                        </div>
                                        @foreach(get_kontribusi($data->jabatan_id) as $tg=>$tujn)
                                        <div class="form-group row">
                                            <label class="col-lg-8 col-form-label">&nbsp;&nbsp;&nbsp;-{{$tujn->tunjangan}} </label>
                                            <div class="col-lg-4">
                                                <input type="text" id="currency11{{$tg}}" disabled value="{{$tujn->nilai}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end panel-body -->
        </div>
        <div class="btn-group" style="margin-bottom:1%">
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('employe')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
            <button class="btn btn-success" id="btn-save"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </div>
</div>
     
@endsection
@section('script')
    @include('layouts.scriptform')
@endsection
@push('ajax')
    <!-- <script src="{{url_plug()}}/js/app.js"></script>
    <script type="text/javascript">
        $.noConflict();
        var i = 0;
        window.Echo.channel('message').listen('KirimCreated', (data) => {
            i++;
            // $("#notification").append('<div class="alert alert-success">'+i+'. '+data.title+'</div>');
            alert(i)
        });
    </script> -->
@endpush

@push('datatable')
    <script type="text/javascript">
        $(document).ready(function(){
            var nomor = 1;
            $("#tambahadd").click(function(){
                var no = nomor++;
                $("#upload_pengalaman").append('<div class="form-group row">'
                                                    +'<label class="col-lg-1 col-form-label"> '+no+'</label>'
                                                    +'<div class="col-lg-7">'
                                                        +'<input type="text" name="sertifikat[]"  class="form-control form-control-sm" placeholder="ketik disini...">'
                                                    +'</div>'
                                                    +'<div class="col-lg-4">'
                                                        +'<input type="file" name="file[]"  class="form-control form-control-sm" placeholder="ketik disini...">'
                                                    +'</div>'
                                                +'</div>');
            });
        });
        @foreach(get_tunjangan($data->jabatan_id) as $tg=>$tujn)
        $("#currency1{{$tg}}").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        
        @endforeach
        
        @foreach(get_kontribusi($data->jabatan_id) as $tg=>$tujn)
        $("#currency11{{$tg}}").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        
        @endforeach
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        $("#currencysum1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        $("#currencysum2").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        $("#currencysum3").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        
        // function pilih_group(id){
        //     if(id==5){

        //     }else{

        //     }
        // }
        function delete_data(id){
           
           swal({
               title: "Yakin menghapus data ini ?",
               text: "data akan hilang dari daftar ini",
               type: "warning",
               icon: "error",
               showCancelButton: true,
               align:"center",
               confirmButtonClass: "btn-danger",
               confirmButtonText: "Yes, delete it!",
               closeOnConfirm: false
           }).then((willDelete) => {
               if (willDelete) {
                       $.ajax({
                           type: 'GET',
                           url: "{{url('employe/delete_sertifikat')}}",
                           data: "id="+id,
                           success: function(msg){
                               swal("Success! Berhasil terhapus!", {
                                   icon: "success",
                               });
                               location.reload();
                           }
                       });
                   
                   
               } else {
                   
               }
           });
           
       }

        $('#datetimepicker1').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});

        $('#datetimepicker6').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});

        $('#datetimepicker2').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});
        var loadFile = function(event) {
            var reader = new FileReader();
                reader.onload = function(){
                $('#output').html('<img src="'+reader.result+'" class="photo_akun"/>');
            };
            reader.readAsDataURL(event.target.files[0]);
        };
        $('#datetimepicker3').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});

        $('#datetimepickerend2').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		}).on( "changeDate", function(selected) {
			$('#endate').val("");
			var minDate = new Date(selected.date.valueOf());
			$('#datetimepickerend3').datepicker('setStartDate', minDate);
			
		});
		$('#datetimepickerend3').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});
		$('.default-select2').select2();
		$('.default-select3').select2();
        
        $('#btn-save').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('employe') }}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        document.getElementById("loadnya").style.width = "100%";
                    },
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            document.getElementById("loadnya").style.width = "0px";
                            swal("Success! Your data has been save!", {
									icon: "success",
                            }).then(function(){ 
                                    @if($id>0)
                                        location.reload();
                                    @else
                                        location.assign("{{url('employe')}}");
                                    @endif
                                    
                                }
                            );  
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasi').html(msg);
                            $('#modal-notifikasi').modal('show');
                        }
                        
                        
                    }
                });
        });
        
        
    </script>
@endpush
