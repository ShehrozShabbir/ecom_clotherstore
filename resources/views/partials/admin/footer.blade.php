  <script src="{{ url('admin/modules/jquery.min.js') }}"></script>
  <script src="{{ url('admin/modules/popper.js') }}"></script>
  <script src="{{ url('admin/modules/tooltip.js') }}"></script>
  <script src="{{ url('admin/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('admin/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ url('admin/modules/moment.min.js') }}"></script>

  <script src="{{ url('admin/modules/datatables/datatables.min.js') }}"></script>
  <script src="{{ url('admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
  <script src="{{ url('admin/modules/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ url('admin/js/page/modules-datatables.js') }}"></script>
  <script src="{{url('admin/modules/select2/dist/js/select2.full.min.js')}}"></script>



  <script src="{{ url('admin/modules/sweetalert/sweetalert.min.js') }}"></script>
  <script src="{{ url('admin/js/page/modules-sweetalert.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ url('admin/js/stisla.js') }}"></script>
  <script src="{{ url('admin/js/scripts.js') }}"></script>
  <script src="{{ url('admin/js/custom.js') }}"></script>
  @include('flashy::message')
@stack('js')
