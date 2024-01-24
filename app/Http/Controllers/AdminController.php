<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Admin Dashboard';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user','file'])->orderBy('created_at','desc')->get();
        $jumlahPesan = $pesan->count();
        $usersQuery = User::whereIn('status', [0, 1]);
        if (request('search')) {
            $searchTerm = '%' . request('search') . '%';
            $usersQuery->where(function ($query) use ($searchTerm) {
                $query->where('fullname', 'like', $searchTerm)
                    ->orWhere('username', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }
        $users = $usersQuery->paginate(10);
        $countUsers = User::whereIn('status', [0, 1])->count();
        $userVerified = User::where('status', 1)->count();
        $userUnverified = User::where('status', 0)->count();
        $countFiles = File::count();

        return view('user.admin.index', compact('title', 'users', 'countUsers', 'countFiles', 'userVerified', 'userUnverified', 'pesan', 'jumlahPesan'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Edit Profil';
        $pesan = Pesan::where('id_penerima', auth()->id())->with(['user','file'])->orderBy('created_at','desc')->get();
        $jumlahPesan = $pesan->count();
        $user = User::where('id_user', $id)->first();

        return view('user.admin.edit', compact('title', 'user', 'pesan', 'jumlahPesan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $id_user)
    {
		if (Auth::user()->status != 2) {
			abort(404);
		}

        $errors = [
            'fullname.required' => 'Nama lengkap tidak boleh kosong!',
            'fullname.regex' => 'Nama lengkap hanya boleh mengandung huruf!',
            'fullname.min' => 'Nama lengkap harus memiliki setidaknya 5 karakter!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.min' => 'Username harus memiliki setidaknya 5 karakter!',
            'username.unique' => 'Username sudah digunakan!',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password harus memiliki setidaknya 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ];

        $user = $id_user;
        $rules = [
            'fullname' => 'required|regex:/^[a-zA-Z\s]+$/|min:5',
            'username' => $user->username == $request->input('username') ? 'required' : 'required|min:5|unique:users',
            'email' => $user->email == $request->input('email') ? 'required' : 'required|email|unique:users'
        ];

        if (!$request->input('password') || Hash::check($request->input('password'), $user->password)) {
            $validasiData = $request->validate($rules, $errors);
        } else {
            $rules['password'] = 'required|min:6';
            $validasiData = $request->validate($rules, $errors);
            $validasiData['password'] = Hash::make($validasiData['password']);
        }

        $user->update($validasiData);

		session()->flash('berhasil', 'Berhasil mengedit data');
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        if ($id_user == Auth::id()) {
            session()->flash('gagal', 'Admin tidak boleh dihapus');
            return redirect()->back();
        }

        Storage::deleteDirectory('users/' . $id_user);
        User::destroy($id_user);
        // Pesan::where('id_pengirim', $id_user)->delete();
        File::where('id_user', $id_user)->delete();

        session()->flash('berhasil', 'Berhasil menghapus user');
        return redirect()->back();
    }

    public function verified($id_user)
    {
        User::where('id_user', $id_user)->update(['status' => 1]);
        session()->flash('success', 'User berhasil diverifikasi');
        return redirect()->back();
    }
}
