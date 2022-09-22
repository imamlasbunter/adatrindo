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
                            <?php /// $breadcrumb; 
                            ?>
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
                    <div class="card">

                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title">Data Level User</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('roles/add/level') ?>">Add User</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                    foreach ($level as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['descripsion']; ?></td>
                                            <td>
                                                <a class="btn btn-info btn-xs" href="<?= base_url('roles/access/level/' . $row['id']) ?>"><i class="fas fa-eye nav-icon"></i></a>
                                                <a class="btn btn-primary btn-xs" href="<?= base_url('roles/edit/level/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                <a class="btn btn-danger btn-xs" href="<?= base_url('roles/delete/level/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>