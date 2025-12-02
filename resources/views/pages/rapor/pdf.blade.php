<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
        .info { margin-bottom: 15px; }
    </style>
</head>
<body>

<h2>RAPOR SEMESTER</h2>

<div class="info">
    <p><strong>Nama Siswa:</strong> {{ $siswa->name }}</p>
    <p><strong>NIS:</strong> {{ $siswa->username ?? '-' }}</p>
    <p><strong>Kelas:</strong> {{ $siswa->kelas ?? '-' }}</p>
</div>

<table>
    <tr>
        <th>Mapel</th>
        <th>Tugas</th>
        <th>UTS</th>
        <th>UAS</th>
        <th>Nilai Akhir</th>
        <th>Catatan</th>
    </tr>

    @foreach($rapor as $r)
    <tr>
        <td>{{ $r->mapel }}</td>
        <td>{{ $r->nilai_tugas }}</td>
        <td>{{ $r->nilai_uts }}</td>
        <td>{{ $r->nilai_uas }}</td>
        <td><strong>{{ $r->nilai_akhir }}</strong></td>
        <td>{{ $r->catatan }}</td>
    </tr>
    @endforeach
</table>

<br><br>

<table style="border: none; margin-top:40px;">
    <tr style="border:none;">
        <td style="border:none; width:50%;">
            <p>Wali Kelas</p>
            <br><br><br>
            <p>_______________________</p>
        </td>

        <td style="border:none; width:50%; text-align:right;">
            <p>Kepala Sekolah</p>
            <br><br><br>
            <p>_______________________</p>
        </td>
    </tr>
</table>

</body>
</html>
