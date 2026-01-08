 <!-- jQuery -->
 <script src="../assets/plugins/jquery/jquery.min.js"></script>
 <!-- Bootstrap 4 -->
 <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <!-- AdminLTE App -->
 <script src="../assets/dist/js/adminlte.min.js"></script>
 <!-- DataTables  & Plugins -->
 <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
 <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
 <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
 <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
 <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
 <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
 <script src="../assets/plugins/jszip/jszip.min.js"></script>
 <script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
 <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
 <script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
 <script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
 <script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 <!-- Select2 -->
 <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
 <!-- bs-custom-file-input -->
 <script src="../assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
 <!-- Halaman specific script -->
 <script>
     $(function() {
         bsCustomFileInput.init();
         //Initialize Select2 Elements
         $('#modal-tambah').on('shown.bs.modal', function() {
             $(this).find('.select2').select2({
                 width: '100%',
                 dropdownParent: $('#modal-tambah')
             });
         });

         $('[id^=modal-ubah]').on('shown.bs.modal', function() {
             $(this).find('.select2').select2({
                 width: '100%',
                 dropdownParent: $(this)
             });
         });

         $("#example1").DataTable({
             "responsive": true,
             "lengthChange": true,
             "autoWidth": false,
             "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
         }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
         $('#example2').DataTable({
             "paging": true,
             "lengthChange": true,
             "searching": true,
             "ordering": true,
             "info": true,
             "autoWidth": false,
             "responsive": true,
         });
     });
 </script>