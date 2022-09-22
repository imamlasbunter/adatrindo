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
                            <h3 class="card-title">Form Add Main Menu</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('menu/add') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                        ?>" readonly>

                                    <div class="form-group row">
                                        <label for="category_menu" class="col-sm-3 col-form-label">Category Menu</label>
                                        <div class="col-sm-9">
                                            <select name="category_menu" class="form-control <?= ($validation->hasError('category_menu')) ? 'is-invalid' : ''; ?>" id="category_menu" placeholder="Unit Product">
                                                <option value="">--Chose Category Menu--</option>
                                                <?php foreach ($category_menu->getresultarray() as $row) : ?>
                                                    <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('category_menu')) ? 'selected' : ''; ?>><?= $row['name']; ?></option>
                                                <?php endforeach; ?>
                                                <select>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->getError('category_menu'); ?>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="menu_name " class="col-sm-3 col-form-label">Menu Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="menu_name" class="form-control <?= ($validation->hasError('menu_name')) ? 'is-invalid' : ''; ?>" id="menu_name " placeholder="Menu name" value="<?= old('menu_name'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('menu_name '); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sequence" class="col-sm-3 col-form-label">Sequence</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="sequence" class="form-control <?= ($validation->hasError('sequence')) ? 'is-invalid' : ''; ?>" id="sequence" placeholder="Sequence" value="<?= old('sequence'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('sequence'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select name="status" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" id="status" value="<?= old('status'); ?>">
                                                <option value="">--Chose Status--</option>
                                                <option value="A" <?= (old('status') == 'A') ? 'selected' : '' ?>>Aktif </option>
                                                <option value="N" <?= (old('status') == 'N') ? 'selected' : '' ?>>Non Aktif</option>
                                            </select>
                                            <?= $validation->getError('status'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="icon_menu" class="col-sm-3 col-form-label">Menu Icon</label>
                                        <div class="col-sm-9">
                                            <input type="test" name="icon_menu" class="form-control <?= ($validation->hasError('icon_menu')) ? 'is-invalid' : ''; ?>" id="icon_menu " placeholder="Icon Menu" value="<?= old('icon_menu'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('icon_menu'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="link_menu" class="col-sm-3 col-form-label">Menu Link</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="link_menu" class="form-control <?= ($validation->hasError('link_menu')) ? 'is-invalid' : ''; ?>" id="link_menu" placeholder="Menu Link" value="<?= old('link_menu'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('link_menu'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="<?= base_url('menu'); ?>" class="btn btn-primary">Back</a>
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