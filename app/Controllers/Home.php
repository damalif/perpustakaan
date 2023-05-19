<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BorrowerModel;
use App\Models\BorrowModel;
use App\Models\CategoryModel;
use App\Models\PublisherModel;
use App\Models\StaffModel;

class Home extends BaseController
{
    protected $staffmodel;
    protected $borrowermodel;
    protected $bookmodel;
    protected $publishermodel;
    protected $categorymodel;
    protected $borrowmodel;

    public function __construct()
    {
        $this->staffmodel = new StaffModel();
        $this->borrowermodel = new BorrowerModel();
        $this->bookmodel = new BookModel();
        $this->publishermodel = new PublisherModel();
        $this->categorymodel = new CategoryModel();
        $this->borrowmodel = new BorrowModel();
    }

    public function index()
    {
        if (session('id')) {
            return redirect()->to(base_url('home'));
        }
        return view('login');
    }

    public function home()
    {
        if (!session('id')) {
            return redirect()->to(base_url())->with('error', 'Anda harus login');
        }

        $data = array(
            'qstaff'    => $this->staffmodel->countAllResults(),
            'qborrower'    => $this->borrowermodel->countAllResults(),
            'qbook'    => $this->bookmodel->countAllResults(),
            'qpublisher'    => $this->publishermodel->countAllResults(),
            'qcategory'    => $this->categorymodel->countAllResults(),
            'qborrow'    => $this->borrowmodel->countAllResults(),
        );
        return view('home', $data);
    }
}
