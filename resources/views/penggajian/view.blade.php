@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Slip Gaji</li>
    </ol>
    <h1 class="page-header">Slip Gaji <small>(Detail slip gaji bulanan)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Slip Gaji Bulan {{bulan_int($bulan)}} {{$tahun}}</h4>
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
								<span class="d-sm-none">Slip Gaji</span>
								<span class="d-sm-block d-none">Slip Gaji</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						
                        <div class="tab-pane fade active show" id="default-tab-1">
                            <div class="col-xl-12 ui-sortable">
                                
                                <div id="tampil_slip"></div>
                                
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </form>
            </div>
            <!-- end panel-body -->
        </div>
        <div class="btn-group" style="margin-bottom:1%">
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('slip')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
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
        $("#currencysum4").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        $("#currencysum5").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
        
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
       $('#tampil_slip').load("{{url('slip/slip-gaji')}}?id={{$id}}&bulan={{$bulan}}&tahun={{$tahun}}")
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
                    url: "{{ url('employe/penggajian/gaji_pokok') }}",
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
