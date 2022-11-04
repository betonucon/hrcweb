@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Form unit kerja</li>
    </ol>
    <h1 class="page-header">Form unit kerja <small>(Penginputan master unit kerja)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">FORM unit kerja</h4>
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
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/jabatan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <input type="hidden" name="id" value="{{$id}}">
                    <ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Unit Kerja</span>
								<span class="d-sm-block d-none">Unit Kerja</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
                            <div class="col-xl-12 ui-sortable">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Kode Unit</label>
                                    <div class="col-lg-4">
                                        <input type="text" name="kode_unit" {{$disabled}} value="{{$data->kode_unit}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Nama Unit</label>
                                    <div class="col-lg-2">
                                        <input type="text" name="singkatan" value="{{$data->singkatan}}" class="form-control form-control-sm" placeholder="Singkatan">
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" name="nama_unit" value="{{$data->nama_unit}}" class="form-control form-control-sm" placeholder="nama unit">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Kategori</label>
                                    <div class="col-lg-4">
                                        <select class="default-select2 form-control form-control-sm" name="tingkatan_unit_id">
                
                                            <option value="">Pilih</option>
                                            @foreach(get_tingkatanunit() as $tunj)
                                                <option value="{{$tunj->id}}" @if($data->tingkatan_unit_id==$tunj->id) selected @endif >{{$tunj->tingkatan}}</option>
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Pimpinan</label>
                                    <div class="col-lg-1">
                                        <span class="btn btn-sm btn-blue" onclick="pilih()">Pilih</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="text" readonly name="nik_atasan" id="nik_pimpinan" value="{{$data->nik_atasan}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                    </div>
                                    <div class="col-lg-5">
                                        <input type="text" readonly name="nama_pimpinan" id="nama_pimpinan" value="{{$data->memploye['nama']}}" class="form-control form-control-sm" placeholder="ketik disini...">
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
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('master/unit')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
            <button class="btn btn-success" id="btn-save"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-employe" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Unit Kerja</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive ">
                    <table id="data-table-fixed-header" width="100%" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-nowrap" width="5%">No</th>
                                <th class="text-nowrap" width="7%">NIK</th>
                                <th class="text-nowrap" >NO KTP</th>
                                <th class="text-nowrap">Nama</th>
                                <th class="text-nowrap">Jabatan</th>
                                <th class="text-nowrap" width="7%">Act</th>
                            </tr>
                        </thead>
                        
                    </table>
            
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
            </div>
        </div>
    </div>
</div>      
@endsection
@section('script')
    @include('layouts.scriptform')
    @include('layouts.scripttable')
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
        
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                var table=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [10],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('employe/get_data_pilih')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nik' },
						{ data: 'no_ktp' },
						{ data: 'nama' },
                        { data: 'jabatan' },
                        { data: 'action' },
						
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $(document).ready(function() {
			

		});

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


        function pilih(){
            $('#modal-employe').modal('show');
            TableManageFixedHeader.init();
        }
        function pilih_data(nik,nama){
            $('#modal-employe').modal('hide');
            $('#nik_pimpinan').val(nik);
            $('#nama_pimpinan').val(nama);
            
        }

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
        
        $('#btn-save').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('master/unit') }}",
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
                                        location.assign("{{url('master/unit')}}");
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
