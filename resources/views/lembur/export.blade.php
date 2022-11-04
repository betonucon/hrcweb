<table>
    <thead>
        <tr>
            <th colspan="7" align="center"><b>DAFTAR LEMBUR KARYAWAN</b></th>
        </tr>
        <tr>
            <th colspan="7" align="center"><b>PERIODE {{$mulai}} s/d {{$sampai}}</b></th>
        </tr>
    </thead>
</table>
<table>
    <thead>
        <tr>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="50px">No</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="100px">NIK</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" width="200px">Nama</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="100px">Tanggal</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="100px">Mulai</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="100px">Sampai</th>
            <th style="background:aqua;color:#000;border:solid 1px #000;font-weight:bold" align="center" width="100px">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datanya as $no=>$o)
        <tr>
            <td style="border:solid 1px #000">{{$no+1}}</td>
            <td style="border:solid 1px #000">{{$o->nik}}</td>
            <td style="border:solid 1px #000">{{$o->memploye['nama']}}</td>
            <td style="border:solid 1px #000">{{$o->tanggal}}</td>
            <td style="border:solid 1px #000">{{$o->jam_masuk}}</td>
            <td style="border:solid 1px #000">{{$o->jam_pulang}}</td>
            <td style="border:solid 1px #000">{{$o->total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>