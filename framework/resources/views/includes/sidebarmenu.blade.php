<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="sidebar-search-wrapper">
            </li>
            <li class="nav-item start active open">
                <a href="{{ url('/dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-envelope-open"></i>
                    <span class="title">SMS Management</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('sendsms') }}" class="nav-link ">
                            <span class="title">Kirim SMS</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inbox') }}" class="nav-link ">
                            <span class="title">Kotak Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('outbox') }}" class="nav-link ">
                            <span class="title">SMS Terkirim</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('phonebook') }}" class="nav-link ">
                            <span class="title">Phonebook</span>
                        </a>
                    </li>
                    <!--li class="nav-item">
                        <a href="{{ route('cekpulsa') }}" class="nav-link ">
                            <span class="title">Cek Pulsa</span>
                        </a>
                    </li-->
                </ul>
            </li>
        </ul>
    </div>
</div>