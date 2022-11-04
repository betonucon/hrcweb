    <input type="hidden" name="id" value="{{$id}}">
    <!-- <input type="submit"> -->
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Kategori</label>
        <div class="col-lg-6">
            <select class="default-select2 form-control form-control-sm" name="kategori_tunjangan_id">
                
                <option value="">Pilih</option>
                @foreach(get_kategoritunjangan() as $tunj)
                    @if($id==0)
                    <option value="{{$tunj->id}}">{{$tunj->kategori_tunjangan}}</option>
                    @else
                    <option value="{{$tunj->id}}" @if($data->kategori_tunjangan_id=$tunj->id) selected @endif >{{$tunj->kategori_tunjangan}}</option>
                    @endif
                    
                @endforeach
            
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Keterangan</label>
        <div class="col-lg-9">
            <input type="text" name="tunjangan" value="{{$data->tunjangan}}" class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Nilai</label>
        <div class="col-lg-7">
            <input type="text" name="nilai" value="{{$data->nilai}}" id="currency1" style="text-align: right;" class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <script>
        
        $('.default-select2').select2();
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>