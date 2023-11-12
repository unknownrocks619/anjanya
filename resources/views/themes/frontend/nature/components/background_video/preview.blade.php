@extends('themes/frontend/nature/layout/preview-layout')
@section('main')
    <section class="home-banner" style="background-image: url({{$com}});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="banner-content text-center">
                        <div class="section-head">
                            <div class="back-title">DONATION</div>
                            <h2 class="section-title banner-title">Make An Impact &amp; Give Back To <span class="primary-color">Nature
                                 <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                    <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                 </svg>
                              </span></h2>
                        </div>
                        <div class="banner-text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, ipsum dolor sit pulvinar dapibus leo ipsum dolor sit.</p>
                        </div>
                        <div class="banner-button">
                            <a href="about.html" class="button-round-primary">Learn More</a>
                            <a href="donate.html" class="button-round-white">Donate Fund</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
    </section>
@endsection
