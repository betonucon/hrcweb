@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Form Shift</li>
    </ol>
    <h1 class="page-header">Form Shift <small>(Penginputan Shift jabatan)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">FORM SHIFT</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- begin panel-body -->
            <div class="panel-body panel-form" style="background: #c1c1c7; padding: 1% !important;">
                <form class="form-horizontal form-bordered" id="mydata" method="post" action="{{ url('master/jabatan') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <input type="hidden" name="id" value="{{$id}}">
                    <ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#default-tab-1" data-toggle="tab" class="nav-link active">
								<span class="d-sm-none">Shift</span>
								<span class="d-sm-block d-none">Shift</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						<!-- begin tab-pane -->
						<div class="tab-pane fade active show" id="default-tab-1">
                            <div class="col-xl-12 ui-sortable">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Jabatan</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="jabatan" value="{{$data->jabatan}}" class="form-control form-control-sm" placeholder="ketik disini...">
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
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('master/shift')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
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
        
        $('#btn-save').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('master/jabatan') }}",
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
                                        location.assign("{{url('master/shift')}}");
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
