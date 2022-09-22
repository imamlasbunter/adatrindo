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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Add Discount Program</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-sm-8 mt-3">
                                <form action="<?= base_url('discount-program/save') ?>" method="POST" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                                    <input type="hidden" name="form" value="add" readonly>
                                    <div class="form-group row">
                                        <label for="program_name" class="col-sm-3 col-form-label">Program Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="program_name" class="form-control <?= ($validation->hasError('program_name')) ? 'is-invalid' : ''; ?>" id="program_name" placeholder="Program Name" value="<?= old('program_name'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('program_name'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="program_description" class="col-sm-3 col-form-label">Program Discription</label>
                                        <div class="col-sm-9">
                                            <textarea type="text" name="program_description" class="form-control <?= ($validation->hasError('program_description')) ? 'is-invalid' : ''; ?>" id="program_description" placeholder="Program Description"> <?= old('program_description'); ?> </textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('program_description'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="discount" class="col-sm-3 col-form-label">Discount (%)</label>
                                        <div class="col-sm-9">
                                            <input type="number" min=0 max=100 name="discount" class="form-control <?= ($validation->hasError('discount')) ? 'is-invalid' : ''; ?>" id="discount" placeholder="Discount" value="<?= old('discount'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('discount'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="date_start" class="col-sm-3 col-form-label">Date Start :</label>
                                        <div class="col-sm-5">
                                            <div class="input-group date" id="date_start_picker" data-target-input="nearest">
                                                <input type="text" name="date_start" id="date_start" class="form-control datetimepicker-input" data-target="#date_start_picker" value="<?= old('date_start'); ?>" />
                                                <div class="input-group-append" data-target="#date_start_picker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('date_start'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="date_end" class="col-sm-3 col-form-label">Date End :</label>
                                        <div class="col-sm-5">
                                            <div class="input-group date" id="date_end_picker" data-target-input="nearest">
                                                <input type="text" name="date_end" id="date_end" class="form-control datetimepicker-input" data-target="#date_end_picker" value="<?= old('date_end'); ?>" />
                                                <div class="input-group-append" data-target="#date_end_picker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('date_end'); ?>
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