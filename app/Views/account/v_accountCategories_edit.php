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
                            <a href="javascript:history.back()" class="btn btn-primary">Back</a>
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
                            <h3 class="card-title">Form Edit Category Account</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <?php foreach ($edit as $edit) : ?>
                                    <form action="<?= base_url('journal-setting/category/edit/' .  $edit['id']) ?>" method="post" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                            ?>" readonly>
                                        <input type="hidden" name="id" value="<?php echo
                                                                                $edit['id'];
                                                                                ?>" readonly>


                                        <div class="form-group row">
                                            <label for="category_account" class="col-sm-3 col-form-label">Category Account</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="category_account" class="form-control <?= ($validation->hasError('category_account')) ? 'is-invalid' : ''; ?>" id="category_account" placeholder="Category Account" value="<?= ($validation->hasError('category_account')) ? old('category_account') : $edit['name']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('category_account'); ?>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="Reset" class="btn btn-primary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>