    <input type="hidden" name="nik" value="{{$nik}}">
    <!-- <input type="submit"> -->
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Tanggal</label>
        <div class="col-lg-9">
            <input type="text" name="tanggal" value="{{$tanggal}}" readonly class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Kategori</label>
        <div class="col-lg-6">
            <select class="default-select2 form-control form-control-sm" name="status_absen">
                
                <option value="">Pilih</option>
                <option value="1" @if($statusabsen==1) selected @endif >Hadir</option>
                <option value="2" @if($statusabsen==2) selected @endif >Cuti</option>
                <option value="3" @if($statusabsen==3) selected @endif >Sakit</option>
               
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-3 col-form-label">Waktu Absen</label>
        <div class="col-lg-4">
            <input type="text" id="maskeddatetime1" name="jam_masuk" value="{{jam($absenmasuk)}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
        <div class="col-lg-4">
            <input type="text"  id="maskeddatetime2"  name="jam_pulang" value="{{jam($absenpulang)}}"  class="form-control form-control-sm" placeholder="ketik disini...">
        </div>
    </div>
    <script>
        
        $('.default-select2').select2();
        $("#maskeddatetime1").mask("99:99:99");
        $("#maskeddatetime2").mask("99:99:99");
        $("#currency1").inputmask({ alias : "currency", prefix: '','groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false });
    </script>