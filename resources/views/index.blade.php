<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
</head>
<body>
    @if (Session::has('pesan'))
        <div class="alert alert-success">{{Session::get('pesan')}}</div>
    @endif
    @if ($cari)
    @if (count($data_buku))
        <div class="alert alert-success">Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata: <strong>{{ $cari }}</strong>
        </div>
    @else
        <div class="alert alert-warning">
            <h4>Data {{ $cari }} tidak ditemukan</h4>
            <a href="/buku" class="btn btn-warning">Kembali</a>
        </div>
    @endif
@endif
@include('buku.search')
    <a href="{{route('buku.create')}}" class="btn btn-primary float-end">Tambah Buku</a>
    <table class="table table-stripped table-data">
        <thead>
            <tr>
                <th>id</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Action</th>
                <th>New</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $buku )
                <tr>
                    <td>{{$buku->id}}</td>
                    <td>{{$buku->judul}}</td>
                    <td>{{$buku->penulis}}</td>
                    <td>{{"Rp.".number_format($buku->harga,2,',','.')}}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                    <td>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <button><a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning" style="text-decoration: none;color:black">Update</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div>{{$data_buku->links('pagination::bootstrap-5')}}</div> --}}
    <p style="size:14px;">Total buku ada : {{$jumlah_buku}}</p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#table-data').DataTable();
        });
    </script>
</body>
</html>
