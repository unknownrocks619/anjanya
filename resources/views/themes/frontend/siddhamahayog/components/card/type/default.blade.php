@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container px-2 py-2 text-dark">
    <div class="component-container">
        @php
            $data = $componentValue['data'];
        @endphp
        <div class="swiper componentSwiper{{$_loadComponentBuilder->getKey()}}">
            <!-- Additional required wrapper -->
            <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($data as $rowKey => $row)
                        <div class="row">
                            @foreach ($row as $column_key => $column_value)
                                <div class="col-md-{{$componentValue['column']}}">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <div class="lc-block">
                                                <img class="img-fluid" src="{{$column_value['image']}}"
                                                     alt="{{$column_value['title']}}" loading="lazy">
                                            </div>
                                            <div class="card-body">
                                                <div class="lc-block mb-3">
                                                    <div editable="rich">

                                                        <h2 class="h5">{{$column_value['title']}}</h2>

                                                        <div>
                                                            {!!   $column_value['description'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($column_value['button'])
                                                    <div class="lc-block">
                                                        <a class="btn btn-primary" href="{{$column_value['button']}}"
                                                           role="button">Read More</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination position-relative pt-5 bottom-0"></div>
        </div>
    </div>
</div>
@push('page_script')
    <script>
        new Swiper(".componentSwiper{{$_loadComponentBuilder->getKey()}}", {
            slidesPerView: 1,
            grabCursor: true,
            spaceBetween: 30,

            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endpush
