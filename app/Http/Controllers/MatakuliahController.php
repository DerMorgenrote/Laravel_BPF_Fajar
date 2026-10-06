<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        return "Menampilkan data matakuliah"; //
    }

    public function create()
    {
        return "Menampilkan form tambah matakuliah";
    }

    public function store(Request $request)
    {
        return "Menyimpan data matakuliah baru";
    }

    public function show(string $kode = null)
    {
        if ($kode) {
            return "Anda mengakses matakuliah : " . $kode; //
        }
        return "Masukkan kode matakuliah!"; //
    }

    public function edit(string $id)
    {
        return "Menampilkan form edit matakuliah";
    }

    public function update(Request $request, string $id)
    {
        return "Mengubah data matakuliah";
    }

    public function destroy(string $id)
    {
        return "Menghapus data matakuliah";
    }
}