<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\Pesan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'File Global';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user', 'file'])->orderBy('created_at', 'desc')->get();
        $jumlahPesan = $pesan->count();
        $files = File::where('status', 'public');

        if (request('search')) {
            $files->where('judul_file', 'like', '%' . request('search') . '%')->orWhere('original_filename', 'like', '%' . request('search') . '%');
        }

        $files = $files->get();

        return view('user.file.globalFile', compact('title', 'files', 'pesan', 'jumlahPesan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'File Baru';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user', 'file'])->orderBy('created_at', 'desc')->get();
        $jumlahPesan = $pesan->count();

        return view('user.file.create', compact('title', 'pesan', 'jumlahPesan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        $existingFile = File::where('judul_file', $request->judul_file)->where('id_user', auth()->id())->first();

        $rules = [
            'files' => 'required|file',
            'status' => 'required',
            'judul_file' => $existingFile ? 'required|unique:files|max:255' : 'required'
        ];

        $request->validate($rules);

        // Ambil file
        $file = $request->file('files');
        // Nama file asli
        $originalNameFile = $file->getClientOriginalName();
        // Ekstensi file
        $ekstensi = $file->getClientOriginalExtension();
        // Size file
        if ($file->getSize() < 1024 * 1024) {
            $size = round($file->getSize() / 1024, 1) . ' kb';
        } else {
            $size = round($file->getSize() / (1024 * 1024), 2) . ' mb';
        }
        // Mime type file
        $mime = $file->getMimeType();
        // Generate nama sampul baru
        // Pindahkan file ke folder asli
        $path = 'users/' . Auth::user()->id_user . '/files';
        $namaFileRandom = $file->store($path);

        $data = [
            'id_user' => Auth::user()->id_user,
            'judul_file' => $request->input('judul_file'),
            'original_filename' => $originalNameFile,
            'generate_filename' => $namaFileRandom,
            'status' => $request->input('status'),
            'ekstensi_file' => $ekstensi,
            'mime_type' => $mime,
            'file_size' => $size,
            'deskripsi' => $request->input('deskripsi')
        ];

        File::create($data);

        session()->flash('berhasil', 'Berhasil menambah file');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $id_file)
    {
        $title = 'Detail File';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user', 'file'])->orderBy('created_at', 'desc')->get();
        $jumlahPesan = $pesan->count();
        $file = $id_file;
        $formatDate = Carbon::parse($file->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY', 'Do MMMM YYYY');

        return view('user.file.detail', compact('title', 'file', 'formatDate', 'pesan', 'jumlahPesan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        $title = 'Edit File';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user', 'file'])->orderBy('created_at', 'desc')->get();
        $jumlahPesan = $pesan->count();
        if (is_null($file)) {
            session()->flash('gagal', 'File tidak ada');
            return redirect()->back();
        }
        if ($file->id_user != Auth::id()) abort(404);

        return view('user.file.edit', compact('title', 'file', 'pesan', 'jumlahPesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        $rules = [
            'files' => 'file',
            'status' => 'required',
            'judul_file' => ($file->judul_file === request('judul_file')) ? 'required' : 'required|unique:files|max:255'
        ];

        $request->validate($rules);

        if ($request->file('files')) {
            // Ambil file
            $fileInput = $request->file('files');
            // Nama file asli
            $originalNameFile = $fileInput->getClientOriginalName();
            // Ekstensi file
            $ekstensi = $fileInput->getClientOriginalExtension();
            // Size file
            if ($fileInput->getSize() < 1024 * 1024) {
                $size = round($fileInput->getSize() / 1024, 1) . ' kb';
            } else {
                $size = round($fileInput->getSize() / (1024 * 1024), 2) . ' mb';
            }
            // Mime type file
            $mime = $fileInput->getMimeType();
            // Generate nama sampul baru
            // Pindahkan file ke folder asli
            $path = 'users/' . Auth::user()->id_user . '/files';
            $namaFileRandom = $fileInput->store($path);
            Storage::delete($file->generate_filename);
        } else {
            $originalNameFile = $file->original_filename;
            $ekstensi = $file->ekstensi_file;
            $mime = $file->mime_type;
            $size = $file->file_size;
            $namaFileRandom = $file->generate_filename;
        }

        $data = [
            'id_user' => Auth::user()->id_user,
            'judul_file' => $request->input('judul_file'),
            'original_filename' => $originalNameFile,
            'generate_filename' => $namaFileRandom,
            'status' => $request->input('status'),
            'ekstensi_file' => $ekstensi,
            'mime_type' => $mime,
            'file_size' => $size,
            'deskripsi' => $request->input('deskripsi')
        ];

        $file->update($data);

        session()->flash('berhasil', 'Berhasil menambah file');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        if ($file->id_user != auth()->id()) {
            session()->flash('gagal', 'File tidak ada.');
            return redirect()->back();
        }
        Storage::delete($file->generate_filename);
        $file->destroy($file->id_file);

        session()->flash('berhasil', 'Berhasil menghapus file');
        return redirect()->back();
    }

    public function download($id_file)
    {
        $file = File::where('id_file', $id_file)->first();

        $path = public_path('storage/' . $file->generate_filename);
        $headers = [
            'Content-Type' => 'application/octet-stream'
        ];

        return response()->download($path, $file->original_filename, $headers);
    }

    public function downloadPrivate($id_file, $id_user, $generate_filename)
    {
        $path = 'users/' . $id_user . '/files/' . $generate_filename;
        $file = File::where('id_file', $id_file)
            ->where('id_user', $id_user)
            ->where('generate_filename', $path)
            ->first();

        if ($file === null) {
            session()->flash('gagal', 'Tidak ada file');
            return redirect()->back();
        }

        session()->flash('berhasil', 'File berhasil didownload');
        session()->flash('download', $file->id_file);
        return redirect()->back();
    }

    public function downloadPublic($id_user, $filename)
    {
        $path = 'users/' . $id_user . '/files/' . $filename;
        $file = File::where('generate_filename', $path)->first();

        if ($file === null) {
            session()->flash('gagal', 'Tidak ada file');
            return redirect()->back();
        }

        session()->flash('berhasil', 'File berhasil didownload');
        session()->flash('download', $file->id_file);
        return redirect()->back();
    }
}
