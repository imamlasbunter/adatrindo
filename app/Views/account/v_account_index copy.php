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
                            <?php //$breadcrumb; 
                            ?>
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
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <div class="col-md-5">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Account Categories</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body  p-0">
                                    <div class="table-responsive table-striped table-sm table-hover">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!$accountcategory) : ?>
                                                    <tr>

                                                        <td colspan="5">No data display</td>


                                                    </tr>
                                                <?php else : ?>
                                                    <?php $no = 1;
                                                    foreach ($accountcategory as $row) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $row['name']; ?></td>
                                                        </tr>


                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <a href="<?= base_url('journal-setting/category/add') ?>" class="btn btn-sm btn-primary float-left">Add Account Category</a>
                                    <a href="<?= base_url('journal-setting/category') ?>" class="btn btn-sm btn-info float-right">View All</a>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <!-- Right col-->
                        <div class="col-md-7">
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Account List</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body  p-0">
                                    <div class="table-responsive table-striped table-sm table-hover">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Account Number</th>
                                                    <th>Account Name</th>
                                                    <th>Category</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!$accountlist) : ?>
                                                    <tr>

                                                        <td colspan="5">No data display</td>


                                                    </tr>
                                                <?php else : ?>
                                                    <?php $no = 1;
                                                    foreach ($accountlist as $row) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $row['account_number']; ?></td>
                                                            <td><?= $row['account_name']; ?></td>
                                                            <td><?= $row['name']; ?>

                                                        </tr>


                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <a href="<?= base_url('journal-setting/list/add') ?>" class="btn btn-sm btn-primary float-left">Add Account List</a>
                                    <a href="<?= base_url('journal-setting/list/') ?>" class="btn btn-sm btn-info float-right">View All</a>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                        <!-- Right col-->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="card">

                        <div class="card-header">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <h3 class="card-title"><a class="btn btn-success" href="<?= base_url('items/add') ?>">Add Items Product</a></h3> -->
                                        <h3 class="card-title">Mapping Account</h3>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-sales" role="tab" aria-controls="v-pills-sales" aria-selected="true">Sales</a>
                                        <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase" role="tab" aria-controls="v-pills-purchase" aria-selected="false">Purchase</a>
                                        <a class="nav-link" id="v-pills-raap-tab" data-toggle="pill" href="#v-pills-raap" role="tab" aria-controls="v-pills-raap" aria-selected="false">AR/AP</a>
                                        <a class="nav-link" id="v-pills-stock-tab" data-toggle="pill" href="#v-pills-stock" role="tab" aria-controls="v-pills-stock" aria-selected="false">Stock</a>
                                        <a class="nav-link" id="v-pills-others-tab" data-toggle="pill" href="#v-pills-others" role="tab" aria-controls="v-pills-others" aria-selected="false">Others</a>
                                        <a class="nav-link" id="v-pills-multicurrency-tab" data-toggle="pill" href="#v-pills-multicurrency" role="tab" aria-controls="v-pills-multicurrency" aria-selected="false">Multi Currency</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <form action="<?= base_url('journal-setting/save_data') ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username');
                                                                                            ?>" readonly>
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-sales" role="tabpanel" aria-labelledby="v-pills-sales-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="sales_revenue" class="col-sm-3">Sales Revenue</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Revenue">
                                                                <select name="sales_revenue" class="form-control <?= ($validation->hasError('sales_revenue')) ? 'is-invalid' : ''; ?>" id="sales_revenue" placeholder="Sales Revenue">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('sales_revenue')) ? 'selected' : '' ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('sales_revenue');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="sales_discount" class="col-sm-3">Sales Discount</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Discount">
                                                                <select name="sales_discount" class="form-control <?= ($validation->hasError('sales_discount')) ? 'is-invalid' : ''; ?>" id="sales_discount" placeholder="Sales Discount">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('sales_discount')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('sales_discount');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="sales_return" class="col-sm-3">Sales Return</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Return">
                                                                <select name="sales_return" class="form-control <?= ($validation->hasError('sales_return')) ? 'is-invalid' : ''; ?>" id="sales_return" placeholder="Sales Return">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('sales_return')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('sales_return');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="sales_delivery" class="col-sm-3">Sales Delivery</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Delivery">
                                                                <select name="sales_delivery" class="form-control <?= ($validation->hasError('sales_delivery')) ? 'is-invalid' : ''; ?>" id="sales_delivery" placeholder="Sales Delivery">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('sales_delivery')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('sales_delivery');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="advance_payment" class="col-sm-3">Advance Payment</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Payment">
                                                                <select name="advance_payment" class="form-control <?= ($validation->hasError('advance_payment')) ? 'is-invalid' : ''; ?>" id="advance_payment" placeholder="Advance Payment">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('advance_payment')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('advance_payment');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="unbilled_sales" class="col-sm-3">Unbilled Sales</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Unbilled Sales">
                                                                <select name="unbilled_sales" class="form-control <?= ($validation->hasError('unbilled_sales')) ? 'is-invalid' : ''; ?>" id="unbilled_sales" placeholder="Unbilled Sales">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('unbilled_sales')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('unbilled_sales');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="unbilled_receivables" class="col-sm-3">Unbilled Receivables</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Receivables">
                                                                <select name="unbilled_receivables" class="form-control <?= ($validation->hasError('unbilled_receivables')) ? 'is-invalid' : ''; ?>" id="unbilled_receivables" placeholder="Unbilled Receivables">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('unbilled_receivables')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('unbilled_receivables');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="sales_tax_payable" class="col-sm-3">Sales Tax Payable</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Sales">
                                                                <input type="hidden" name="item_mapping[]" value="Sales Tax Payable">
                                                                <select name="sales_tax_payable" class="form-control <?= ($validation->hasError('sales_tax_payable')) ? 'is-invalid' : ''; ?>" id="sales_tax_payable" placeholder="Sales Tax Payable">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('sales_tax_payable')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('sales_tax_payable');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel" aria-labelledby="v-pills-purchase-tab">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="purchase_COGS" class="col-sm-3">Purchase (COGS)</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Purchase">
                                                                <input type="hidden" name="item_mapping[]" value="Purchase (COGS)">
                                                                <select name="purchase_COGS" class="form-control <?= ($validation->hasError('purchase_COGS')) ? 'is-invalid' : ''; ?>" id="purchase_COGS" placeholder="Purchase (COGS)">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('purchase_COGS')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('purchase_COGS');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="purchase_delivery" class="col-sm-3">Purchase Delivery</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Purchase">
                                                                <input type="hidden" name="item_mapping[]" value="Purchase (COGS)">
                                                                <select name="purchase_delivery" class="form-control <?= ($validation->hasError('purchase_delivery')) ? 'is-invalid' : ''; ?>" id="purchase_delivery" placeholder="Purchase Delivery">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('purchase_delivery')) ? 'selected' : ''; ?>>
                                                                            <?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('purchase_delivery');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="down_payment" class="col-sm-3">Down payment</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Purchase">
                                                                <input type="hidden" name="item_mapping[]" value="Down payment">
                                                                <select name="down_payment" class="form-control <?= ($validation->hasError('down_payment')) ? 'is-invalid' : ''; ?>" id="down_payment" placeholder="Down payment">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('down_payment')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('down_payment');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="unpaid_debt" class="col-sm-3">Unpaid Debt</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Purchase">
                                                                <input type="hidden" name="item_mapping[]" value="Unpaid Debt">
                                                                <select name="unpaid_debt" class="form-control <?= ($validation->hasError('unpaid_debt')) ? 'is-invalid' : ''; ?>" id="unpaid_debt" placeholder="Unpaid Debt">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('unpaid_debt')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('unpaid_debt');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="purchase_tax" class="col-sm-3">Purchase Tax</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Purchase">
                                                                <input type="hidden" name="item_mapping[]" value="Purchase Tax">
                                                                <select name="purchase_tax" class="form-control <?= ($validation->hasError('purchase_tax')) ? 'is-invalid' : ''; ?>" id="purchase_tax" placeholder="Purchase Tax">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('purchase_tax')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('purchase_tax');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-raap" role="tabpanel" aria-labelledby="v-pills-raap-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="accounts_receivable" class="col-sm-3">Accounts Receivable</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="ar_ap">
                                                                <input type="hidden" name="item_mapping[]" value="Accounts Receivable">
                                                                <select name="accounts_receivable" class="form-control <?= ($validation->hasError('accounts_receivable')) ? 'is-invalid' : ''; ?>" id="accounts_receivable" placeholder="Accounts Receivable">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('accounts_receivable')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('accounts_receivable');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="account_payable" class="col-sm-3">Account Payable</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="ar_ap">
                                                                <input type="hidden" name="item_mapping[]" value="Accounts Payable">
                                                                <select name="account_payable" class="form-control <?= ($validation->hasError('account_payable')) ? 'is-invalid' : ''; ?>" id="account_payable" placeholder="Account Payable">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('account_payable')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('account_payable');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="v-pills-stock" role="tabpanel" aria-labelledby="v-pills-stock-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="stock" class="col-sm-3">Stock</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Stock">
                                                                <input type="hidden" name="item_mapping[]" value="Stock">
                                                                <select name="stock" class="form-control <?= ($validation->hasError('stock')) ? 'is-invalid' : ''; ?>" id="stock" placeholder="Stock">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('stock')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('stock');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="general_supplies" class="col-sm-3">General Supplies</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Stock">
                                                                <input type="hidden" name="item_mapping[]" value="General Supplies">
                                                                <select name="general_supplies" class="form-control <?= ($validation->hasError('general_supplies')) ? 'is-invalid' : ''; ?>" id="general_supplies" placeholder="General Supplies">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('general_supplies')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('general_supplies');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="broken_inventory" class="col-sm-3">Broken Inventory</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Stock">
                                                                <input type="hidden" name="item_mapping[]" value="Broken Inventory">
                                                                <select name="broken_inventory" class="form-control <?= ($validation->hasError('broken_inventory')) ? 'is-invalid' : ''; ?>" id="broken_inventory" placeholder="Broken Inventory">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('broken_inventory')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('broken_inventory');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="production_inventory" class="col-sm-3">Production Inventory</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Stock">
                                                                <input type="hidden" name="item_mapping[]" value="Production Inventory">
                                                                <select name="production_inventory" class="form-control <?= ($validation->hasError('production_inventory')) ? 'is-invalid' : ''; ?>" id="production_inventory" placeholder="Production Inventory">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('production_inventory')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('production_inventory');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-others" role="tabpanel" aria-labelledby="v-pills-others-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="initial_balance_equity" class="col-sm-3">Initial Balance Equity</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Others">
                                                                <input type="hidden" name="item_mapping[]" value="Initial Balance Equity">
                                                                <select name="initial_balance_equity" class="form-control <?= ($validation->hasError('initial_balance_equity')) ? 'is-invalid' : ''; ?>" id="initial_balance_equity" placeholder="Initial Balance Equity">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('initial_balance_equity')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('initial_balance_equity');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="fixed_assets" class="col-sm-3">Fixed assets</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Others">
                                                                <input type="hidden" name="item_mapping[]" value="Fixed assets">
                                                                <select name="fixed_assets" class="form-control <?= ($validation->hasError('fixed_assets')) ? 'is-invalid' : ''; ?>" id="fixed_assets" placeholder="Fixed assets">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('fixed_assets')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('fixed_assets');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-multicurrency" role="tabpanel" aria-labelledby="v-pills-multicurrency-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="bank_revaluation" class="col-sm-3">Bank Revaluation</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Multy Currency">
                                                                <input type="hidden" name="item_mapping[]" value="Bank Revaluation">
                                                                <select name="bank_revaluation" class="form-control <?= ($validation->hasError('bank_revaluation')) ? 'is-invalid' : ''; ?>" id="bank_revaluation" placeholder="Bank Revaluation">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('bank_revaluation')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('bank_revaluation');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <span for="realized_profit_loss" class="col-sm-3">Realized Profit/Loss</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Multy Currency">
                                                                <input type="hidden" name="item_mapping[]" value="Realized Profit/Loss">
                                                                <select name="realized_profit_loss" class="form-control <?= ($validation->hasError('realized_profit_loss')) ? 'is-invalid' : ''; ?>" id="realized_profit_loss" placeholder="Realized Profit/Loss">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('realized_profit_loss')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('realized_profit_loss');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <span for="profit_loss_before_realization" class="col-sm-3">Profit/Loss Before Realization</span>
                                                            <div class="col-sm-9">
                                                                <input type="hidden" name="cat_mapping[]" value="Multy Currency">
                                                                <input type="hidden" name="item_mapping[]" value="Profit/Loss Before Realization">
                                                                <select name="profit_loss_before_realization" class="form-control <?= ($validation->hasError('profit_loss_before_realization')) ? 'is-invalid' : ''; ?>" id="profit_loss_before_realization" placeholder="Profit/Loss Before Realization">
                                                                    <option value="">--Chose Account--</option>
                                                                    <?php foreach ($accountlist as $row) :
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" <?= ($row['id'] == old('profit_loss_before_realization')) ? 'selected' : ''; ?>><?php echo $row['account_number'] . ' - ' . $row['account_name']; ?></option>
                                                                    <?php endforeach;
                                                                    ?>
                                                                    <select>
                                                                        <div class="invalid-feedback">
                                                                            <?= $validation->getError('profit_loss_before_realization');
                                                                            ?>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                </div>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button type="submit" class="btn btn-sm btn-primary float-left">Save</button>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>

    </section>
</div>


<?= $this->endSection(); ?>