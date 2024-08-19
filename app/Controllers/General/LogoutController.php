<?php

namespace App\Controllers\General;
use App\Controllers\BaseController;
use App\Models\Flasher;

session();
class LogoutController extends BaseController
{

    public function aksi_logout(){
        if(!empty($_SESSION)){
            unset($_SESSION['auth']);
        }
        Flasher::setFlash("Logout berhasil!","success");
        return redirect()->to(BASEURL . '/login');
    }
}
