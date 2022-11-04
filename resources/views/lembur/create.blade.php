@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Form Pendapatan Bulanan</li>
    </ol>
    <h1 class="page-header">Form Pendapatan Bulanan <small>(Detail Pendapatan Bulanan)</small></h1>
    
    
                      
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <!-- begin panel-heading -->
            <div class="panel-heading ui-sortable-handle">
                <h4 class="panel-title">Pendapatan Bulanan</h4>
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
								<span class="d-sm-none">1.Gaji Pokok</span>
								<span class="d-sm-block d-none">1.Gaji Pokok</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-2" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">2.Tunjangan</span>
								<span class="d-sm-block d-none">2.Tunjangan</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-3" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">3.Kontribusi</span>
								<span class="d-sm-block d-none">3.Kontribusi</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#default-tab-4" data-toggle="tab" class="nav-link">
								<span class="d-sm-none">4.Potongan</span>
								<span class="d-sm-block d-none">4.Potongan</span>
							</a>
						</li>
						
					</ul>
                    <div class="tab-content">
						
                        <div class="tab-pane fade active show" id="default-tab-1">
                            <div class="col-xl-12 ui-sortable">
                                
                                
                                <div class="row" style="background:#fafaff">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">1.Gaji Pokok</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currency1" name="gaji_pokok" value="{{$data->gaji_pokok}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="btn-group" style="margin-bottom:1%;margin-top:1%;margin-left:1%">
                                <span class="btn btn-success btn-sm" id="btn-save"><i class="fas fa-save"></i> Simpan</span>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="default-tab-2">
                            <div class="col-xl-12 ui-sortable">
                                
                                
                                <div class="row" style="background:#fafaff">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Tunjangan dibayar</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currencysum1" disabled value="{{sum_tunjangan($data->id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
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
                                    <div class="col-md-12">
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
                                    
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="default-tab-3">
                            <div class="col-xl-12 ui-sortable">
                                
                                
                                <div class="row" style="background:#fafaff">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Kontribusi dibayar</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currencysum2" disabled value="{{sum_kontribusi($data->id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="row" style="background:#fafaff;border:solid 1px #d1d1d1;margin-top:2%">
                                    
                                    <div class="col-md-12">
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
                        
                        <div class="tab-pane fade" id="default-tab-4">
                            <div class="col-xl-12 ui-sortable">
                                
                                
                                <div class="row" style="background:#fafaff">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Potongan Bulanan</label>
                                            <div class="col-lg-3">
                                                <input type="text" id="currencysum4" disabled value="{{sum_kontribusi($data->id)}}" class="form-control form-control-sm" placeholder="ketik disini...">
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="row" style="background:#fafaff;border:solid 1px #d1d1d1;margin-top:2%">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label">Rincian Potongan Tetap</label>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-b-0">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">#</th>
                                                            <th>Keterangan</th>
                                                            <th width="15%">Nilai</th>
                                                            <th width="15%">Mulai</th>
                                                            <th width="15%">Sampai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach(get_potongan($data->no_ktp,$data->nik) as $nox=>$pot)
                                                            <tr>
                                                                <td>{{$nox+1}}</td>
                                                                <td>{{$pot->potongan}}</td>
                                                                <td>{{uang($pot->nilai)}}</td>
                                                                <td>{{$pot->mulai}}</td>
                                                                <td>{{$pot->sampai}}</td>
                                                            </tr>
                                                        @endforeach   
                                                    </tbody>
                                                </table>
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
            <button class="btn btn-sm btn-danger" onclick="location.assign(`{{url('employe/penggajian')}}`)"><i class="fas fa-arrow-alt-circle-right fa-flip-horizontal"></i> Kembali </button>
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
