<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class Category extends BaseController
{
    protected $CategoryModel;

    public function __construct()
    {
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }
        $data = array(
            'category' => $this->CategoryModel->findAll(),
        );

        return view('Category/index', $data);
    }

    public function add()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        return view('Category/form');
    }

    public function addpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();

        if (!$this->validate([
            'category' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi',],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('category-add')->withInput();
        }

        $this->CategoryModel->save([
            'category' => $post['category'],
        ]);
        return redirect()->to('category')->with('info', 'data berhasil ditambah');
    }

    public function edit($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'item'  => $this->CategoryModel->where(['id' => $id])->first(),
            'id'    => $id,
        );

        return view('Category/form', $data);
    }

    public function editpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();
        $datapost = $this->CategoryModel->where(['id' => $post['id']])->first();

        if (!$this->validate([
            'category' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi',],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('category-edit/' . $post['id'])->withInput();
        }

        $this->CategoryModel->save([
            'category' => $post['category'],
        ]);
        return redirect()->to('category')->with('info', 'data berhasil ditambah');
    }

    public function delete($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $delete = $this->CategoryModel->delete($id);
        if ($delete) {
            return redirect()->to('category');
        }
    }
}
