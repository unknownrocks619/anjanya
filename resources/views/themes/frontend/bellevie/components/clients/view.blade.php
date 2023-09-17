<!-- Icon Block -->
@php
    $clients = \App\Plugins\Clients\Http\Models\Client::get();
@endphp
<!-- Clients -->
<section class="clients client-component">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="owl-carousel owl-theme">
                    @foreach ($clients as $client)
                    <div class="clients-logo">
                        <a href="#0"><img src="{{\App\Classes\Helpers\Image::getImageAsSize($client->image,'s')}}" alt="{{$client->client_name}}"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@push('page_script')
    <script>
        // Clients owlCarousel *
        $('.client-component .owl-carousel').owlCarousel({
            loop: true,
            margin: 30,
            mouseDrag: true,
            autoplay: true,
            dots: false,
            nav: false,
            navText: ["<span class='lnr ti-angle-left'></span>", "<span class='lnr ti-angle-right'></span>"],
            responsiveClass: true,
            responsive: {
                0: {
                    margin: 10,
                    items: 3
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
@endpush
