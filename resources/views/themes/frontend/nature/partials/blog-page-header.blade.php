<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url({{$backgroundImage}});">
        <div class="container">
            <div class="inner-banner-content">
                <h1 class="inner-title">{{$title}}</h1>
                @if(isset($date))
                <div class="entry-meta">
                           <span class="byline">
                              <a href="#">{{\App\Classes\Helpers\SystemSetting::basic_configuration('site_name')}}</a>
                           </span>
                    <span class="posted-on">
                              <a href="#">{{$date}}</a>
                           </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
