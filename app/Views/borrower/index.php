<?= $this->extend('main') ?>

<?= $this->section('content') ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><a href="<?= base_url('borrower-add') ?>" class="btn btn-round btn-success btn-sm"><i class="fa fa-plus"></i></a>Daftar Borrower</h3>
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
                                        <center>Name</center>
                                    </th>
                                    <th>
                                        <center>Birthdate</center>
                                    </th>
                                    <th>
                                        <center>Address</center>
                                    </th>
                                    <th>
                                        <center>Gender</center>
                                    </th>
                                    <th>
                                        <center>Contact</center>
                                    </th>
                                    <th>
                                        <center>Email</center>
                                    </th>
                                    <th>
                                        <center>Tool</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($borrower as $item) : ?>
                                    <tr>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['birthdate'] ?></td>
                                        <td><?= $item['address'] ?></td>
                                        <td><?= $item['gender'] ?></td>
                                        <td><?= $item['contact'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('borrower-edit/') . $item['id'] ?>" class="btn btn-round btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="<?= base_url('borrower-delete/') . $item['id'] ?>" class="btn btn-round btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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