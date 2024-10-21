
<div class="container">
    @if (count($errors) > 0)
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <h4>Tambah Buku</h4>
    <form method="post" action="{{ route('buku.store') }}">
        @csrf
        <div>Judul <input type="text" name="judul" ></div>
        <div>Penulis <input type="text" name="penulis"></div>
        <div>Harga <input type="text" name="harga"></div>
        <div>Tanggal Terbit<input type="date" name="tgl_terbit"></div>
        <button type="submit">Simpan</button>
    </form>x
    <a href="{{ url('/buku') }}">Kembali</a>
</div>
