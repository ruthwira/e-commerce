<?php

namespace App\Controllers\General;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\Flasher;
use App\Models\UnitModel;

session();
class RegistrasiController extends BaseController
{
    public function registrasi()
    {
        $data = [];
        $data['sidebar'] = 'dashboard';
        $data['title'] = 'TokOnline';
        return view('general/registrasi', $data);
    }

    public function aksi_registrasi()
    {
        $data = $this->request->getVar();
        $akun = (new AkunModel())->where('username', $data['username'])->first();
        if ($akun) {
            Flasher::setFlash('Username sudah dipakai', 'warning');
            return redirect()->to(BASEURL . '/registrasi');
        } else {
            $payload = [
                'username' => $data['username'],
                'fullname' => $data['fullname'],
                'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                'role' => 1
            ];
            (new AkunModel())->insert($payload);
            Flasher::setFlash('Registrasi berhasil, silakan login', 'success');
            return redirect()->to(BASEURL . '/login');
        }
    }

}
