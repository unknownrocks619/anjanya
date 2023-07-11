<div class="container-fluid mx-0 px-0">
    <div class="row mx-0">
        <div class="col-md-7 px-0">
            <iframe class="h-100 w-100" frameborder="0" allowfullscreen="1"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                title="This Might Just Change Everything"
                src="https://www.youtube.com/embed/qWOHWzGHtsA?controls=1&amp;rel=0&amp;playsinline=0&amp;modestbranding=0&amp;autoplay=0&amp;enablejsapi=1&amp;origin=https%3A%2F%2Fupschool.co&amp;widgetid=1"
                id="widget2" data-gtm-yt-inspected-11="true"></iframe>
        </div>
        <div class="col-md-5 px-0 bg-theme-background">
            <div class="h-100 p-md-5 p-3">
                @foreach ($values->items as $item)
                    <div class="d-flex gap-4 mb-lg-5 mb-4">
                        <div class="fs-30 text-white"><i class="fas fa-check-double"></i></div>
                        <p class="fs-26 text-white">{!! htmlspecialchars_decode($item->items) !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
