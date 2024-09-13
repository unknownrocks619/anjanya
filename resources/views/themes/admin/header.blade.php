<!-- Page Header Start-->
<div class="page-header @isset($closeMenu) close_icon @endisset">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100 " type="text"
                            placeholder="Search Koho .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href="index.html"><img class="img-fluid for-light"
                        src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" alt=""><img
                        class="img-fluid for-dark" src="{{ \App\Classes\Helpers\SystemSetting::logo() }}"
                        alt=""></a>
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
            </div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">
            <div class="input-group">
                <input class="form-control system-search" type="text" placeholder="Search Here........"><span
                    class="input-group-text mobile-search"><i data-feather="search"></i></span>
            </div>
        </div>
        <div class="nav-right col-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li class="profile-nav onhover-dropdown p-0 me-0">
                    <div class="d-flex profile-media"><img class="b-r-50" src="../assets/images/dashboard/profile.png"
                            alt="">
                        <div class="flex-grow-1"><span>{{ auth()->guard('admin')->user()->getFullName() }}</span>
                            <p class="mb-0 font-roboto">Admin <i class="middle fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="{{ route('admin.admin-account.settings') }}"><i
                                    data-feather="user"></i><span>Account </span></a>
                        </li>
                </li>
                <li><button class="data-confirm btn btn-nav btn-danger ms-0 ps-0 w-100"
                        style="text-decoration:none;letter-spacing:1px;" data-confirm="Are you sure?" data-method="post"
                        data-action="{{ route('admin.logout') }}"><i data-feather="log-in">
                        </i><span>Log
                            Out</span></button></li>
            </ul>
            </li>
            </ul>
        </div>
    </div>
</div>
