<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Http\Requests\StorePesanRequest;
use App\Http\Requests\UpdatePesanRequest;
use App\Models\File;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Notifikasi';
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
    public function store(StorePesanRequest $request, $id_file)
    {
        $user = User::where('username', request('username'))->first();
        
        if (!$user) {
            session()->flash('gagal', 'username tidak ada');
            return redirect()->back();
        }

        $data = [
            'id_pengirim' => auth()->id(),
            'id_penerima' => $user->id_user,
            'id_file' => $id_file,
            'pesan' => request('pesan'),
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ];

        Pesan::create($data);

        session()->flash('berhasil', 'berhasil mengirim file');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesan $id_pesan)
    {
        $title = 'Detail File';
        $pesan = $id_pesan;
        if ($pesan == null) {
            session()->flash('gagal', 'File tidak ada');
            return redirect()->back();
        }
        $file = File::where('id_file', $pesan->id_file)->first();
        $formatDate = Carbon::parse($file->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY', 'Do MMMM YYYY');

        return view('user.pesan.detail', compact('title', 'pesan', 'file', 'formatDate'));
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
    public function destroy($id_pesan)
    {
        $pesan = Pesan::where('id_pesan', $id_pesan)->first();
        if (!$pesan) {
            session()->flash('gagal', 'Gagal menghapus pesan');
            return redirect()->back();
        }

        $pesan->destroy($id_pesan);

        session()->flash('berhasil', 'Berhasil menghapus pesan');
        return redirect()->back();
    }
}
