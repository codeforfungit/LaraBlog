@include('layouts._header')
@include('layouts._navbar')
@include('layouts._alert')
<div class="main-container container-fluid no-padding">
    <h1 class="text-center border-bottom" id="site-heading">{{$globalConfigs->site_title}}</h1>
    @if(Auth::check())
        <aside class="col-sm-2 no-padding sidebar-container">
            @include('layouts._sidebar')
        </aside>
    @endif
    <div class="{{Auth::check() ? '' : 'col-sm-offset-2'}} col-sm-10 no-padding">
        @yield('content')
    </div>
</div>
@include('layouts._footer')

