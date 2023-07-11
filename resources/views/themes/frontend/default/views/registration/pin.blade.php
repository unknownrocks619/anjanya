@extends($user_theme->frontend_layout($extends))

@section('title')
    Application Form
@endsection


@push('page_settings')
    <link rel="stylesheet" href="{{ asset('frontend/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
@endpush

@section('main')
    {!! $user_theme->partials('pre-loader', ['title' => 'Membership Registration']) !!}

    <!-- site wrapper -->
    <div class="site-wrapper">

        <div class="main-overlay"></div>

        {!! $user_theme->partials('header') !!}

        <!-- PageTitle -->
        {!! $user_theme->partials('page-header', ['title' => 'Application Form Review / Resubmit']) !!}
        <!-- PageTitle -->

        <!-- section main content -->
        <section class="main-content mt-0">
            <div class="container">
                <div class="card border-0" style="height:100% !important;box-shadow: none">
                    <div class="row">
                        <x-alert></x-alert>
                        <div class="col-md-12">
                            <p>
                                Please Check your email for pin
                            </p>
                        </div>
                        <form action="{{ route('frontend.users.resubmit_application_pin') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class='col-md-6'>
                                    <div class="form-group">
                                        <label for="email">Pin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" maxlength="1" name="pin[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" maxlength="1" name="pin[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" maxlength="1" name="pin[]" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><input type="text" maxlength="1" name="pin[]"
                                            class="form-control"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><input type="text" maxlength="1" name="pin[]"
                                            class="form-control"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><input type="text" maxlength="1" name="pin[]"
                                            class="form-control"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><input type="text" maxlength="1" name="pin[]"
                                            class="form-control"></div>
                                </div>
                                <div class="col">
                                    <div class="form-group"><input type="text" maxlength="1" name="pin[]"
                                            class="form-control"></div>
                                </div>
                                <div class="col-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Verify Pin
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer>
            <div class="container-xl">
                <div class="footer-inner">
                    <div class="row d-flex align-items-center gy-4">
                        <!-- copyright text -->
                        <div class="col-md-4">
                            <span class="copyright">© {{ date('Y') }}
                                {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}.</span>
                        </div>

                        <!-- social icons -->
                        <div class="col-md-4 text-center">
                            <ul class="social-icons list-unstyled list-inline mb-0">
                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>

                        <!-- go to top button -->
                        <div class="col-md-4">
                            <a href="#" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back
                                to Top</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- end site wrapper -->

    <!-- search popup area -->
    <div class="search-popup">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- content -->
        <div class="search-content">
            <div class="text-center">
                <h3 class="mb-4 mt-0">Press ESC to close</h3>
            </div>
            <!-- form -->
            <form class="d-flex search-form">
                <input class="form-control me-2" type="search" placeholder="Search and press enter ..."
                    aria-label="Search">
                <button class="btn btn-default btn-lg" type="submit"><i class="icon-magnifier"></i></button>
            </form>
        </div>
    </div>

    <!-- canvas menu -->
    <div class="canvas-menu d-flex align-items-end flex-column">
        <!-- close button -->
        <button type="button" class="btn-close" aria-label="Close"></button>

        <!-- logo -->
        <div class="logo">
            <img src="images/logo.svg" alt="Katen" />
        </div>

        <!-- menu -->
        <nav>
            <ul class="vertical-menu">
                <li class="active">
                    <a href="index.html">Home</a>
                    <ul class="submenu">
                        <li><a href="index.html">Magazine</a></li>
                        <li><a href="personal.html">Personal</a></li>
                        <li><a href="personal-alt.html">Personal Alt</a></li>
                        <li><a href="minimal.html">Minimal</a></li>
                        <li><a href="classic.html">Classic</a></li>
                    </ul>
                </li>
                <li><a href="category.html">Lifestyle</a></li>
                <li><a href="category.html">Inspiration</a></li>
                <li>
                    <a href="#">Pages</a>
                    <ul class="submenu">
                        <li><a href="category.html">Category</a></li>
                        <li><a href="blog-single.html">Blog Single</a></li>
                        <li><a href="blog-single-alt.html">Blog Single Alt</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>

        <!-- social icons -->
        <ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
            <li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
            <li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
@endsection
