<?php

namespace App\Controllers\User;
use App\Models\Flasher;
use App\Models\BarangModel;
use App\Controllers\BaseController;

session();
class UserController extends BaseController
{
    public function index()
    {
        $data = [];
        $data['sidebar'] = 'index';
        $data['title'] = 'Dashboard User';
        $data['barangs'] = (new BarangModel())->findAll();
        return view('user/index', $data);
    }
}