<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>

<?php header("Access-Control-Allow-Origin: *"); ?>
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
                        <div class="card-body" id="dataCart">
                                <table class="table table-bordered table-striped table-sm table-hover">
                                    <thead>
                                        <tr>

                                            <th style="width: 2%" scope="col" class="text-center">No</th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th style="width: 7%" scope="col" class="text-center">Qty</th>
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Total</th>
                                            <th style="width: 10%" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php $no = 1;
                                    foreach ($cart as $row) : ?>

                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo $row->product_code; ?></td>
                                            <td><?php echo $row->product_name; ?></td>
                                            <td class="text-center ">
                                                <form id="form<?php echo $row->id;?>">
                                                <input type="hidden" name="id_temp" id="id_temp" value="<?php echo $row->id; ?>" style="width: 100%">
                                                <input type="number" name="qty_temp" id="qty_temp" value="<?php echo $row->quantity; ?>" min="1" max="<?= $row->max_qty;?>"  OnChange="updateQty(<?php echo $row->id; ?>)" OnKeyup="updateQty(<?php echo $row->id; ?>)" style="width: 100%">
                                                </form>

                                            </td>
                                            <td><?php echo 'Rp. ' . number_format($row->unit_price, 0, ",", "."); ?></td>
                                            <td><?php $price = $row->unit_price;
                                                $qty = $row->quantity;
                                                echo 'Rp. ' . number_format(($price * $qty), 0, ",", "."); ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-danger btn-xs item_hapus">Delete</a>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script>
    function updateQty(id) {
        $.ajax({
            crossOrigin: true,
            url: '<?php echo base_url("sales/updateCart")?>',
            type: 'POST',
            dataType: 'html',
            data: $('#form'+id).serialize(),
            success: function(res){
                 $('#dataCart').html(res);
            },
            error: function(jqXHR, textStatus, ex) {
                alert(textStatus + "," + ex + "," + jqXHR.responseText);
            }    

        });
    
    }
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        tampil_data_barang();

        //$('#mydata').dataTable();


        function tampil_data_barang() {
            //console.log("test");
            $.ajax({
                type: 'GET',
                url: '<?php //echo base_url("sales/getData"); ?>',
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + data[i].product_code + '</td>' +
                            '<td>' + data[i].product_name + '</td>' +
                            '<td>' + data[i].quantity + '</td>' +
                            '<td>' + data[i].unit_price + '</td>' +
                            '<td>' + data[i].unit_price + '</td>' +
                            '<td style="text-align:right;">' +
                            '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="' + data[i].product_code + '">Edit</a>' + ' ' +
                            '<a href="javascript:;" class="btn btn-danger btn-xs item_hapus" data="' + data[i].product_code + '">Hapus</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }
    });
</script> -->
<?= $this->endsection(); ?>