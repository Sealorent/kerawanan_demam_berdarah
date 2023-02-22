<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo-jember.png') }}" width="40" height="40">
            </span>
            <span class="app-brand-text fw-bolder ms-2">DBD JEMBER</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <hr>
    
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons fa fa-home"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <!-- <li class="menu-item  {{ Request::segment(2) == 'data-potensi' ? 'active  open' : '' }} ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Data Potensi</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::segment(3) == 'potensi' ? 'active' : '' }}">
                    <a href="{{ route('potensi.index') }}" class="menu-link">
                        {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                        <div data-i18n="Analytics">Potensi</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(3) == 'klimatologi' ? 'active' : '' }}">
                    <a href="{{ route('klimatologi.index') }}" class="menu-link">
                        {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                        <div data-i18n="Analytics">Klimatologi</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(3) == 'vektor' ? 'active' : '' }}">
                    <a href="{{ route('vektor.index') }}" class="menu-link">
                        {{-- <i class="menu-icon tf-icons bx bx-home-circle"></i> --}}
                        <div data-i18n="Analytics">Dengue Vector</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="menu-item  {{ Request::segment(2) == 'data-metode' ? 'active  open' : '' }} ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Data Metode</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::segment(3) == '' ? 'active' : '' }}">
                    <a href="{{ route('fuzzyGa.index') }}" class="menu-link">
                        <div data-i18n="Accordion">Fuzzy + GA</div>
                    </a>
                </li>
            </ul>
        </li> --}}
        <li class="menu-item  {{ Request::segment(2) == 'data-master' ? 'active  open' : '' }} ">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="User interface">Data Master</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::segment(3) == 'kecamatan' ? 'active' : '' }}">
                    <a href="{{ route('kecamatan.index') }}" class="menu-link">
                        <div data-i18n="Accordion">Data Kecamatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(3) == 'rule' ? 'active' : '' }}">
                    <a href="{{ route('rule.index') }}" class="menu-link">
                        <div data-i18n="Accordion">Data Rule</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(3) == 'kasus' ? 'active' : '' }}">
                    <a href="{{ route('kasus.index') }}" class="menu-link">
                        <div data-i18n="Accordion">Data Kasus</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::segment(3) == 'tindakan' ? 'active' : '' }}">
                    <a href="{{ route('tindakan.index') }}" class="menu-link">
                        <div data-i18n="Accordion">Data Tindakan</div>
                    </a>
                </li>
            </ul>
        </li> -->
        
        <li class="menu-item {{ Request::segment(3) == 'potensi' ? 'active' : '' }}">
            <a href="{{ route('potensi.index') }}" class="menu-link">
                <i class="menu-icon fa fa-pie-chart"></i>
                <div data-i18n="Analytics">Data Potensi</div>
            </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'kasus' ? 'active' : '' }}">
            <a href="{{ route('kasus.index') }}" class="menu-link">
                <i class="menu-icon fa fa-users"></i>
                <div data-i18n="Analytics">Data Kasus</div>
            </a>
        </li>
        <li class="menu-item {{ Request::segment(3) == 'tindakan' ? 'active' : '' }}">
            <a href="{{ route('tindakan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons fa fa-ambulance"></i>
                <div data-i18n="Analytics">Data Tindakan</div>
            </a>
        </li>
        <li class="menu-item {{ Request::segment(2) == 'metode' ? 'active' : '' }}">
            <a href="{{ route('metode') }}" class="menu-link">
                <i class="menu-icon tf-icons fa fa-tasks"></i>
                <div data-i18n="Analytics">Informasi Metode</div>
            </a>
        </li>
    </ul>
</aside>
