<?php

namespace App\Controllers\General;
use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\Flasher;
use App\Models\UnitModel;

session();
class LoginController extends BaseController
{
    public function login()
    {
        $data = [];
        $data['sidebar'] = 'dashboard';
        $data['title'] = 'TokOnline';
        return view('general/login', $data);
    }
    
    public function aksi_login(){
        $data = $this->request->getVar();
        $akun = (new AkunModel())->where('username', $data['username'])->first();
        if($akun){
            $verify = password_verify($data['password'], $akun['password']);
            if($verify){
                $_SESSION['auth'] = [
                    'user_id' => $akun['user_id'],
                    'username' => $akun['username'],
                    'fullname' => $akun['fullname'],
                    'role' => $akun['role'],
                ];
                Flasher::setFlash('Login berhasil', 'success');
                if($akun['role'] == 99){
                    echo '99';
                    return redirect()->to(BASEURL . '/admins');
                }else{
                    return redirect()->to(BASEURL . '/user');
                }
            }else{
                Flasher::setFlash('Login gagal. Pastikan username & password Anda sudah benar', 'warning');
                return redirect()->to(BASEURL . '/login');
            }
        }else{
            Flasher::setFlash('Akun tidak ditemukan', 'warning');
            return redirect()->to(BASEURL . '/login');
        }
    }
}
