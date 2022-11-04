@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
        <li class="breadcrumb-item active">Blank Page</li>
    </ol>
    <h1 class="page-header">Blank Page <small>header small text goes here...</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Bootstrap Date Time Picker</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">
                    <div class="row">
                        <div class="col-xl-6 ui-sortable">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">NIK</label>
                                <div class="col-lg-4">
                                    <input type="text" name="nik" value="{{$data->nik}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama</label>
                                <div class="col-lg-8">
                                    <input type="text" name="name" value="{{$data->name}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" style="align-items: baseline;">Alamat</label>
                                <div class="col-lg-8">
                                    <textarea name="alamat" rows="4" class="form-control form-control-sm" placeholder="ketik disini...">{{$data->alamat}}</textarea>
                                        
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label" style="align-items: baseline;">Alamat</label>
                                <div class="col-lg-8">
                               
										<div class="custom-control custom-radio mb-1">
											<input type="radio" id="customRadio1"  value="Laki-laki"  name="jenis_kelamin" class="custom-control-input">
											<label class="custom-control-label" for="customRadio1">Laki-laki</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" id="customRadio2" value="Perempuan" name="jenis_kelamin" class="custom-control-input">
											<label class="custom-control-label" for="customRadio2">Perempuan</label>
										</div>

                                        
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Tempat Tanggal Lahir</label>
                                <div class="col-lg-5">
                                <input type="text" name="tempat_lahir" value="{{$data->tempat_lahir}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group date" id="datetimepicker1">
                                        <input type="text" name="tanggal_lahir" readonly value="{{$data->tanggal_lahir}}" class="form-control form-control-sm">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Jabatan</label>
                                <div class="col-lg-8">
                                    <select class="default-select2 form-control form-control-sm">
                                        
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-xl-6 ui-sortable">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Tanggal Kontrak (Mulai & Sampai)</label>
                                <div class="col-lg-8">
                                    <div class="row row-space-10">
                                        <div class="col-xs-5 mb-2 mb-sm-0">
                                            <div class="input-group date" id="datetimepickerend2">
                                                <input type="text" name="tanggal_mulai" readonly value="{{$data->tanggal_mulai}}" class="form-control form-control-sm">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-xs-5">
                                            <div class="input-group date" id="datetimepickerend3">
                                                <input type="text" name="tanggal_sampai" id="endate" readonly value="{{$data->tanggal_sampai}}" class="form-control form-control-sm">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
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
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('produk')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
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
