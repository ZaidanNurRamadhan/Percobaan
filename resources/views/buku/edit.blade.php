<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@if (count($errors) > 0)
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<form action="{{ route('buku.update', $buku->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="judul">Judul Buku</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
    </div>
    <div class="form-group">
        <label for="penulis">Penulis</label>
        <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
    </div>
    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
    </div>
    <div class="form-group">
        <label for="tgl_terbit">Tanggal Terbit</label>
        <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}">
    </div>
    <button type="submit" class="btn btn-primary">Update Buku</button>
</form>
