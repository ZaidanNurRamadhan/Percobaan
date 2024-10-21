<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buku;
use Illuminate\Auth\Events\Validated;
use Illuminate\Pagination\Paginator;

class bukucontroller extends Controller
{

    public function index()
{
    $data_buku = Buku::all();
    $jumlah_buku = Buku::count();
    $no = 0;
    $cari = false;
    return view('index', compact('data_buku', 'no', 'jumlah_buku', 'cari'));
}

public function search(Request $request)
{
    Paginator::useBootstrapFive();
    $batas = 5;
    $cari = $request->kata;
    $data_buku = Buku::where('judul', 'like', "%$cari%")->orWhere('judul', 'like', "%$cari%")->paginate($batas);
    $jumlah_buku = Buku::count();
    $no = $batas * ($data_buku->currentPage() - 1);
    return view('index', compact('jumlah_buku', 'data_buku', 'no', 'cari'));
}


    public function store(Request $request){
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ],[
            'required' => ':attribute wajib diisi',
            'string' => ':attribute diisi dengan string',
            'numeric' => ':attribute harus diisi dengan angka',
            'date' => ':attribute harus diisi dengan tanggal',
            'max' => ':attribute minimal berisi :max karakter'
        ]);
        $buku = new Buku();
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');
        $buku->save();
        return redirect('/buku')->with('pesan','Data buku berhasil disimpan');
    }

    public function destroy($id){
        $buku = buku::find($id);
        $buku->delete();

        return redirect(to: '/buku')->with('pesan','Data buku berhasil dihapus');
    }

    public function edit($id)
{
    $buku = Buku::find($id);
    return view('buku.edit', compact('buku'));
}


    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string',
        'penulis' => 'required|string|max:30',
        'harga' => 'required|numeric',
        'tgl_terbit' => 'required|date'
    ],[
        'required' => ':attribute wajib diisi',
        'string' => ':attribute diisi dengan string',
        'numeric' => ':attribute harus diisi dengan angka',
        'date' => ':attribute harus diisi dengan tanggal',
        'max' => ':attribute minimal berisi :max karakter'
    ]);
    $buku = Buku::find($id);
    $buku->judul = $request->input('judul');
    $buku->penulis = $request->input('penulis');
    $buku->harga = $request->input('harga');
    $buku->tgl_terbit = $request->input('tgl_terbit');
    $buku->save();

    return redirect()->route('buku.index')->with('pesan', 'Buku berhasil diupdate');
}


}
