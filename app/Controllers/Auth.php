<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MuzakiModel;
use App\Models\MustahikModel;
use App\Models\UsersModel;

class Auth extends BaseController
{
    use ResponseTrait;
    protected $user;

    public function __construct()
    {
        $this->user = new \App\Models\UsersModel();
    }

    public function index()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $this->user->where('username', $username)->first();

            if ($user) {
                if (password_verify($password, $user->password)) {
                    // data session dasar
                    $sessionData = [
                        'user_id'   => $user->id,
                        'username'  => $user->username,
                        'akses'     => $user->akses,
                        'isLoggedIn' => true
                    ];

                    // jika mustahik → ambil profil
                    if ($user->akses === 'petugas' || $user->akses === 'admin' || $user->akses === 'pimpinan') {
                        $petugasModel = new \App\Models\PetugasModel();
                        $petugas = $petugasModel->where('id_users', $user->id)->first();
                        $sessionData['profil'] = $petugas;
                    }

                    if ($user->akses === 'mustahik') {
                        $mustahikModel = new \App\Models\MustahikModel();
                        $mustahik = $mustahikModel->where('id_users', $user->id)->first();
                        $sessionData['profil'] = $mustahik;
                    }

                    // jika muzaki → ambil profil
                    if ($user->akses === 'muzaki') {
                        $muzakiModel = new \App\Models\MuzakiModel();
                        $muzaki = $muzakiModel->where('id_users', $user->id)->first();
                        $sessionData['profil'] = $muzaki;
                    }

                    // simpan ke session
                    session()->set($sessionData);

                    // redirect sesuai role
                    switch ($user->akses) {
                        case 'admin':
                        case 'petugas':
                        case 'pimpinan':
                            return redirect()->to(base_url('dashboard'));
                        case 'mustahik':
                            return redirect()->to(base_url('dashboard'));
                        case 'muzaki':
                            return redirect()->to(base_url('dashboard'));
                        default:
                            return redirect()->to(base_url('/'));
                    }
                } else {
                    return redirect()->back()->with('error', 'Password salah');
                }
            } else {
                return redirect()->back()->with('error', 'User tidak ditemukan');
            }
        }

        return view('login');
    }

    public function register()
    {
        helper(['form', 'url']);

        $data = [];

        if ($this->request->getMethod() == 'POST') {
            // Validasi
            $rules = [
                'nama' => 'required|min_length[3]|max_length[100]',
                'telepon' => 'required|min_length[10]|max_length[20]',
                'alamat' => 'required',
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'role' => 'required|in_list[muzaki,mustahik]'
            ];

            if ($this->validate($rules)) {
                $userModel = new UsersModel();
                $muzakiModel = new MuzakiModel();
                $mustahikModel = new MustahikModel();
                $role = $this->request->getPost('role');

                // simpan user
                $userId = $userModel->insert([
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'akses' => $role
                ], true);


                if ($role == 'muzaki') {
                    $muzakiModel->save([
                        'id_users' => $userId,
                        'nama' => $this->request->getPost('nama'),
                        'alamat' => $this->request->getPost('alamat') ?? null,
                        'telepon' => $this->request->getPost('telepon') ?? null,
                        'email' => $this->request->getPost('email') ?? null
                    ]);
                } else {
                    $mustahikModel->save([
                        'id_users' => $userId,
                        'nama' => $this->request->getPost('nama'),
                        'alamat' => $this->request->getPost('alamat') ?? null,
                        'telepon' => $this->request->getPost('telepon') ?? null,
                        'email' => $this->request->getPost('email') ?? null
                    ]);
                }

                return redirect()->to('/auth')->with('success', 'Registrasi berhasil.');
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('register', $data);
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'))->with('success', 'Anda telah logout');
    }

    public function forbidden()
    {
        return view('errors/forbidden');
    }
}
