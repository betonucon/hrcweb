@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Form Tunjangan</li>
    </ol>
    <h1 class="page-header">Form Tunjangan <small>(Penginputan tunjangan jabatan)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">FORM TUNJANGAN</h4>
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
                
                    <ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Tunjangan {{$data->jabatan}}</span>
								<span class="d-sm-block d-none">Tunjangan {{$data->jabatan}}</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
                            <div class="col-xl-12 ui-sortable">
                                <div class="btn-group" style="margin-bottom:1%">
                                    <button class="btn btn-success btn-sm" onclick="add_modal(0)"><i class="fas fa-plus"></i> Tambah</button>
                                    
                                </div>
                                <div class="table-responsive ">
                                    <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-nowrap" width="5%">No</th>
                                                <th class="text-nowrap" >Keterangan</th>
                                                <th class="text-nowrap"  width="25%">Kategori</th>
                                                <th class="text-nowrap"  width="11%">Nilai</th>
                                                <th class="text-nowrap" width="3%">Act</th>
                                            </tr>
                                        </thead>
                                        
                                    </table>
           
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                
            </div>
            <!-- end panel-body -->
        </div>
        
    </div>
</div>
<div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tunjangan/Kontribusi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/tunjangan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <input type="hidden" name="jabatan_id" value="{{$data->id}}">
                    <div id="form-modal"></div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="btn-save" >Proses</a>
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
                    ajax:"{{ url('master/tunjangan/get_data_tunjangan')}}?id={{$data->id}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'tunjangan' },
						{ data: 'kategori' },
						{ data: 'nominal' },
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
       
        
		$('#notifikasiimport').hide();
		$('.default-select2').select2();
        
        function add_modal(id){
            $('#modal-add').modal('show');
            $('#form-modal').load("{{url('master/tunjangan/modal')}}?id="+id);
        }
        $('#btn-save').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('master/tunjangan') }}",
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
                            $('#modal-add').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal("Success! Your data has been save!", {
									icon: "success",
                            }).then(function(){ 
                                    var table=$('#data-table-fixed-header').DataTable();
                                    table.ajax.url("{{ url('master/tunjangan/get_data_tunjangan')}}?id={{$data->id}}").load();
                                    
                                }
                            );  
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasiimport').show();
                            $('#notifikasiimport').html(msg);
                        }
                        
                        
                    }
                });
        });
        
        
    </script>
@endpush
