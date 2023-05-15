<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PublisherModel;

class Publisher extends BaseController
{
    protected $PublisherModel;

    public function __construct()
    {
        $this->PublisherModel = new PublisherModel();
    }

    public function index()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }
        $data = array(
            'publisher' => $this->PublisherModel->findAll(),
        );

        return view('publisher/index', $data);
    }

    public function add()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        return view('publisher/form');
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
                'errors' => ['required' => 'wajib diisi',],
            ],
            'address' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'contact' => [
                'rules' => 'required|alpha_numeric',
                'errors' => [
                    'required' => 'wajib diisi',
                    'alpha_numeric' => 'khusus angka',
                ],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('publisher-add')->withInput();
        }

        $this->PublisherModel->save([
            'name' => $post['name'],
            'address' => $post['address'],
            'contact' => $post['contact'],
        ]);
        return redirect()->to('publisher')->with('info', 'data berhasil ditambah');
    }

    public function edit($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'item'  => $this->PublisherModel->where(['id' => $id])->first(),
            'id'    => $id,
        );

        return view('publisher/form', $data);
    }

    public function editpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();
        $datapost = $this->PublisherModel->where(['id' => $post['id']])->first();

        if ($post['address'] == $datapost['address']) {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
            ])) {
                $validation = \config\Services::validation();
                session()->setFlashdata('validation', $validation->getErrors());
                return redirect()->to('publisher-add')->withInput();
            }
            $this->PublisherModel->save([
                'id'    => $post['id'],
                'name' => $post['name'],
                'contact' => $post['contact'],
            ]);
            return redirect()->to('publisher')->with('info', 'data berhasil ditambah');
        } else {
            if (!$this->validate([
                'name' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'wajib diisi'],
                ],
                'contact' => [
                    'rules' => 'required|alpha_numeric',
                    'errors' => [
                        'required' => 'wajib diisi',
                        'alpha_numeric' => 'khusus angka',
                    ],
                ],
            ])) {
                $validation = \config\Services::validation();
                session()->setFlashdata('validation', $validation->getErrors());
                return redirect()->to('publisher-add')->withInput();
            }
            $this->PublisherModel->save([
                'id'    => $post['id'],
                'name' => $post['name'],
                'address' => $post['address'],
                'password' => $post['address'],
            ]);
            return redirect()->to('publisher')->with('info', 'data berhasil ditambah');
        }
    }

    public function delete($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $delete = $this->PublisherModel->delete($id);
        if ($delete) {
            return redirect()->to('publisher');
        }
    }
}
