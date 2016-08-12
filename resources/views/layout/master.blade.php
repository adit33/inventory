<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
     
    <link href="{{asset('/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{asset('lib/font-awesome-4.4.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/lib/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/lib/dist/css/skins/_all-skins.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/lib/datepicker/dist/css/bootstrap-datepicker.css')}}" rel="stylesheet" />

    <link href="{{asset('/lib/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('/lib/datatables/buttons/css/buttons.dataTables.css')}}" rel="stylesheet" /> 

    <link href="{{asset('/lib/datatables/media/css/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- <link href="{{asset('/lib/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css" /> -->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

    @include('layout.navbar')
      <!-- Left side column. contains the logo and sidebar -->
      
      @include('layout.left_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      @include('layout.right_sidebar')
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
    

    </div><!-- ./wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Konfirmasi</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data ini??</p>
            <input type="hidden" id="idhapus">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @yield('asset-js')
    
    <script src="{{asset('/lib/jquery/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('/lib/dist/js/app.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('/lib/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('/lib/dist/js/demo.js')}}" type="text/javascript"></script>
    
    
    <script src="{{asset('/lib/datatables/buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script> 
    <script src="{{asset('/lib/datatables/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script> 
    
    <script src="{{asset('/lib/datatables/buttons/js/buttons.bootstrap.js')}}" type="text/javascript"></script>
    
    <script src="{{asset('/lib/datatables/media/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>     

    @stack('scripts')  

  </body>
</html>