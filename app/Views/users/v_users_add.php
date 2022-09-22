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
                            <h3 class="card-title">Form Add User</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('users/add') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" value="<?= old('username'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('username'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" value="<?= old('password'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('password'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="repassword" class="col-sm-3 col-form-label">Retype Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="repassword" class="form-control <?= ($validation->hasError('repassword')) ? 'is-invalid' : ''; ?>" id="repassword" placeholder="repassword" value="<?= old('repassword'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('repassword'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="name" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Name" value="<?= old('name'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('name'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="level" class="col-sm-3 col-form-label">Level User</label>
                                        <div class="col-sm-9">
                                            <select name="level" class="form-control <?= ($validation->hasError('level')) ? 'is-invalid' : ''; ?>" id="level" placeholder="Level User">
                                                <option value="">--Chose Level user--</option>
                                                <?php foreach ($level as $row) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('level')) ? 'selected' : ''; ?>><?= $row['descripsion']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('level'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="Email" value="<?= old('email'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
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