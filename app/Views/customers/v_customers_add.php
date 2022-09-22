<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $h1; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <?= $breadcrumb; ?>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Add Customers</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('/customers/add') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Customer Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Customer Name" value="<?= old('name'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('name'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" form-group row">
                                        <label for="no_telp" class="col-sm-2 col-form-label">No. Telephone</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="no_telp" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" placeholder="No. Telephone" value="<?= old('no_telp'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('no_telp'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" name="address" class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : ''; ?>" id="address" placeholder="Address"><?= old('address'); ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('address'); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="<?= base_url('/customers'); ?>" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>