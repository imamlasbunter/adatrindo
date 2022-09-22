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
                            <a class="btn btn-primary btn-sm" href="<?= base_url('/discount-program') ?>">Back</a>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Add Product For Discount Program</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('discount-program-in/save') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                                    <input type="hidden" name="form" value="add" readonly>
                                    <div class="form-group row">
                                        <label for="program_name" class="col-sm-3 col-form-label">Program Name</label>
                                        <div class="col-sm-9">
                                            <select name="program_name" class="form-control <?= ($validation->hasError('program_name')) ? 'is-invalid' : ''; ?>" id="program_name" placeholder="Program Name">
                                                <option value="">--Chose Program Name--</option>
                                                <?php foreach ($dp as $row) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('program_name')) ? 'selected' : ''; ?>><?= $row['program_name']; ?></option>
                                                <?php endforeach; ?>
                                                <select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('program_name'); ?>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="product" class="col-sm-3 col-form-label">Product</label>
                                        <div class="col-sm-9">
                                            <select name="product" class="form-control <?= ($validation->hasError('product')) ? 'is-invalid' : ''; ?>" id="product" placeholder="Product">
                                                <option value="">--Chose Product--</option>
                                                <?php foreach ($items as $row) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('product')) ? 'selected' : ''; ?>><?= $row['product_code']; ?> - <?= $row['product_name']; ?></option>
                                                <?php endforeach; ?>
                                                <select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('product'); ?>
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