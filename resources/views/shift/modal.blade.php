    <input type="text" name="id" value="{{$data->id}}">
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Jam Masuk</label>
        <div class="col-lg-4">
            <div class="input-group bootstrap-timepicker">
                <input id="timepicker1" name="masuk" type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-clock"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-4 col-form-label">Jam Pulang</label>
        <div class="col-lg-4">
            <div class="input-group bootstrap-timepicker">
                <input id="timepicker2" name="pulang" type="text" class="form-control">
                <span class="input-group-addon"><i class="fa fa-clock"></i></span>
            </div>
        </div>
    </div>

    <script>
       $("#timepicker1").mask("99:99:99");
       $("#timepicker2").mask("99:99:99");
    </script>