<!DOCTYPE html>
<html lang="en">
  <head>
      {{-- header include --}}
      @include('backend.include.header')

      <!-- vendor css include -->
         @include('backend.include.css')
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> bracket <span class="tx-info">plus</span> <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-60">The Admin Template For Perfectionist</div>
        @yield('content')
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

       {{-- script include --}}
   @include('backend.include.script')

  </body>
</html>
