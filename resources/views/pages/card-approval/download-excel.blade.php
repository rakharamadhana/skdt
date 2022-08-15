<!DOCTYPE html>
<html>

<head>
    <title>Export Data</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    @php
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Export Data KPIT.xls");
    @endphp

    <table border="1">
        <thead>
            <tr>
                <th style="background-color: #34495e; color: white;">NO</th>
                <th style="background-color: #34495e; color: white;">SUBMISSION DATE</th>
                <th style="background-color: #34495e; color: white;">SUBMISSION BY</th>
                <th style="background-color: #34495e; color: white;">ID</th>
                <th style="background-color: #34495e; color: white;">STATUS</th>
                <th style="background-color: #34495e; color: white;">NAMA PESERTA</th>
                <th style="background-color: #34495e; color: white;">GENDER</th>
                <th style="background-color: #34495e; color: white;">NOMOR PASSPORT</th>
                <th style="background-color: #34495e; color: white;">PASSPORT BERLAKU HINGGA</th>
                <th style="background-color: #34495e; color: white;">NIK</th>
                <th style="background-color: #34495e; color: white;">TEMPAT LAHIR</th>
                <th style="background-color: #34495e; color: white;">TANGGAL LAHIR</th>
                <th style="background-color: #34495e; color: white;">AGAMA</th>
                <th style="background-color: #34495e; color: white;">STATUS HUBUNGAN</th>
                <th style="background-color: #34495e; color: white;">PEND TERAKHIR</th>
                <th style="background-color: #34495e; color: white;">NAMA IBU</th>
                <th style="background-color: #34495e; color: white;">ALAMAT INDONESIA</th>
                <th style="background-color: #34495e; color: white;">TELP ID</th>
                <th style="background-color: #34495e; color: white;">TELP TW</th>
                <th style="background-color: #34495e; color: white;">ALAMAT TW EN</th>
                <th style="background-color: #34495e; color: white;">ALAMAT TW CN</th>
                <th style="background-color: #34495e; color: white;">TELP</th>
                <th style="background-color: #34495e; color: white;">LINE ID</th>
                <th style="background-color: #34495e; color: white;">JENJANG PEND YANG DITEMPUH</th>
                <th style="background-color: #34495e; color: white;">PROGRAM STUDI</th>
                <th style="background-color: #34495e; color: white;">UNIVERSITAS/SEKOLAH</th>
                <th style="background-color: #34495e; color: white;">TAHUN DAN TERM MASUK</th>
                <th style="background-color: #34495e; color: white;">PERNAH MEMILIKI REK BNI</th>
                <th style="background-color: #34495e; color: white;">KEINGINAN MEMBUKA DAN MENGGUNAKAN REK BNI DI TW</th>
                <th style="background-color: #34495e; color: white;">SUDAH PERNAH MEMILIKI INTERNET BANKING BNI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list_data as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->created_at}}</td>
                <td>{{$data->created_by_user->email}}</td>
                <td>{{$data->card_number}}</td>
                <td>{{$data->statusToText()}}</td>
                <td>{{$data->fullname}}</td>
                <td>{{$data->genderToText()}}</td>
                <td>{{$data->passport}}</td>
                <td>{{$data->passport_date}}</td>
                <td>"{{$data->citizen_id_card}}"</td>
                <td>{{$data->birth_place}}</td>
                <td>{{$data->birthday}}</td>
                <td>{{$data->religion}}</td>
                <td>{{$data->relation_status}}</td>
                <td>{{$data->last_education}}</td>
                <td>{{$data->mother_name}}</td>
                <td>{{$data->address_id}}</td>
                <td>"{{$data->phone_id}}"</td>
                <td>"{{$data->phone_tw}}"</td>
                <td>{{$data->address_tw_en}}</td>
                <td>{{$data->address_tw_cn}}</td>
                <td>"{{$data->phone}}"</td>
                <td>{{$data->line_id}}</td>
                <td>{{$data->degree}}</td>
                <td>{{$data->prodi}}</td>
                <td>{{$data->university}}</td>
                <td>{{$data->year_and_term}}</td>
                <td>{{$data->is_bni}}</td>
                <td>{{$data->want_bni}}</td>
                <td>{{$data->want_bni_bank}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>