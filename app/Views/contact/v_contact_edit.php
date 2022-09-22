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
                        <li class="breadcrumb-item active"><?= $h2; ?></li>
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
                            <h3 class="card-title">Form Edit Contact</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('contact/edit/' . $edit['id'])  ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                                        <input type="hidden" name="id" value="<?= $edit['id']; ?>" readonly>
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Name*</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" value="<?= $edit['name'] ?>" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Name" value="<?= old('name'); ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="contact_type" class="col-sm-3 col-form-label">Contact Type*</label>
                                            <div class="col-sm-9">
                                                <select name="contact_type" class="form-control <?= ($validation->hasError('contact_type')) ? 'is-invalid' : ''; ?>" id="contact_type" placeholder="Contact Type">
                                                    <option value="">--Chose Contact Type--</option>
                                                    <option value="1" <?= (old('contact_type') or $edit['type'] == '1')  ? "selected" : "" ?>>Customer</option>
                                                    <option value="2" <?= (old('contact_type') or $edit['type'] == '2') ? "selected" : "" ?>>Supplier</option>
                                                    <option value="3" <?= (old('contact_type') or $edit['type'] == '3') ? "selected" : "" ?>>Employee</option>
                                                    <option value="4" <?= (old('contact_type') or $edit['type'] == '4') ? "selected" : "" ?>>Vendor</option>
                                                    <option value="5" <?= (old('contact_type') or $edit['type'] == '5') ? "selected" : "" ?>>Others</option>

                                                </select>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('contact_type'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                                            <div class="col-sm-9">
                                                <input name="hp" value="<?= $edit['hp'] ?>" class="form-control <?= ($validation->hasError('hp')) ? 'is-invalid' : ''; ?>" id="hp" placeholder="Handphone" value="<?= old('hp'); ?>">
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('hp'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="identity_type" class="col-sm-3 col-form-label">Identity Type</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select name="identity_type" class="form-control <?= ($validation->hasError('identity_type')) ? 'is-invalid' : ''; ?>" id="identity_type" placeholder="Identity Type">
                                                            <option value="">--Chose Identity Type--</option>
                                                            <option value="1" <?= (old('identity_type') or $edit['identity_type'] == '1') ? "selected" : "" ?>>KTP</option>
                                                            <option value="2" <?= (old('identity_type') or $edit['identity_type'] == '2') ? "selected" : "" ?>>SIM</option>
                                                            <option value="3" <?= (old('identity_type') or $edit['identity_type'] == '3') ? "selected" : "" ?>>Passport</option>

                                                        </select>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('identity_type'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input name="no_identity" class="form-control <?= ($validation->hasError('no_identity')) ? 'is-invalid' : ''; ?>" id="no_identity" placeholder="Nomor Identity" value="<?= (old('no_identity')) ? old('no_identity') : $edit['no_identity'] ?>">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('no_identity'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="email" value="<?= (old('email')) ? old('email') : $edit['email']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('email'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="company_name" class="col-sm-3 col-form-label">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="company_name" class="form-control <?= ($validation->hasError('company_name')) ? 'is-invalid' : ''; ?>" id="company_name" placeholder="Company Name" value="<?= (old('company_name')) ? old('company_name') : $edit['company_name']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('company_name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="telephone" class="col-sm-3 col-form-label">Telephone</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="telephone" class="form-control <?= ($validation->hasError('telephone')) ? 'is-invalid' : ''; ?>" id="telephone" placeholder="Telephone" value="<?= (old('telephone')) ? old('telephone') : $edit['telp']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('telephone'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fax" class="col-sm-3 col-form-label">Fax</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="fax" class="form-control <?= ($validation->hasError('fax')) ? 'is-invalid' : ''; ?>" id="fax" placeholder="Fax" value="<?= (old('fax')) ? old('fax') : $edit['fax']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('fax'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="npwp" class="form-control <?= ($validation->hasError('npwp')) ? 'is-invalid' : ''; ?>" id="npwp" placeholder="NPWP" value="<?= (old('npwp')) ? old('npwp') : $edit['npwp']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('npwp'); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="payment_address" class="col-sm-3 col-form-label">Payment Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="payment_address" class="form-control <?= ($validation->hasError('payment_address')) ? 'is-invalid' : ''; ?>" id="payment_address" placeholder="Payment Address"> <?= (old('payment_address')) ? old('payment_address') : $edit['payment_address']; ?></textarea>
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('payment_address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="shipping_address" class="col-sm-3 col-form-label">Shipping Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="shipping_address" class="form-control <?= ($validation->hasError('shipping_address')) ? 'is-invalid' : ''; ?>" id="shipping_address" placeholder="Shipping Address"><?= (old('shipping_address')) ? old('shipping_address') : $edit['shipping_address']; ?></textarea>
                                                <div class=" invalid-feedback">
                                                    <?= $validation->getError('shipping_address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bank_name" class="form-control <?= ($validation->hasError('bank_name')) ? 'is-invalid' : ''; ?>" id="bank_name" placeholder="Bank name" value="<?= (old('bank_name')) ? old('bank_name') : $edit['shipping_address']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_name'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_branch" class="col-sm-3 col-form-label">Bank Branch</label>
                                            <div class="col-sm-9">
                                                <input name="bank_branch" class="form-control <?= ($validation->hasError('bank_branch')) ? 'is-invalid' : ''; ?>" id="bank_branch" placeholder="Bank Branch" value="<?= (old('bank_branch')) ? old('bank_branch') : $edit['bank_branch'];  ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_branch'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bank_address" class="col-sm-3 col-form-label">Bank Address</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bank_address" class="form-control <?= ($validation->hasError('bank_address')) ? 'is-invalid' : ''; ?>" id="bank_address" placeholder="Bank address" value="<?= (old('bank_address')) ? old('bank_address') : $edit['bank_address']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bank_address'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="account_number" class="form-control <?= ($validation->hasError('account_number')) ? 'is-invalid' : ''; ?>" id="account_number" placeholder="Account number" value="<?= (old('account_number')) ? old('account_number') : $edit['account_no']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('account_number'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bautno" class="col-sm-3 col-form-label">Bank account under the Name (Of)</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="bautno" class="form-control <?= ($validation->hasError('bautno')) ? 'is-invalid' : ''; ?>" id="bautno" placeholder="Bank account under the Name (Of)" value="<?= (old('bautno')) ? old('bautno') : $edit['bautno']; ?>">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('bautno'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="reset" class="btn btn-primary">Reset</button>
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