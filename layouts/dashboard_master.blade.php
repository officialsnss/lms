@include('frontend.infixlmstheme.layouts.header')

<div class="dashboard_main_wrapper">
    @include('frontend.infixlmstheme.layouts.sidebar')

    <section class="main_content dashboard_part">
        @include('frontend.infixlmstheme.layouts.dashboard_menu')
        @yield('mainContent')
    </section>
</div>
<input type="hidden" name="app_debug" class="app_debug" value="{{env('APP_DEBUG') }}">
@include('frontend.infixlmstheme.layouts.footer')
