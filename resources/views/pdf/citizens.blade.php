<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Ciudadanos</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #cccccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #eeeeee;
        }
    </style>
</head>
<body>
    <h2>Listado de Ciudadanos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ciudad</th>
                <th>Teléfono</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($citizens as $citizen)
                <tr>
                    <td>{{ $citizen->getFullName() }}</td>
                    <td>{{ $citizen->city->name }}</td>
                    <td>{{ $citizen->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
