<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Setting</li>
                        <li class="breadcrumb-item active"><?= $h1; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a class="btn btn-primary btn-sm" href="<?= base_url('/contact/add') ?>">Add Contact</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Main row -->
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="active nav-link" href="#customer" data-toggle="tab">Customer</a></li>
                                <li class="nav-item"><a class="nav-link" href="#supplier" data-toggle="tab">Supplier</a></li>
                                <li class="nav-item"><a class="nav-link" href="#employee" data-toggle="tab">Employee</a></li>
                                <li class="nav-item"><a class="nav-link" href="#vendor" data-toggle="tab">Vendor</a></li>
                                <li class="nav-item"><a class="nav-link" href="#others" data-toggle="tab">Others</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <?php ?>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="customer">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="table_customer" class="table table-bordered table-striped table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Perusahaan</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">No. Handphone</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($customer as $row) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $row['name']; ?></td>
                                                            <td><?= $row['company_name']; ?></td>
                                                            <td><?= $row['email']; ?></td>
                                                            <td><?= $row['hp']; ?></td>
                                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('contact/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="<?= base_url('contact/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                            </td>
                                                        </tr>


                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.tab-pane SUPPLIER -->

                                <div class="tab-pane" id="supplier">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="table_supplier" class="table table-bordered table-striped table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Perusahaan</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">No. Handphone</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($supplier as $row) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $row['name']; ?></td>
                                                            <td><?= $row['company_name']; ?></td>
                                                            <td><?= $row['email']; ?></td>
                                                            <td><?= $row['hp']; ?></td>
                                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('contact/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="<?= base_url('contact/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                            </td>
                                                        </tr>


                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="employee">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="table_employee" class="table table-bordered table-striped table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Perusahaan</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">No. Handphone</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($employee as $row) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $row['name']; ?></td>
                                                            <td><?= $row['company_name']; ?></td>
                                                            <td><?= $row['email']; ?></td>
                                                            <td><?= $row['hp']; ?></td>
                                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('contact/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="<?= base_url('contact/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                            </td>
                                                        </tr>


                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="vendor">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="table_vendor" class="table table-bordered table-striped table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Perusahaan</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">No. Handphone</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($vendor as $row) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $row['name']; ?></td>
                                                            <td><?= $row['company_name']; ?></td>
                                                            <td><?= $row['email']; ?></td>
                                                            <td><?= $row['hp']; ?></td>
                                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('contact/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="<?= base_url('contact/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                            </td>
                                                        </tr>


                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="others">
                                    <div class="card">
                                        <div class="card-body">
                                            <table id="table_others" class="table table-bordered table-striped table-sm table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Perusahaan</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">No. Handphone</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    foreach ($others as $row) : ?>
                                                        <tr>
                                                            <th scope="row"><?= $no++; ?></th>
                                                            <td><?= $row['name']; ?></td>
                                                            <td><?= $row['company_name']; ?></td>
                                                            <td><?= $row['email']; ?></td>
                                                            <td><?= $row['hp']; ?></td>
                                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('contact/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                                <a class="btn btn-danger btn-xs" href="<?= base_url('contact/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                            </td>
                                                        </tr>


                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>