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
                            <a class="btn btn-primary btn-sm" href="<?= base_url('/journal-setting') ?>">Back</a>
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
                                        <h3 class="card-title">Data Account List</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="card-title float-right"><a class="btn btn-primary btn-sm" href="<?= base_url('journal-setting/list/add') ?>">Add List</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Account Number</th>
                                        <th>Account Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$accountlist) : ?>
                                        <tr>

                                            <td colspan="5">No data display</td>


                                        </tr>
                                    <?php else : ?>
                                        <?php $no = 1;
                                        foreach ($accountlist as $row) : ?>
                                            <tr>
                                                <th scope="row"><?= $no++; ?></th>
                                                <td><?= $row['account_number']; ?></td>
                                                <td><?= $row['account_name']; ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><a class="btn btn-primary btn-xs" href="<?= base_url('journal-setting/list/edit/' . $row['id']) ?>"><i class="fas fa-edit nav-icon"></i></a>
                                                    <a class="btn btn-danger btn-xs" href="<?= base_url('journal-setting/list/delete/' . $row['id']) ?> " onclick="return confirm('Are you sure ?')"><i class="fas fa-trash nav-icon"></i></a>
                                                </td>
                                            </tr>


                                        <?php endforeach; ?>
                                    <?php endif; ?>

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