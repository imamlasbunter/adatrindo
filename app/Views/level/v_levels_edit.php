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
                        <li class="breadcrumb-item active"><?= $h2; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a class="btn btn-primary btn-sm" href="<?= base_url('/users') ?>">Back</a>
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
                            <h3 class="card-title">Form Edit Customers</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('roles/edit/level/' . $edit['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>
                                    <input type="hidden" name="id" value="<?php echo
                                                                            $edit['id'];
                                                                            ?>" readonly>


                                    <div class="form-group row">
                                        <label for="descripsion" class="col-sm-2 col-form-label">Level Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="descripsion" class="form-control <?= ($validation->hasError('descripsion')) ? 'is-invalid' : ''; ?>" id="descripsion" placeholder="descripsion" value="<?= ($validation->hasError('descripsion')) ? old('descripsion') : $edit['descripsion']; ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('descripsion'); ?>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
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