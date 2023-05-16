<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?= base_url('book-add') ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i></a>Daftar Buku</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        <center>Judul</center>
                                    </th>
                                    <th>
                                        <center>Pengarang</center>
                                    </th>
                                    <th>
                                        <center>Tahun</center>
                                    </th>
                                    <th>
                                        <center>Penerbit</center>
                                    </th>
                                    <th>
                                        <center>Kategori</center>
                                    </th>
                                    <th>
                                        <center>Jumlah</center>
                                    </th>
                                    <th width="100px">
                                        <center>Tool</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($book as $item) : ?>
                                    <tr>
                                        <td><?= $item['title'] ?></td>
                                        <td><?= $item['author'] ?></td>
                                        <td><?= $item['publication_year'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['category'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('book-edit/') . $item['id'] ?>" class="btn btn-round btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url('book-delete/') . $item['id'] ?>" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?= $this->endsection() ?>