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
                            <h3 class="card-title">Form Add Product Units</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('products/units/add') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>
                                    <div class="form-group row">
                                        <label for="unit" class="col-sm-3 col-form-label">Product Unit Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="unit" class="form-control <?= ($validation->hasError('unit')) ? 'is-invalid' : ''; ?>" id="unit" placeholder="Product unit name" value="<?= old('unit'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('unit'); ?>
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