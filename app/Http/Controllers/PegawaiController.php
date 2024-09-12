<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawai = pegawai::get();
        return view('data-master.pegawai', compact('pegawai'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|max:50',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'photo' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'nama.required' => 'Masukkan nama!!',
            'alamat.required' => 'Masukkan alamat!!',
            'tanggal_lahir.required' => 'Masukkan tanggal lahir!!',
            'photo.required' => 'Masukkan file!!',
            'photo.mimes' => 'Format file harus berupa: jpeg, png, jpg, gif',
            'photo.max' => 'Ukuran file maksimal adalah 2MB',
        ]);
        $newName = '';
        if($request->file('photo')){
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->nama.'-'.now()->timestamp.'.'.$extension;
            $request->file('photo')->storeAs('foto', $newName);
        }
        $request['foto'] = $newName;
        $pegawai = pegawai::create($request->all());
        return redirect('/pegawai')->with('success', 'Data anda berhasil disimpan');
    }

    public function update(Request $request, $id){
        $pegawai = pegawai::findOrFail($id);
        $pegawai->nama = $request->input('nama');
        $pegawai->alamat = $request->input('alamat');
        $pegawai->tanggal_lahir = $request->input('tanggal_lahir');
        if ($request->hasFile('photo')){
            $file = storage_path('app/public/foto/') . $pegawai->foto;
            if (file_exists($file)) {
                unlink($file);
            }
            $file = $request->file('photo');
            $extension = $request->file('photo')->getClientOriginalExtension();
            $newName = $request->nama.'-'.now()->timestamp.'.'.$extension;
            $request->file('photo')->storeAs('foto', $newName);
            $pegawai->foto = $newName;
        }
        $pegawai->update();
        return redirect('/pegawai')->with('success', 'Data anda berhasil diedit');
    }

    public function delete($id){
        $pegawai = pegawai::findOrFail($id);
        $file = storage_path('app/public/foto/') . $pegawai->foto;
        if (file_exists($file)) {
            unlink($file);
        }
        $pegawai->delete();
        return redirect('/pegawai')->with('success', 'Data anda berhasil dihapus');
    }
}
