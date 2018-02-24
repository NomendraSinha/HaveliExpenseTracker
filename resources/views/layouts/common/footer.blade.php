        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Designed &amp; Developed By - <a href="https://www.swarepro.com">Nomendra Sinha</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('swarepro/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('swarepro/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('swarepro/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('swarepro/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('swarepro/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('swarepro/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('swarepro/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('swarepro/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('swarepro/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('swarepro/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('swarepro/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('swarepro/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('swarepro/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('swarepro/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('swarepro/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('swarepro/build/js/custom.min.js?version=1.0.0') }}"></script>

    @yield('footer-style')
    @yield('footer-script')
    
  </body>
</html>