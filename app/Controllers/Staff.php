<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StaffModel;

class Staff extends BaseController
{
    protected $staffModel;

    public function __construct()
    {
        $this->staffModel = new StaffModel();
    }

    public function index()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }
        $data = array(
            'staff' => $this->staffModel->findAll(),
        );

        return view('staff/index', $data);
    }

    public function add()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        return view('staff/form');
    }

    public function addpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();

        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'email' => [
                'rules' => 'required|is_unique[staff.email]',
                'errors' => [
                    'required' => 'wajib diisi',
                    'is_unique' => 'email sudah terdaftar'
                ],
            ],
            'password' => [
                'rules' => 'required|alpha_numeric|min_length[6]',
                'errors' => [
                    'required' => 'wajib diisi',
                    'alpha_numeric' => 'khusus huruf dan angka',
                    'min_length' => 'minimal 6 karakter'
                ],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('staff-add')->withInput();
        }

        $this->staffModel->save([
            'name' => $post['name'],
            'email' => $post['email'],
            'password' => md5($post['password']),
        ]);
        return redirect()->to('staff')->with('info', 'data berhasil ditambah');
    }

    public function edit($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'item'  => $this->staffModel->where(['id' => $id])->first(),
            'id'    => $id,
        );

        return view('staff/form', $data);
    }

    public function editpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();
        $datapost = $this->staffModel->where(['id' => $post['id']])->first();

        if ($post['email'] == $datapost['email']) {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
                'password' => [
                    'rules' => 'required|alpha_numeric|min_length[6]',
                    'errors' => [
                        'required' => 'wajib diisi',
                        'alpha_numeric' => 'khusus huruf dan angka',
                        'min_length' => 'minimal 6 karakter'
                    ],
                ],
            ])) {
                $validation = \config\Services::validation();
                session()->setFlashdata('validation', $validation->getErrors());
                return redirect()->to('staff-edit/' . $post['id'])->withInput();
            }
            $this->staffModel->save([
                'id'    => $post['id'],
                'name' => $post['name'],
                'password' => md5($post['password']),
            ]);
            return redirect()->to('staff')->with('info', 'data berhasil ditambah');
        } else {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
                'email' => [
                    'rules' => 'required|is_unique[staff.email]',
                    'errors' => [
                        'required' => 'wajib diisi',
                        'is_unique' => 'email sudah terdaftar'
                    ],
                ],
                'password' => [
                    'rules' => 'required|alpha_numeric|min_length[6]',
                    'errors' => [
                        'required' => 'wajib diisi',
                        'alpha_numeric' => 'khusus huruf dan angka',
                        'min_length' => 'minimal 6 karakter'
                    ],
                ],
            ])) {
                $validation = \config\Services::validation();
                session()->setFlashdata('validation', $validation->getErrors());
                return redirect()->to('staff-edit/' . $post['id'])->withInput();
            }
            $this->staffModel->save([
                'id'    => $post['id'],
                'name' => $post['name'],
                'email' => $post['email'],
                'password' => md5($post['password']),
            ]);
            return redirect()->to('staff')->with('info', 'data berhasil ditambah');
        }
    }

    public function delete($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $delete = $this->staffModel->delete($id);
        if ($delete) {
            return redirect()->to('staff');
        }
    }
}
