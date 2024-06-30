<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detection Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Common styles */
        body {
            background-color: #ffffff;
            color: #0e0d0d;
            position: relative;
            overflow-x: hidden;
        }

        /* Background image with reduced blur */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/background1.png') }}');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            opacity: 0.9;
            z-index: -1;
            filter: blur(2px);
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 20px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #244B93;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #244B93;
        }

        th,
        td {
            border: 1px solid #244B93;
            padding: 8px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #3FA2F6;
            color: #ffffff;
        }

        td {
            background-color: #ffffff;
            color: #121314;
        }

        .btn-primary {
            background-color: #279EFF;
            border-color: #279EFF;
        }

        .btn-primary:hover {
            background-color: #009EFF;
            border-color: #009EFF;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Detection Details</h1>
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $detection->nama }}</td>
            </tr>
            <tr>
                <th>Latitude</th>
                <td>{{ $detection->latitude }}</td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td>{{ $detection->longitude }}</td>
            </tr>
            <tr>
                <th>Jam Operasi</th>
                <td>{{ $detection->jam_operasi }}</td>
            </tr>
            <tr>
                <th>Fuel Level (%)</th>
                <td>{{ $detection->persentase_bahan_bakar }}%</td>
            </tr>
        </table>
        <a href="{{ route('detections.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</body>

</html>
