<?php
namespace App\Models;

class Flasher{

    public static $type = [
        'success'=>'Hore',
        'danger'=>'Oops',
        'warning'=>'Weit',

    ];

    public static function setFlash($msg, $tipe){
        $_SESSION['flash']=[
            'msg'=> $msg,
            'tipe'=>$tipe
        ];
    }

    public static function flash(){
        if(isset($_SESSION['flash'])){
            $class = $_SESSION['flash']['tipe'];
            $msg = $_SESSION['flash']['msg'];
            $word = self::$type[$class];
            echo '
                <div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert">
                    <strong>' . $word . '!</strong> ' . $msg . '.
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>';
            unset($_SESSION['flash']);
        }
    }
}