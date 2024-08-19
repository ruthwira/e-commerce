<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * General
 */
$routes->get('/', '\App\Controllers\General\GeneralController::index');
$routes->get('/login', '\App\Controllers\General\LoginController::login');
$routes->get('/registrasi', '\App\Controllers\General\RegistrasiController::registrasi');
$routes->post('login', '\App\Controllers\General\LoginController::aksi_login');
$routes->get('logout', '\App\Controllers\General\LogoutController::aksi_logout');
$routes->post('registrasi', '\App\Controllers\General\RegistrasiController::aksi_registrasi');

/**
 * Admin
 */
$routes->group("admins", ["namespace" => "App\Controllers\Admin"], function ($routes) {
    // URL - /admins
    $routes->get("/", "AdminController::index");
    // URL - /admins/barang
    $routes->group("barang", function ($routes) {
        // URL - /admins/barang
        $routes->get("", "AdminBarangController::index");
        // URL - /admins/barang/add
        $routes->get("add", "AdminBarangController::add_barang");
        // URL - /admins/barang/view
        $routes->get("view/(:num)", "AdminBarangController::view_barang/$1");
        // URL - /admins/barang/add
        $routes->post("add", "AdminBarangController::aksi_add_barang");
        // URL - /admins/barang/update
        $routes->post("update", "AdminBarangController::aksi_update_barang");
        // URL - /admins/barang/delete
        $routes->get("delete/(:num)", "AdminBarangController::aksi_delete_barang/$1");
    });
    // URL - /admins/pesanan
    $routes->group("pesanan", function ($routes) {
        // URL - /admins/pesanan
        $routes->get("", "AdminPesananController::index");
        // URL - /admins/pesanan/view
        $routes->get("view/(:num)", "AdminPesananController::view_pesanan/$1");
        // URL - /admins/pesanan/update
        $routes->post("update", "AdminPesananController::aksi_update_pesanan");
    });
});

/**
 * User
 */
$routes->group("user", ["namespace" => "App\Controllers\User"], function ($routes) {
    // URL - /user
    $routes->get("/", "UserController::index");
    // URL - /user/barang
    $routes->group("barang", function ($routes) {
        // URL - /user/barang/view
        $routes->get("view/(:num)", "UserBarangController::view_barang/$1");
    });
    // URL - /user/keranjang
    $routes->group("keranjang", function ($routes) {
        // URL - /user/keranjang
        $routes->get("", "UserKeranjangController::index");
        // URL - /user/keranjang/add
        $routes->post("add", "UserKeranjangController::aksi_add_keranjang");
        // URL - /user/keranjang/update
        $routes->post("update", "UserKeranjangController::aksi_update_keranjang");
        // URL - /user/keranjang/delete
        $routes->post("delete", "UserKeranjangController::aksi_delete_keranjang");
    });
    // URL - /user/pesanan
    $routes->group("pesanan", function ($routes) {
        // URL - /user/pesanan
        $routes->get("", "UserPesananController::index");
        // URL - /user/pesanan/view
        $routes->get("view/(:num)", "UserPesananController::view_pesanan/$1");
        // URL - /user/pesanan/add
        $routes->post("add", "UserPesananController::aksi_add_pesanan");
        // URL - /user/pesanan/update
        $routes->post("update", "UserPesananController::aksi_update_pesanan");
        // URL - /user/pesanan/konfirmasi
        $routes->post("konfirmasi", "UserPesananController::aksi_konfirmasi_pesanan");
        // URL - /user/pesanan/delete
        $routes->get("delete/(:num)", "UserPesananController::aksi_delete_pesanan/$1");
    });
});