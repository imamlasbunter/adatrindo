<?= $this->extend('layout/layout'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <!-- <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div> -->


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                Date : <?php echo date('d-m-Y'); ?>
                <address>
                  <strong><?php echo $no_invoice; ?></strong><br>

                  <!-- 795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com -->

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
                    foreach ($invoice as $row) : ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->product_code; ?></td>
                        <td><?php echo $row->product_name; ?></td>
                        <td><?php echo $row->quantity; ?></td>
                        <td><?php echo 'Rp. ' . number_format($row->unit_price, 0, ",", "."); ?></td>
                        <td><?php $price = $row->unit_price;
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
                <p class="lead"></p>


                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">

                </p>
              </div>
              <!-- /.col -->
              <div class="col-6">
                <p class="lead"></p>

                <div class="table-responsive">
                  <table class="table">
                    <?php
                    foreach ($grandTotal as $row) {
                      if ($row->disc_category == 'all') {
                    ?>
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->grandtotal, 0, ",", "."); ?> </td>
                        </tr>
                        <?php if ($row->disc_all > 0) { ?>
                          <tr>
                            <th style="width:50%">Discount: &nbsp; <?php echo $row->disc . ' %'; ?></th>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($row->disc_amount, 0, ",", "."); ?> </td>
                          </tr>
                        <?php } ?>
                        <?php if ($row->ppn > 0) { ?>
                          <tr>
                            <th style="width:50%">PPN: &nbsp; <?php echo '10 %'; ?></th>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($row->ppn, 0, ",", "."); ?> </td>
                          </tr>
                        <?php } ?>
                        <tr>
                          <th style="width:50%">Total Payment:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->grandtotalpayment, 0, ",", "."); ?> </td>
                        </tr>
                      <?php } else { ?>
                        <tr>
                          <th style="width:50%">Total Payment:</th>
                          <td class="text-right"><?php echo 'Rp. ' . number_format($row->grandtotal, 0, ",", "."); ?> </td>
                        </tr>
                      <?php } ?>
                    <?php } ?>

                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="" onclick="prinfPDF()" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Print</a>

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
<script>
  // window.addEventListener("load", window.print());
  function printPdf(url) {
    var iframe = document.createElement('iframe');
    // iframe.id = 'pdfIframe'
    iframe.className = 'pdfIframe'
    document.body.appendChild(iframe);
    iframe.style.display = 'none';
    iframe.onload = function() {
      setTimeout(function() {
        iframe.focus();
        iframe.contentWindow.print();
        URL.revokeObjectURL(url)
        // document.body.removeChild(iframe)
      }, 1);
    };
    iframe.src = url;
    // URL.revokeObjectURL(url)
  }
</script>
<?= $this->endsection(); ?>