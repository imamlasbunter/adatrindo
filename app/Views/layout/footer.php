<footer class="main-footer">
  <strong>Copyright &copy; 2021 <a href="https://lasbunter.blogspot.com/">Bubur Ayam Studio</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 1.0
  </div>
</footer>



</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap
<script src="<?= base_url() ?>/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url() ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>/assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url() ?>/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>

<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>

<!-- page script -->
<script>
  $(function() {
    $("#modalTabel").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table2").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });

    $("#table_customer").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table_supplier").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table_employee").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table_vendor").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $("#table_others").DataTable({
      "responsive": true,
      "autoWidth": false,
      "ordering": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


  });

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    //Date picker
    $('#date_start_picker').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    //Date picker
    $('#date_end_picker').datetimepicker({
      format: 'DD-MM-YYYY',
      useCurrent: false
    });
    $("#date_start_picker").on("change.datetimepicker", function(e) {
      $('#date_end_picker').datetimepicker('minDate', e.date);
    });
    $("#date_end_picker").on("change.datetimepicker", function(e) {
      $('#date_start_picker').datetimepicker('maxDate', e.date);
    });
    $('#date_daily_weekly_picker').datetimepicker({
      viewMode: 'years',
      format: 'MM-YYYY'
    });
    $('#year_start_picker').datetimepicker({
      viewMode: 'years',
      format: 'YYYY'
    });
    $('#year_end_picker').datetimepicker({
      viewMode: 'years',
      format: 'YYYY'
    });
  });
</script>

</body>

</html>