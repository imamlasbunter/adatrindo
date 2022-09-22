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
                    <form action="<?= base_url('sales/submit-payment') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
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
                                            <label for="username" class="col-sm-3 col-form-label">Cashier</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="cashier" class="form-control" value=" <?php echo session()->get('name'); ?>" readonly>
                                                <input type="hidden" name="id_cashier" class="form-control" value="<?php echo session()->get('isLoggedIn'); ?>" readonly>
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
                                            <select name="id_contact" class="form-control select-item" required>
                                                <option value="" selected>--Choice-</option>
                                                <!-- <option value="0">Umum</option> -->
                                                <?php foreach ($contact->getResultArray() as $row) : ?>
                                                    <option value="<?= $row['id_contact']; ?>"><?= $row['name']; ?> - <?= $row['company_name']; ?></option>
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
                                        <div class="input-group mb-3 input-group">
                                            <label for="termOfPayment" class="col-sm-3 col-form-label">Term Of Payment</label>
                                            <select name="totermOfPaymentp" class="form-control select-item" required>
                                                <option value="" selected>--Choice-</option>
                                                <!-- <option value="0">Umum</option> -->
                                                <?php foreach ($termOfPayment->getResultArray() as $row) : ?>
                                                    <option value="<?= $row['payment_term_id']; ?>"><?= $row['payment_term']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- right col -->
                        </div>
                        <!-- /.row -->

                        <!-- /.card -->
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">

                                <table class="table table-bordered table-striped table-sm table-hover" id="dataTable">
                                    <thead>
                                        <tr>

                                            <th style="width: 2%" scope="col" class="text-center">No</th>
                                            <th style="width: 10%" scope="col">Product Code</th>
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
                            <!-- /.card-body -->
                            <div class="row">
                                <div class="col-md-5"></div>
                                <div class="col-md-7">
                                    <div class="card" style="margin-right: 20px; display:none" id="form_discount">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <p class="text-left">Discount</p>
                                                    <p class="text-left">PPN</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary active" id="btnPersen" type="button" value="persen" onclick="persen(this)">%</button>
                                                            <button class="btn btn-outline-secondary" id="btnRp" type="button" value="rp" onclick="rp(this)">Rp.</button>
                                                        </div>
                                                        <input type="text" class="form-control" name="discount" id="disc_total" onchange="getDiscount(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                        <input type="hidden" name="disc_type" id="disc_type" value="persen">
                                                    </div>
                                                    <div class="input-group mb-2">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary " id="btnPpnOff" type="button" value="persen" onclick="ppnOff(this)">Off</button>
                                                            <button class="btn btn-outline-success active" id="btnPpnOn" type="button" value="rp" onclick="ppnOn(this)">On</button>
                                                        </div>
                                                        <input type="hidden" name="ppn_type" id="ppn_type" value="Off">
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="table-responsive">
                                                        <p class="lead font-weight-bold text-right">Invoice
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
                                                        <table class="table">
                                                            <tr>
                                                                <th style="width:50%">Subtotal:</th>
                                                                <td id="grantotal_display"></td>
                                                            </tr>
                                                            <div style="display:none;" id="discount_display_line">
                                                                <tr>
                                                                    <th style="width:50%">Discount:</th>
                                                                    <td id="discount_display">0</td>
                                                                </tr>
                                                            </div>
                                                            <div id="ppn_display_line">
                                                                <tr>
                                                                    <th style="width:50%">PPN</th>
                                                                    <td id="ppn_display"></td>
                                                                </tr>
                                                            </div>
                                                            <tr>
                                                                <th>Shipping:</th>
                                                                <td><input type="text" name="shipping_display" id="shipping_display" onchange="getShipping(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td id="grantotalPayment_display"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Payment:</th>
                                                                <td><input type="text" name="bayar_display" id="bayar_display" onchange="getPayment(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" min="0"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Remainder Payment</th>
                                                                <td id="sisa_display"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="no_invoice" id="no_invoice" value="<?php $month = date('m');
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
                                                                                                                echo 'INV' . $year . $month . $max; ?>">
                                                <input type="text" name="discount_amount" id="discount">
                                                <input type="text" name="grantotal" id="grantotal">
                                                <input type="hidden" name="ppn" id="ppn">
                                                <input type="text" name="shipping" id="shipping">
                                                <input type="text" name="grantotalPayment" id="grantotalPayment">
                                                <input type="hidden" name="payment" id="payment">
                                                <input type="hidden" name="sisa" id="sisa">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <span id="submit-payment" style="display:none">
                                    <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment </button>
                                </span>
                            </div>

                        </div>
                        <!-- /.card -->
                    </form>

                </div>
                <!-- end col-12 -->





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
    function getShipping(param) {
        console.log(param.value);
        var shipping_display = param.value;
        var grantotalPayment = parseInt(document.getElementById("grantotalPayment").value);
        document.getElementById("shipping_display").value = formatRupiah(shipping_display, 'Rp. ');
        var convert = parseInt(shipping_display.replace(/\D/g, ""));
        var grantotalPayment_new = convert + grantotalPayment;


        if (param.value == '') {
            document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(grantotalPayment);
            document.getElementById("grantotalPayment").value = grantotalPayment;
            document.getElementById("shipping").value = 0;
        } else {
            document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(grantotalPayment_new);
            document.getElementById("grantotalPayment").value = grantotalPayment_new;
            document.getElementById("shipping").value = convert;
        }
    }


    function getPayment(param) {
        var bayar = param.value;
        var grantotalPayment = document.getElementById("grantotalPayment").value;
        document.getElementById("bayar_display").value = formatRupiah(bayar, 'Rp. ');
        var convert = bayar.replace(/\D/g, "");
        document.getElementById("sisa_display").innerHTML = 'Rp. ' + toDots(grantotalPayment - convert);
        document.getElementById("sisa").value = (grantotalPayment - convert);
        document.getElementById("payment").value = convert;

    }

    function getDiscount(param) {
        var totPrice = document.getElementById("grantotal").value;
        var disc_total = document.getElementById("disc_total").value;
        var disc_type = document.getElementById("disc_type").value;
        var ppn = parseInt(document.getElementById("ppn").value);
        if (disc_type == 'persen') {
            // var disc = parseInt(disc_total / 100);
            var discPrice = parseInt(Math.round(totPrice * (disc_total / 100)));
            var resultPrice1 = (totPrice - discPrice);
            var new_ppn = parseInt(Math.round(0.11 * resultPrice1));
            var resultPrice = (totPrice - discPrice) + new_ppn;
            document.getElementById("discount_display_line").style.display = 'block';
            document.getElementById("discount").value = discPrice;
            document.getElementById("discount_display").innerHTML = 'Rp. ' + toDots(discPrice);
            document.getElementById("ppn").value = new_ppn;
            document.getElementById("ppn_display").innerHTML = 'Rp. ' + toDots(new_ppn);

            document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(resultPrice);
            document.getElementById("grantotalPayment").value = resultPrice;
        } else {

            var resultPrice1 = (totPrice - disc_total);
            var new_ppn = parseInt(Math.round(0.11 * resultPrice1));
            var resultPrice = (totPrice - disc_total) + new_ppn;
            document.getElementById("discount_display_line").style.display = 'block';
            document.getElementById("discount").value = disc_total;
            // document.getElementById("disc_total").value = 'Rp. ' + toDots(disc_total);

            document.getElementById("discount_display").innerHTML = 'Rp. ' + toDots(disc_total);
            document.getElementById("ppn").value = new_ppn;
            document.getElementById("ppn_display").innerHTML = 'Rp. ' + toDots(new_ppn);

            document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(resultPrice);
            document.getElementById("grantotalPayment").value = resultPrice;
        }

    }

    function persen(param) {
        // alert(this.value);
        var element = document.getElementById("btnRp");
        element.classList.remove("active");
        var element1 = document.getElementById("btnPersen");
        element1.classList.add("active");
        document.getElementById("disc_type").value = "persen";
    }

    function rp(param) {
        // alert(this.value);
        var element = document.getElementById("btnPersen");
        element.classList.remove("active");
        var element1 = document.getElementById("btnRp");
        element1.classList.add("active");
        document.getElementById("disc_type").value = "rp";
    }

    function ppnOff(param) {
        var totPrice = document.getElementById("grantotal").value;
        var disc_total = document.getElementById("discount").value;
        var resultPrice = (totPrice - disc_total);
        document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(resultPrice);
        document.getElementById("grantotalPayment").value = resultPrice;
        document.getElementById("ppn_display_line").style.display = 'none';
        document.getElementById("ppn_display").innerHTML = 0;
        document.getElementById("ppn").value = 0;
        var element = document.getElementById("btnPpnOn");
        element.classList.remove("active");
        var element1 = document.getElementById("btnPpnOff");
        element1.classList.add("active");
        document.getElementById("ppn_type").value = "ppnof";


    }

    function ppnOn(param) {
        // alert(this.value);
        var totPrice = document.getElementById("grantotal").value;
        var disc_total = document.getElementById("discount").value;
        var for_new_ppn = totPrice - disc_total;
        var new_ppn = parseInt(Math.round(0.11 * for_new_ppn));
        var resultPrice = (totPrice - disc_total) + new_ppn;
        document.getElementById("ppn").value = new_ppn;
        document.getElementById("ppn_display").innerHTML = 'Rp. ' + toDots(new_ppn);
        document.getElementById("grantotalPayment_display").innerHTML = 'Rp. ' + toDots(resultPrice);
        document.getElementById("grantotalPayment").value = resultPrice;

        document.getElementById("ppn_display_line").style.display = 'block';
        var element = document.getElementById("btnPpnOff");
        element.classList.remove("active");
        var element1 = document.getElementById("btnPpnOn");
        element1.classList.add("active");
        document.getElementById("ppn_type").value = "ppnon";
    }

    function toDots(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // var rupiah = document.getElementById('shipping_display');
    // rupiah.addEventListener('keyup', function(e) {
    //     rupiah.value = formatRupiah(this.value, 'Rp. ');
    // });


    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function updateQty(id) {
        $.ajax({
            url: '<?php echo base_url("sales/updateCart") ?>',
            type: 'POST',
            data: $('#form' + id).serialize(),
            success: function(data) {
                showdata();
                grandtotal();
            },
            error: function(jqXHR, textStatus, ex) {
                alert(textStatus + "," + ex + "," + jqXHR.responseText);
            }

        });

    }

    function showdata() {
        //console.log("test");
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url("sales/getData"); ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                if (data == '') {


                } else {
                    document.getElementById('submit-payment').style.display = 'block';
                    document.getElementById('form_discount').style.display = 'block';
                    var html = '';
                    var i;
                    var no = 1;
                    for (i = 0; i < data.length; i++) {
                        var total = 'Rp. ' + toDots(data[i].total);
                        var unit_price = 'Rp. ' + toDots(data[i].unit_price);
                        var quantity = data[i].quantity;
                        var disc = data[i].disc;
                        if (disc != null) {
                            var disc_display = '< style="margin-right: 10px; float: right;"> <b>Discount ' + data[i].disc + '%</b></span>';
                        } else {
                            var disc_display = '';
                        }
                        html +=
                            '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + data[i].product_code + '</td>' +
                            '<td>' + data[i].product_name + '</td>' +
                            '<td  class="text-center"><form id="form' + data[i].id + '"><input type="hidden" name="id_temp" id="id_temp" value="' + data[i].id + '" ><input type="number" name="qty_temp" id="qty_temp" value="' + data[i].quantity + '" min="1" max="' + data[i].max_qty + '" OnChange="updateQty(' + data[i].id + ')"  OnKeyup="updateQty(' + data[i].id + ')"  style="width: 100%" ></form></td>' +
                            '<td>' + unit_price + disc_display + '</td>' +
                            '<td>' + total + '</td>' +
                            '<td style="text-align:center;">' +
                            '<a class="btn btn-danger btn-xs" href="<?php echo base_url('sales/delete?id='); ?>' + data[i].id + '" onclick="return confirm("Are you sure?")"><i class="fas fa-trash nav-icon"></i></a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#showData').html(html);
                }
            }

        });
    }

    function grandtotal() {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url("sales/get-grand-total"); ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var i;
                for (i = 0; i < data.length; i++) {
                    var total_display = 'Rp. ' + toDots(data[i].grandtotal);
                    var total = parseInt(data[i].grandtotal);
                    var ppn = parseInt(Math.round(0.11 * total));
                    var ppn_display = 'Rp. ' + toDots(ppn);
                    var grantotalPayment = total + ppn;
                    var grantotalPayment_display = 'Rp. ' + toDots(total + ppn);
                    document.getElementById("grantotal_display").innerHTML = total_display;
                    document.getElementById("grantotalPayment_display").innerHTML = grantotalPayment_display;
                    document.getElementById("ppn_display").innerHTML = ppn_display;
                    document.getElementById("grantotal").value = total;
                    document.getElementById("grantotalPayment").value = grantotalPayment;
                    document.getElementById("ppn").value = ppn;
                }

            }

        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        showdata();
        grandtotal();

        //$('#mydata').dataTable();
        function toDots(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function showdata() {
            //console.log("test");
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url("sales/getData"); ?>',
                async: true,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    if (data == '') {


                    } else {
                        document.getElementById('submit-payment').style.display = 'block';
                        document.getElementById('form_discount').style.display = 'block';
                        var html = '';
                        var i;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            var total = 'Rp. ' + toDots(data[i].total);
                            var unit_price = 'Rp. ' + toDots(data[i].unit_price);
                            var quantity = data[i].quantity;
                            var disc = data[i].disc;
                            if (disc != null) {
                                var disc_display = '<span style="margin-right: 10px; float: right;"><b>Discount ' + data[i].disc + '%</b></span>';
                            } else {
                                var disc_display = '';
                            }

                            html +=
                                '<tr>' +
                                '<td>' + no++ + '</td>' +
                                '<td>' + data[i].product_code + '</td>' +
                                '<td>' + data[i].product_name + '</td>' +
                                '<td  class="text-center"><form id="form' + data[i].id + '"><input type="hidden" name="id_temp" id="id_temp" value="' + data[i].id + '" ><input type="number" name="qty_temp" id="qty_temp" value="' + data[i].quantity + '" min="1" max="' + data[i].max_qty + '" OnChange="updateQty(' + data[i].id + ')" OnKeyup="updateQty(' + data[i].id + ')" style="width: 100%" ></form></td>' +
                                '<td>' + unit_price + disc_display + '</td>' +
                                '<td>' + total + '</td>' +
                                '<td style="text-align:center;">' +
                                '<a class="btn btn-danger btn-xs" href="<?php echo base_url('sales/delete?id='); ?>' + data[i].id + '"  onclick="return confirm("Are you sure ?")"> <i class="fas fa-trash nav-icon"></i></a>' +
                                '</td>' +
                                '</tr>';
                        }
                    }
                    $('#showData').html(html);
                }

            });

        }


        function grandtotal() {
            var no_invoice = document.getElementById("no_invoice").value;
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url("sales/get-grand-total"); ?>',
                async: true,
                dataType: 'json',
                data: {
                    no_invoice: no_invoice
                },
                success: function(data) {
                    var i;
                    for (i = 0; i < data.length; i++) {
                        var total_display = 'Rp. ' + toDots(data[i].grandtotal);
                        var total = parseInt(data[i].grandtotal);
                        var ppn = parseInt(Math.round(0.11 * total));
                        var ppn_display = 'Rp. ' + toDots(ppn);
                        var grantotalPayment = total + ppn;
                        var grantotalPayment_display = 'Rp. ' + toDots(total + ppn);
                        document.getElementById("grantotal_display").innerHTML = total_display;
                        document.getElementById("grantotalPayment_display").innerHTML = grantotalPayment_display;
                        document.getElementById("ppn_display").innerHTML = ppn_display;
                        document.getElementById("grantotal").value = total;
                        document.getElementById("grantotalPayment").value = grantotalPayment;
                        document.getElementById("ppn").value = ppn;

                    }

                }

            });
        }



    });
</script>
<?= $this->endsection(); ?>