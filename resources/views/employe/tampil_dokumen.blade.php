<div class="table-responsive">
    <table class="table table-bordered m-b-0">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Dokumen</th>
                <th width="7%">View</th>
                <th width="7%">Upload</th>
            </tr>
        </thead>
        <tbody>
            @foreach(get_dokumen() as $no=>$dok)
            <tr>
                <td>{{$no+1}}</td>
                <td>File Dokumen {{$dok->dokumen}}</td>
                <td style="text-align:center">
                    @if(cek_dokumen_employe($data->no_ktp,$dok->id)!=0)
                        <a href="{{url_plug()}}/file/dokumen/{{cek_dokumen_employe($data->no_ktp,$dok->id)}}?v={{date('ymdhis')}}" title="{{cek_dokumen_employe($data->no_ktp,$dok->id)}}" target="_blank" class="btn btn-white btn-xs" ><i class="fas fa-clone text-blue"></i></a>
                        <!-- <a href="{{link_dokumen('file/dokumen/'.cek_dokumen_employe($data->no_ktp,$dok->id))}}" class="btn btn-white btn-xs" ><i class="fas fa-cloud-upload-alt text-green"></i></a> -->
                        
                    @else

                    @endif
                </td>
                <td style="text-align:center">
                    <div class="btn-group btn-sm" style="padding: 0px;">
                        <span class="btn btn-white btn-xs" onclick="add_modal({{$data->no_ktp}},{{$dok->id}},`{{$dok->dokumen}}`)"><i class="fas fa-cloud-upload-alt text-green"></i></span>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-dokumen" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataupload" method="post" action="{{ url('employe/import') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <input type="hidden" name="no_ktp" id="no_ktp">
                    <input type="hidden" name="dokumen_id" id="dokumen_id">
                    <input type="hidden" name="nama_dokumen" id="nama_dokumen">
                    <div class="form-group">
                        <label>Upload Dokumen</label>
                        <input type="file" name="file" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="upload-data" >Proses</a>
            </div>
        </div>
    </div>
</div>  

<script>
    $('#notifikasiimport').hide();
    function add_modal(no_ktp,id,nama){
        $('#no_ktp').val(no_ktp)
        $('#dokumen_id').val(id)
        $('#nama_dokumen').val(nama)
        $('#modal-dokumen .modal-title').text('Upload Dokumen '+nama);
        $('#modal-dokumen').modal('show');
    }

    $('#upload-data').on('click', () => {
            
            var form=document.getElementById('mydataupload');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('employe/dokumen') }}",
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
                            $('#modal-dokumen').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal("Success! Your data has been save!", {
									icon: "success",
                            }).then(function(){ 
                                    $('#tampil_dokumen').load("{{url('employe/tampil_dokumen')}}?no_ktp={{$data->no_ktp}}");
                                    
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