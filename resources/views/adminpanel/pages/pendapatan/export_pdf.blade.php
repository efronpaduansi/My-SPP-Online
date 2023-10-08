<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pendapatan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="title text-center">
                <h3>DATA PENDAPATAN</h3>
                <h6>Periode: <?php echo date('d M Y'); ?></h6>
                <hr>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-uppercase">
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pendapatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendapatan->invoice->siswa->name }}</td>
                            <td>{{ 'Rp. ' . number_format($pendapatan->amount, 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td colspan="2" class="text-center font-weight-bold"><strong>TOTAL</strong></td>
                    <td colspan="3"><strong>{{ 'Rp. ' . number_format($totalPendapatan, 0, '.', '.') }}</strong></td>
                </tfoot>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </body>

</html>
