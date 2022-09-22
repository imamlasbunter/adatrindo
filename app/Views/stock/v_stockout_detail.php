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
                            <a href="<?= base_url('stock-out') ?>" class="btn btn-primary btn-sm">Back</a>
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
                                    <h3 class="card-title">Data Products Stock Out</h3>
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
                                        <th scope="col">Qty</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date Stock Out</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($stockout as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['product_code']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['desc']; ?></td>
                                            <td><?= $row['created_at']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#stockout<?= $row['id']; ?>">
                                                    <i class="fas fa-edit nav-icon"></i>
                                                </button>
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
    <form action="<?= base_url('/stock-out/restore') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="stockout<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Form Stock Out Restore</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                        <input type="hidden" name="id" value="<?= $row['id']; ?>" readonly>
                        <input type="hidden" name="product_code" value="<?= $row['product_code']; ?>" readonly>
                        <input type="hidden" name="qty_so" value="<?= $row['qty']; ?>" readonly>
                        <input type="hidden" name="id_product_item" value="<?= $row['id_product_item']; ?>" readonly>
                        <input type="hidden" name="product_item_qty" value="<?= $row['quantity']; ?>" readonly>
                        <div class="form-group row">
                            <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                            <div class="col-sm-9">
                                <input type="number" name="quantity_restore_so" min="1" max="<?= $row['qty'] ?>" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" placeholder="Quantity" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('quantity'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea type="description" name="description" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : ''; ?>" id="description" placeholder="Reason restore stock out" required></textarea>
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
<script>
    // $('#quantity').live('keyup', function(e) {
    //     $(this).val($(this).val().replace(/[^0-9]/g, ''));
    // });
    //oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
    // function validate(id) {
    //     // var pattern = "^[0-9]*$";
    //     evt.value = evt.value.replace("^[0-9]*$", "");
    //     // const pattern = '/^[0-9]$/';
    //     // var val = document.getElementById('quantity').value;
    //     // alert(id);
    // }
</script>
<?= $this->endSection(); ?>