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
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">

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
                            <h3 class="card-title">Form Company Setting</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('company/add') ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                            ?>" readonly>
                                        <div class="form-group row">
                                            <label for="company_name" class="col-sm-3">Company Setting</label>

                                        </div>
                                        <div class="form-group row">
                                            <label for="company_name" class="col-sm-3 col-form-label">Company Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="company_name" class="form-control <?= ($validation->hasError('company_name')) ? 'is-invalid' : ''; ?>" id="company_name" placeholder="Company name" value="<?= old('company_name'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('company_name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                                            <div class="col-sm-7">
                                                <input type="file" name="logo" class="form-control <?= ($validation->hasError('logo')) ? 'is-invalid' : ''; ?>" id="logo" placeholder="Logo" value="<?= old('logo'); ?>">
                                                <span style="font-size: 12px; color:red;">*) Dimensi 120 x 120</span>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('logo'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-7">
                                                <textarea name="address" class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : ''; ?>" id="shipping_address" placeholder="Address"><?= old('address'); ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shipping_address" class="col-sm-3 col-form-label">Shipping Address</label>
                                            <div class="col-sm-7">
                                                <textarea name="shipping_address" class="form-control <?= ($validation->hasError('shipping_address')) ? 'is-invalid' : ''; ?>" id="shipping_address" placeholder="Shipping Address"><?= old('shipping_address'); ?></textarea>
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('shipping_address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telephone" class="col-sm-3 col-form-label">Telephone</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="telephone" class="form-control <?= ($validation->hasError('telephone')) ? 'is-invalid' : ''; ?>" id="telephone" placeholder="Telephone" value="<?= old('telephone'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('telephone'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fax" class="col-sm-3 col-form-label">Fax</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="fax" class="form-control <?= ($validation->hasError('fax')) ? 'is-invalid' : ''; ?>" id="fax" placeholder="Fax" value="<?= old('fax'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('fax'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="npwp" class="form-control <?= ($validation->hasError('npwp')) ? 'is-invalid' : ''; ?>" id="npwp" placeholder="npwp" value="<?= old('npwp'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('npwp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="website" class="col-sm-3 col-form-label">Website</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="website" class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : ''; ?>" id="website" placeholder="website" value="<?= old('website'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('website'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-7">
                                                <input type="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="email" value="<?= old('email'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('email'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-group row">
                                            <label for="company_name" class="col-sm-5">Bank Account Detail</label>

                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="bank_name" class="form-control <?= ($validation->hasError('bank_name')) ? 'is-invalid' : ''; ?>" id="bank_name" placeholder="Bank name" value="<?= old('bank_name'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_branch" class="col-sm-3 col-form-label">Bank Branch</label>
                                            <div class="col-sm-7">
                                                <textarea name="bank_branch" class="form-control <?= ($validation->hasError('bank_branch')) ? 'is-invalid' : ''; ?>" id="bank_branch" placeholder="Bank branch"> <?= old('bank_branch'); ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_branch'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_address" class="col-sm-3 col-form-label">Bank Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="bank_address" class="form-control <?= ($validation->hasError('bank_address')) ? 'is-invalid' : ''; ?>" id="bank_address" placeholder="Bank address" value="<?= old('bank_address'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="account_number" class="form-control <?= ($validation->hasError('account_number')) ? 'is-invalid' : ''; ?>" id="account_number" placeholder="Account number" value="<?= old('account_number'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('account_number'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bautno" class="col-sm-3 col-form-label">Account Number</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="bautno" class="form-control <?= ($validation->hasError('bautno')) ? 'is-invalid' : ''; ?>" id="bautno" placeholder="Bank account under the Namw (Of)" value="<?= old('bautno'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bautno'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="swift_code" class="col-sm-3 col-form-label">Swift Code</label>
                                            <div class="col-sm-7">
                                                <input type="text" name="swift_code" class="form-control <?= ($validation->hasError('swift_code')) ? 'is-invalid' : ''; ?>" id="swift_code" placeholder="Swift code" value="<?= old('swift_code'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('swift_code '); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="swift_code " class="col-sm-3 col-form-label">Addtional Fitur</label>

                                        </div>

                                        <div class="form-group row">
                                            <label for="currency" class="col-sm-3 col-form-label">Currency</label>
                                            <div class="col-sm-7">
                                                <select name="currency" class="form-control <?= ($validation->hasError('currency')) ? 'is-invalid' : ''; ?>" id="currency" placeholder="Currency">
                                                    <option value="">--Chose currency--</option>
                                                    <?php foreach ($currency as $row) : ?>
                                                        <option value="<?= $row['id']; ?>" <?= ($row['id'] == old('currency')) ? 'selected' : ''; ?>><?= $row['currency_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('currency'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>