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
                        <li class="breadcrumb-item"><?= $h2; ?></li>
                        <li class="breadcrumb-item active"><?= $h3; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <a class="btn btn-primary btn-sm" href="javascript:history.back();">Back</a>
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
                            <h3 class="card-title">Form Add Account List</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('journal-setting/list/add') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>
                                    <div class="form-group row">
                                        <label for="account_number" class="col-sm-3 col-form-label">Account Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="account_number" class="form-control <?= ($validation->hasError('account_number')) ? 'is-invalid' : ''; ?>" id="account_number" placeholder="Account Number" value="<?= old('account_number'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('account_number'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="account_name" class="col-sm-3 col-form-label">Account Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="account_name" class="form-control <?= ($validation->hasError('account_name')) ? 'is-invalid' : ''; ?>" id="account_name" placeholder="Account Name" value="<?= old('account_name'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('account_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="account_category" class="col-sm-3 col-form-label">Account Category</label>
                                        <div class="col-sm-9">
                                            <select name="account_category" class="form-control <?= ($validation->hasError('account_category')) ? 'is-invalid' : ''; ?>" id="account_category" placeholder="Account Category">
                                                <option value="">--Chose category--</option>
                                                <?php foreach ($accountcategory as $row) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('account_category')) ? 'selected' : ''; ?>><?= $row['name']; ?></option>
                                                <?php endforeach; ?>
                                                <select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('account_category'); ?>
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