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
                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php } else if (session()->getFlashdata('warning')) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo session()->getFlashdata('warning'); ?>
                        </div>
                    <?php } ?>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Discount Program</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('discount-program/add') ?>">Add Discount Program</a></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Program Name</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Date Start</th>
                                        <th scope="col">Date End</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($dp as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['program_name']; ?></td>
                                            <td><?= $row['discount']; ?></td>
                                            <td><?= $row['date_start']; ?></td>
                                            <td><?= $row['date_end']; ?></td>
                                            <td>
                                                <!-- <a class="btn btn-primary btn-xs" href="<?= base_url('discount-program/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a> -->
                                                <a class="btn btn-danger btn-xs" href="<?= base_url('discount-program/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Product Discount</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('discount-program-in/add') ?>">Add Product Discount</a></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table2" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Program Name</th>
                                        <th scope="col">Product Stock</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Date Start</th>
                                        <th scope="col">Date End</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($dp_in as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['program_name']; ?></td>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?= $row['quantity']; ?></td>
                                            <td><?= $row['discount']; ?></td>
                                            <td><?= $row['date_start']; ?></td>
                                            <td><?= $row['date_end']; ?></td>
                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('discount-program-in/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                <a class="btn btn-danger btn-xs" href="<?= base_url('discount-program-in/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>