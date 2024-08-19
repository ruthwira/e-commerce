<?php

namespace App\Controllers\General;
use App\Models\BarangModel;
use App\Controllers\BaseController;

session();
class GeneralController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['auth'])) {
            if ($_SESSION['auth']['role'] == 1) {
                return redirect()->to('user');
            }
            if ($_SESSION['auth']['role'] == 99) {
                return redirect()->to('admins');
            }
        }
        $data = [];
        $data['sidebar'] = 'dashboard';
        $data['title'] = 'TokOnline';
        $data['barangs'] = (new BarangModel())->findAll();
        return view('general/index', $data);
    }

}
