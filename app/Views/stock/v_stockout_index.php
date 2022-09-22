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
                    <!-- Alert saved -->
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Data Products</h3>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table1" class="table table-bordered table-striped table-sm table-hover">

                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Qty Minimum</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Puchase Price</th>
                                        <th scope="col">Last Purchase Price</th>
                                        <th scope="col">Selling Price</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($stockout as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['product_code']; ?></td>
                                            <td><?= $row['product_name']; ?></td>
                                            <td><?= $row['quantity']; ?></td>
                                            <td><?= $row['minimum_quantity']; ?></td>
                                            <td><?= $row['unit']; ?></td>
                                            <td><?= $row['purchase_price']; ?></td>
                                            <td><?= $row['last_purchase_price']; ?></td>
                                            <td><?= $row['selling_price']; ?></td>
                                            <td><?= $row['category']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#stockout<?= $row['id']; ?>">
                                                    <i class="fas fa-edit nav-icon"></i>
                                                </button>
                                                <a class="btn btn-info btn-xs" href="<?= base_url('stock-out/detail/' . $row['product_code']) ?>"><i class="fas fa-eye nav-icon"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
</div>

<!-- Modal -->
<?php foreach ($stockout as $row) : ?>
    <form action="<?= base_url('/stock-out/save') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="stockout<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Form Stock Out</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                        <input type="hidden" name="id" value="<?= $row['id']; ?>" readonly>
                        <input type="hidden" name="product_code" value="<?= $row['product_code']; ?>" readonly>
                        <input type="hidden" name="qty_before_stockout" value="<?= $row['quantity']; ?>" readonly>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" name="quantity" min="1" max="<?= $row['quantity']; ?>" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" placeholder="Quantity" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('quantity'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="description" name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" id="description" placeholder="Reason stock out" required></textarea>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('description'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>
<!-- End Modal -->
<?= $this->endSection(); ?>