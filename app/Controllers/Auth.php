<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StaffModel;

class Auth extends BaseController
{
    protected $staffmodel;

    public function __construct()
    {
        $this->staffmodel = new StaffModel();
    }

    public function login()
    {
        $post = $this->request->getPost();
        $datapost = $this->staffmodel->where(['email' => $post['email']])->first();
        if ($datapost) {
            if (md5($post['password']) == $datapost['password']) {
                $key = array(
                    'id'    => $datapost['id'],
                    'name'  => $datapost['name'],
                    'email' => $datapost['email'],
                );
                session()->set($key);
                return redirect()->to(base_url('home'))->withInput();
            } else {
                return redirect()->to(base_url(''))->with('error', 'password tidak sesuai');
            }
        } else {
            return redirect()->to(base_url(''))->with('error', 'email tidak sesuai');
        }
    }

    public function logout()
    {
        session()->remove('id', 'name', 'email');
        return redirect()->to(base_url())->with('error', 'anda sudah logout');
    }
}
