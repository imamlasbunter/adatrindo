<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<style>
    .invest {
        position: relative;
        top: 10px;
    }
</style>
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
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Alert saved -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php elseif (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">


                                <img class="profile-user-img img-fluid img-circle fas fa-edit nav-icon" src="<?php //echo base_url('assets/dist/img/user4-128x128.jpg');
                                                                                                                if ($user_profile['pp_name']) {
                                                                                                                    echo base_url('uploads/' . $user_profile['pp_name']);
                                                                                                                } else {
                                                                                                                    echo base_url('assets/dist/img/user9.png');
                                                                                                                }
                                                                                                                ?>" alt="User profile picture">


                            </div>
                            <h3 class="profile-username text-center"><?= session()->get('name'); ?></h3>

                            <p class="text-muted text-center"><?= session()->get('descripsion'); ?></p>

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Change Password</b> <a class="float-right"><i class="fas fa-edit nav-icon"></i></a>
                                </li>
                            </ul> -->

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="active nav-link" href="#info" data-toggle="tab">Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <?php ?>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">

                                                <?= $user_profile['username']; ?>
                                                <!-- <input type="username" class="form-control" id="username" placeholder="username"> -->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">

                                                <?= $user_profile['name']; ?>
                                                <!-- <input type="text" class="form-control" id="inputName2" placeholder="Name"> -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">

                                                <?= $user_profile['email']; ?>
                                                <!-- <input type="email" class="form-control" id="inputEmail" placeholder="Email"> -->
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" action="<?= base_url('user-profile/add'); ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                            ?>" readonly>
                                        <input type="hidden" name="pp_last" value="<?php echo $user_profile['pp_name']
                                                                                    ?>" readonly>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" class="form-control" id="name" placeholder="name" value="<?= $user_profile['name']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="<?= $user_profile['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" class="form-control" id="password" placeholder="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="repassword" class="col-sm-3 col-form-label">Retype Password</label>
                                            <div class="col-sm-9">
                                                <input type="repassword" name="repassword" class="form-control" id="repassword" placeholder="Retype password">
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <label for="pp" class="col-sm-3 col-form-label">Profile Picture</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="file" id="pp" name="pp">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endsection(); ?>