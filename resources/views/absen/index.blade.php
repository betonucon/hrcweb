@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Absensi Harian</li>
    </ol>
    <h1 class="page-header">Absensi Harian <small> (tampilan daftar gaji bulanan)</small></h1>
    <div class="btn-group" style="margin-bottom:1%">
        <button class="btn btn-success" onclick="download_excel(`{{$tanggal}}`)"><i class="fas fa-upload"></i> Download Excel</button>
        <button class="btn btn-success" onclick="filter_tanggal()"><i class="fas fa-search"></i> Filter</button>
        
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
        <div class="panel-heading ui-sortable-handle">
            <h4 class="panel-title">Periode : {{$tanggal}}</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div id="tampil_dashboard"></div>
            <div class="table-responsive ">
                <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap" width="5%">No</th>
                            <th class="text-nowrap" width="7%">NIK</th>
                            <th class="text-nowrap" >Nama</th>
                            <th class="text-nowrap" width="10%" >Status</th>
                            <th class="text-nowrap" width="8%" >Tanggal</th>
                            <th class="text-nowrap" width="6%" >Masuk</th>
                            <th class="text-nowrap"  width="6%" >Pulang</th>
                            <th class="text-nowrap" width="4%" >Telat</th>
                            <th class="text-nowrap" width="8%">Act</th>
                        </tr>
                    </thead>
                    
                </table>
           
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Absensi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notnotifikasiabsen">
                    <div id="notifikasiabsen"></div>
                    
                </div>
                
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/jabatan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <div id="tampil-form"></div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="btn-save" >Proses</a>
            </div>
        </div>
    </div>
</div>           
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Tanggal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" id="tanggal_cari" class="form-control" />
                </div>
                
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="import-data" >Proses</a>
            </div>
        </div>
    </div>
</div>           
@endsection

@section('script')
    @include('layouts.scripttable')
    @include('layouts.scriptform')
    <style>
        
    </style>
@endsection
@push('datatable')
    <script type="text/javascript">
        /*
        Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
        Version: 4.6.0
        Author: Sean Ngu
        Website: http://www.seantheme.com/color-admin/admin/
        */
        
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                var table=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [20, 40, 60],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('absen/get_data')}}?tanggal={{$tanggal}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nik' },
						{ data: 'nama' },
						{ data: 'statusabsen' },
						{ data: 'tanggal_absen' },
						{ data: 'jam_masuk' },
						{ data: 'jam_pulang' },
						{ data: 'selisih_masuk' },
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
			TableManageFixedHeader.init();

		});
        
        $('#tanggal_cari').datepicker({
			format:"yyyy-mm-dd",
            autoclose: true,
		});

        $('#notnotifikasiabsen').hide();
        // $('body .dropdown-toggle').dropdown(); 
        function delete_data(id){
           
			swal({
				title: "Yakin perbaharui data ini ?",
				text: "semua data potongan karyawan akan diperbahuri",
				type: "warning",
				icon: "info",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('employe/delete_data')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('employe/get_data')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        function filter_tanggal(){
            $('#modal-import').modal('show')
        }
        function add_data(id,tanggal){
            $('#notnotifikasiabsen').hide();
            $('#modal-form').modal('show');
            $('#tampil-form').load("{{url('absen/modal')}}?nik="+id+"&tanggal="+tanggal)
        }
        $('#btn-save').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('absen') }}",
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
                            $('#modal-form').modal('hide');
                            swal("Success! Your data has been save!", {
									icon: "success",
                            }).then(function(){ 
                                    
                                }
                            );  
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notnotifikasiabsen').show();
                            $('#notifikasiabsen').html(msg);
                        }
                        
                        
                    }
                });
        });
        $('#import-data').on('click', () => {
            var tanggal=$('#tanggal_cari').val();
            location.assign("{{url('absen')}}?tanggal="+tanggal)
        });
    </script>
@endpush

@push('ajax')
    <script src="{{url_plug()}}/js/app.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script type="text/javascript">
     
     Pusher.logToConsole = true;

    var pusher = new Pusher('99efd5a3e253906ee0ed', {
        cluster: 'ap1',
        // forceTLS: true
    });

    var channel = pusher.subscribe('my-chanel');
        channel.bind('kirim-created', function(data) {
            var table=$('#data-table-fixed-header').DataTable();
                table.ajax.url("{{ url('absen/get_data')}}?tanggal={{$tanggal}}").load();
        });
    </script>
@endpush
