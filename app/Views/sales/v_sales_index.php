<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Main Menu</li>
                        <li class="breadcrumb-item active"><?= $h1; ?></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">
                            <?php /// $breadcrumb; 
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
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date" class="form-control" value="<?php echo date('Y-m-d') ?>">

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Kasir</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date" class="form-control" value=" <?php echo session()->get('name'); ?>" readonly>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Customer</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="date" class="form-control" value="" readonly>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- left col -->
                        <!-- middle col-->
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-header">
                                    <div class="input-group mb-3">

                                        <label for="product_code" class="col-sm-3 col-form-label">Product</label>
                                        <input name="product" id="product" type="text" class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#getproduct"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3 input-group">
                                        <label for="product_code" class="col-sm-3 col-form-label">Customer</label>
                                        <select class="form-control select-item">
                                            <option value="0" selected>Umum</option>
                                            <?php foreach ($contact->getResultArray() as $row) : ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- middle col -->
                        <!-- Right col-->
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold text-right" style="font-size: 20px;">Invoice
                                        <?php $month = date('m');
                                        $year = date('y');
                                        foreach ($invoice->getResultArray() as $row) {
                                            $max = $row['no_inv_max'];
                                            $cek = strlen($max);
                                            if ($cek == 0) {
                                                $max = "0001";
                                            }
                                            if ($cek == 1) {
                                                $max = "000" . $max;
                                            }
                                            if ($cek == 2) {
                                                $max = "00" . $max;
                                            }
                                            if ($cek == 3) {
                                                $max = "0" . $max;
                                            }
                                            if ($cek == 4) {
                                                $max = $max;
                                            }
                                        }
                                        echo 'INV' . $year . $month . $max; ?></p>
                                    <p class="font-weight-bold text-right" style="font-size: 40px;">7.000.000.000.000</p>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- <div class="col-md-4">

                            <div class="card">
                                <div class="card-header">right</div>
                            </div>
                         
                    </div> -->
                        <!-- right col -->
                    </div>
                    <!-- /.row -->

                    <!-- /.card -->
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="reload">
                                <table class="table table-bordered table-striped table-sm table-hover" id="dataTable">
                                    <thead>
                                        <tr>

                                            <th style="width: 2%" scope="col" class="text-center">No</th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th style="width: 7%" scope="col" class="text-center">Qty</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Total</th>
                                            <th style="width: 5%" scope="col"></th>
                                        </tr>
                                    </thead>                                   
                                    <tbody id="showData">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<?php foreach ($product as $row) : ?>
    <form action="<?= base_url('/stock-out/save') ?>" method="POST" enctype="multipart/form-data">
        <div class="modal fade bd-example-modal-lg" id="getproduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Products</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usernamelogin" value="<?php echo session()->get('username'); ?>" readonly>
                        <input type="hidden" name="id" value="<?= $row['id']; ?>" readonly>
                        <input type="hidden" name="product_code" value="<?= $row['product_code']; ?>" readonly>
                        <input type="hidden" name="qty_before_cart" value="<?= $row['quantity']; ?>" readonly>
                        <table id="modalTabel" class="table table-bordered table-striped table-sm table-hover">
                            <thead>
                                <tr>

                                    <th scope="col">Product Code</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product as $row) : ?>

                                    <tr>

                                        <td><?= $row['product_code']; ?></td>
                                        <td><?= $row['product_name']; ?></td>
                                        <td><?= $row['quantity']; ?></td>
                                        <td><a href="<?= base_url('sales/add?id=' . $row['id']); ?>" class="btn btn-primary btn-sm">Select</a>
                                        </td>
                                    </tr>


                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>
<!-- End Modal -->
<script>
    function toDots(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        
		$('#showData').load("<?php echo base_url();?>sales/loadData");


    });
</script>
<?= $this->endsection(); ?>