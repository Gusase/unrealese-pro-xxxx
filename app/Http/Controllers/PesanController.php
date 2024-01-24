<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\File;
use Carbon\Carbon;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Edit File';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user', 'file'])->orderBy('created_at', 'desc')->get();

        return view('user.pesan.index', compact('title', 'pesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePesanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $id_pesan)
    {
        $title = 'Detail File';
        $pesan = $id_pesan;
        $file = File::where('id_file', $pesan->file->id_file)->first();
        $formatDate = Carbon::parse($file->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY', 'Do MMMM YYYY');

        return view('user.pesan.detail', compact('title', 'file', 'formatDate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesan $pesan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePesanRequest $request, Pesan $pesan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesan $id_pesan)
    {
        if (!$id_pesan) {
            session()->flash('gagal', 'Gagal hapus pesan');
            return redirect()->back();
        }

        $id_pesan->destroy($id_pesan->id_pesan);

        session()->flash('berhasil', 'Berhasil menghapus pesan');
        return redirect()->back();
    }
}
