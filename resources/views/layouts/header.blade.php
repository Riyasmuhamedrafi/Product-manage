<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product | Management</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/ekko-lightbox/ekko-lightbox.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    @include('layouts.footer')
</div>
<!-- ./wrapper -->
<script src="{{asset('plugins/jquery/jquery.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    var table;
    table = $('#example2').DataTable({
        'columnDefs': [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
        ],
        'select': {
            'style': 'multi'  // Allows multiple row selection
        },
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#delete-btn').on('click',function() {
        var selected_rows = table.column(0).checkboxes.selected();

        // Create an array to store selected product IDs
        var productIds = [];

        // Iterate over the selected rows and push product IDs to the array
        $.each(selected_rows, function(index, productId){
            productIds.push(productId);
        });

        if (productIds.length > 0) {
        $.ajax({
            url: $('#bulk-delete').attr('delete-product'),
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('#bulk-delete').attr('token') // Ensure this meta tag is present
            },
            data: {
                ids: productIds,
            },
            success: function(response) {
                if(response.status === 200){
                    toastr.success(response.message);
                    // Redirect if necessary
                    var redirectLocation = $('#bulk-delete').attr('redirect-loc');
                    if (redirectLocation) {
                        window.location.href = redirectLocation;
                    }
                }
                // Optionally refresh the table or provide feedback
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
        } else {
            alert('No rows selected!');
        }
        });
  });
</script>
</body>
</html>

