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
                        <li class="breadcrumb-item"><?= $h1; ?></li>
                        <li class="breadcrumb-item active"><?= $h2; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a class="btn btn-primary btn-sm" href="<?= base_url('/products') ?>">Back</a>
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
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Units</h3>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('products/units/add') ?>">Add Unit</a></h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($productUnits as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['unit']; ?></td>
                                            <td><a class="btn btn-primary btn-xs" href="<?= base_url('products/units/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                <a class="btn btn-danger btn-xs" href="<?= base_url('products/units/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
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