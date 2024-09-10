<a class="nav-link collapsed" href="#" aria-expanded="false" aria-controls="collapseLayouts">
    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
    {{$title}}
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>


<div class="collapse {{request()->is(trim(route('admin.'.$name .'.index', [], false), '/') . '/*') || request()->is(trim(route('admin.'.$name .'.index', [], false), '/')) ? 'show' : false }}" id="collapse{{$name}}" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">
        <a class="nav-link" href="{{route('admin.'.$name.'.index')}}">Danh sách</a>
    </nav>
</div>