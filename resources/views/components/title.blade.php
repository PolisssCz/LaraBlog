@yield('title')
@if ( Request::segment(1) == 'post' || Request::segment(2) == 'edit' )
 
@else
    {{ ucfirst($title = Request::segment(1) ?: 'home' ) }} 
@endif
