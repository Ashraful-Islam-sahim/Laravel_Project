<!DOCTYPE html>
<html lang="en">
  <head>
    {{-- header include --}}
    @include('backend.include.header')

    <!-- vendor css include -->include
       @include('backend.include.css')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('backend.include.menu')
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('backend.include.topbar')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('backend.include.rightsidebar')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    @yield('body')
      {{-- footer include --}}
      @include('backend.include.footer')
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

   {{-- script include --}}
   @include('backend.include.script')
  </body>
</html>
