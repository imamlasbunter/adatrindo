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
                            <h3 class="card-title">Form Add Sub Menu</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('menu/save_submenu') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <?php foreach ($add_submenu as $add_submenu) : ?>
                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                            ?>" readonly>
                                        <input type="hidden" name="id" value="<?php echo
                                                                                $add_submenu['id'];
                                                                                ?>" readonly>
                                        <input type="hidden" name="category_menu" value="<?php echo
                                                                                            $add_submenu['category_menu'];
                                                                                            ?>" readonly>

                                        <div class="form-group row">
                                            <label for="category_menu_d" class="col-sm-3 col-form-label">Category Menu</label>
                                            <div class="col-sm-9">

                                                <input type="text" name="category_menu_d" class="form-control <?= ($validation->hasError('category_menu_d')) ? 'is-invalid' : ''; ?>" id="category_menu_d " placeholder="Category menu" value="<?= (old('category_menu_d')) ? old('category_menu_d') : $add_submenu['name']; ?>" readonly>

                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('category_menu_d'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="main_menu" class="col-sm-3 col-form-label">Main Menu</label>
                                            <div class="col-sm-9">

                                                <input type="text" name="main_menu" class="form-control <?= ($validation->hasError('main_menu')) ? 'is-invalid' : ''; ?>" id="main_menu " placeholder="Category menu" value="<?= (old('main_menu')) ? old('main_menu') : $add_submenu['menu_name']; ?>" readonly>

                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('main_menu'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="menu_name " class="col-sm-3 col-form-label">Menu Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="menu_name" class="form-control <?= ($validation->hasError('menu_name')) ? 'is-invalid' : ''; ?>" id="menu_name " placeholder="Menu name" value="<?= (old('menu_name')) ? old('menu_name') : ''; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('menu_name '); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sequence" class="col-sm-3 col-form-label">Sequence</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="sequence" class="form-control <?= ($validation->hasError('sequence')) ? 'is-invalid' : ''; ?>" id="sequence" placeholder="Sequence" value="<?= (old('sequence')) ? old('sequence') : ''; ?>">
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
                                                    <option value="A" <?= (old('status') == 'A') ? 'selected' : '' ?>>Aktif</option>
                                                    <option value="N" <?= (old('status') == 'A') ? 'selected' : '' ?>>Non Aktif</option>
                                                </select>
                                                <?= $validation->getError('status'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="icon_menu" class="col-sm-3 col-form-label">Menu Icon</label>
                                            <div class="col-sm-9">
                                                <input type="test" name="icon_menu" class="form-control <?= ($validation->hasError('icon_menu')) ? 'is-invalid' : ''; ?>" id="icon_menu " placeholder="Icon Menu" value="<?= (old('icon_menu')) ? old('icon_menu') : ''; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('icon_menu'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="link_menu" class="col-sm-3 col-form-label">Menu Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="link_menu" class="form-control <?= ($validation->hasError('link_menu')) ? 'is-invalid' : ''; ?>" id="link_menu" placeholder="Menu Link" value="<?= (old('link_menu')) ? old('link_menu') : ''; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('link_menu'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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