<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\BorrowerModel;
use App\Models\BorrowModel;
use App\Models\StaffModel;

class Borrow extends BaseController
{
    protected $borrowModel;
    protected $borrowerModel;
    protected $bookModel;
    protected $staffModel;

    public function __construct()
    {
        $this->borrowModel = new BorrowModel();
        $this->borrowerModel = new BorrowerModel();
        $this->bookModel = new BookModel();
        $this->staffModel = new StaffModel();
    }

    public function index()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }
        $data = array(
            'borrow' => $this->borrowModel
                ->select('borrow.id as id,borrower.name,book.title,staff.name as staff,borrow.release_date,borrow.due_date,borrow.note')
                ->join('borrower', 'borrow.id_borrower=borrower.id', 'left')
                ->join('book', 'borrow.id_book=book.id', 'left')
                ->join('staff', 'borrow.id_staff=staff.id', 'left')
                ->findAll()
        );

        return view('borrow/index', $data);
    }

    public function add()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'borrower' => $this->borrowerModel->findAll(),
            'book' => $this->bookModel->findAll(),
            'staff' => $this->staffModel->findAll(),
        );

        return view('borrow/form', $data);
    }

    public function addpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();

        if (!$this->validate([
            'id_borrower' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'id_book' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'release_date' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'due_date' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'note' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('borrow-add')->withInput();
        }

        $this->borrowModel->save([
            'id_borrower' => $post['id_borrower'],
            'id_book' => $post['id_book'],
            'id_staff' => session('id'),
            'release_date' => $post['release_date'],
            'due_date' => $post['due_date'],
            'note' => $post['note'],
        ]);
        return redirect()->to('borrow')->with('info', 'data berhasil ditambah');
    }

    public function edit($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'item'  => $this->borrowModel->where(['id' => $id])->first(),
            'id'    => $id,
            'borrower' => $this->borrowerModel->findAll(),
            'book' => $this->bookModel->findAll(),
            'staff' => $this->staffModel->findAll(),
        );

        return view('borrow/form', $data);
    }

    public function editpro()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $post = $this->request->getPost();

        if (!$this->validate([
            'id_borrower' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'id_book' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'release_date' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'due_date' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
            'note' => [
                'rules' => 'required',
                'errors' => ['required' => 'wajib diisi'],
            ],
        ])) {
            $validation = \config\Services::validation();
            session()->setFlashdata('validation', $validation->getErrors());
            return redirect()->to('borrow-edit/' . $post['id'])->withInput();
        }
        $this->borrowModel->save([
            'id' => $post['id'],
            'id_borrower' => $post['id_borrower'],
            'id_book' => $post['id_book'],
            'id_staff' => session('id'),
            'release_date' => $post['release_date'],
            'due_date' => $post['due_date'],
            'note' => $post['note'],
        ]);
        return redirect()->to('borrow')->with('info', 'data berhasil ditambah');
    }

    public function returnbook($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }
        $this->borrowModel->save([
            'id' => $id,
            'note' => "Selesai pinjam",
        ]);
        return redirect()->to('borrow');
    }
    public function delete($id)
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda Harus Login');
        }

        $delete = $this->borrowModel->delete($id);
        if ($delete) {
            return redirect()->to('borrow');
        }
    }
}
