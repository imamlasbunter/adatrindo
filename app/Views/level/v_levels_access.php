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
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- iCheck -->
                    <form action="<?= base_url('roles/access/save') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Level Name : <b><?= $access['descripsion']; ?></b></h3>
                            </div>
                            <div class="card-body">
                                <!-- Minimal style -->

                                <input type="hidden" name="id_level" value="<?= $access['id']; ?>">
                                <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                    ?>" readonly>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>MAIN MENU</label>
                                        <?= $data1 ?>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>REPORT</label>
                                        <?= $data2 ?>

                                    </div>
                                    <div class="col-sm-4">
                                        <label>SETTING</label>
                                        <?= $data3 ?>
                                    </div>
                                </div>
                                <!-- /row -->


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>