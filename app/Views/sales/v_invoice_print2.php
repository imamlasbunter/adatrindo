<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  base_url() ?>/assets/dist/css/adminlte.min.css">
</head>

<body>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
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
    <section class="content" id="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Dari
                  <address>
                    <strong><?php echo $comp_name; ?></strong><br>
                    <?php echo $comp_address; ?><br>
                    Phone: <?php echo $comp_telp; ?><br>
                    Email: <?php echo $comp_email; ?>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  Kepada Yth.
                  <address>
                    <strong><?php echo $contact_name; ?></strong><br>
                    <?php echo $contract_address; ?><br>
                    Phone: <?php echo $contract_telp; ?><br>
                    Email: <?php echo $contract_email; ?>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <address>
                    <b>Invoice <?php echo $no_invoice; ?></b><br>
                    <!-- <b>Payment Due:</b> 2/22/2014<br>  -->

                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th style="width: 2%" scope="col" class="text-center">No</th>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th style="width: 7%" scope="col" class="text-center">Qty</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      foreach ($invoice as $row) : if ($row->disc != null) {
                          $disc_display = '<span style="margin-right: 10px; float: right;"><b>Discount ' . $row->disc . '%</b></span>';
                        } else {
                          $disc_display = '';
                        }
                      ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $row->product_code; ?></td>
                          <td><?php echo $row->product_name; ?></td>
                          <td><?php echo $row->quantity; ?></td>
                          <td><?php echo 'Rp. ' . number_format($row->unit_price, 0, ",", "."); ?> <?php echo $disc_display; ?></td>
                          <td><?php $price = $row->total;
                              $qty = $row->quantity;
                              echo 'Rp. ' . number_format(($price * $qty), 0, ",", "."); ?></td>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                      <p class="lead">Payment Methods:</p>
                      <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        <b><?php echo $comp_bank; ?> - <?php echo $comp_bank_account; ?><br>
                          A/n <?php echo $comp_bank_account_under_name; ?></b>
                      </p>
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead"></p>

                  <div class="table-responsive">
                    <table class="table">
                      <?php
                      foreach ($grandTotal as $row) {
                      ?>
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->grandtotal, 0, ",", "."); ?> </td>
                        </tr>
                        <?php if ($row->disc_all > 0) { ?>
                          <tr>
                            <th style="width:50%">Discount: &nbsp; <?php echo $row->disc_all . ' %'; ?></th>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($row->disc_amount_all, 0, ",", "."); ?> </td>
                          </tr>
                        <?php } ?>
                        <?php if ($row->ppn > 0) { ?>
                          <tr>
                            <th style="width:50%">PPN: &nbsp; <?php echo '11 %'; ?></th>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($row->ppn, 0, ",", "."); ?> </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <th style="width:50%">shipping:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->shipping, 0, ",", "."); ?> </td>
                        </tr>
                        <tr>
                          <th style="width:50%">Total Payment:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->grandtotalpayment, 0, ",", "."); ?> </td>
                        </tr>
                        <tr>
                          <th style="width:50%">Payment:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->payment, 0, ",", "."); ?></td>
                        </tr>
                        <tr>
                          <th>Remainder Payment</th>
                          <td class="text-right" id="sisa_display"><?php echo 'Rp. ' . number_format($row->remainder_payment, 0, ",", "."); ?></td>
                        </tr>


                      <?php } ?>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-6">
                </div>
                <div class="col-6">
                  <!-- <a href="<?php echo base_url('sales/surat-jalan?no_invoice=' . $no_invoice); ?>" target="_blank" rel="noopener" class="btn btn-default float-right" style="margin-right: 5px;"><i class=" fas fa-print"></i> Print Surat Jalan</a> -->

                  <button type="button" class="btn btn-default float-right"> <a href="<?php echo base_url('sales/invoice-print?no_invoice=' . $no_invoice); ?>" target="_blank" rel="noopener"><i class="fas fa-print"></i> Print Invoice</a>
                  </button>
                  <button type="button" class="btn btn-default float-right" style="margin-right: 5px;">
                    <a href="<?php echo base_url('sales/surat-jalan?no_invoice=' . $no_invoice); ?>" target="_blank" rel="noopener" style="margin-right: 5px;"><i class=" fas fa-print"></i> Print Surat Jalan</a>
                  </button>
                  <!-- <a href="v_invoice_print.php" target="_blank" rel="noopener" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a> -->
                  <!-- <a href="#" Onclick="printPdf()" rel="noopener" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a> -->

                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Page specific script -->
  <script>
    window.addEventListener("load", window.print());
  </script>

</body>

</html>