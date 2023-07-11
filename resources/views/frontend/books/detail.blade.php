@extends('themes.frontend.users.auth', [
    'bodyAttribute' => [
        'class' => 'bg-light landing-page',
        'id' => 'myDIV',
    ],
    'isLanding' => false,
    'isFooter' => false,
])

@push('title')
    | All Books
@endpush

@push('')
@endpush

@section('main_content')
    <div class="container py-4 mt-5 pt-lg-5">
        <div class="d-flex justify-content-between flex-md-row flex-column align-items-md-center my-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-3">
                    @if ($product->getAuthor && $product->getAuthor?->getImage)
                        @php
                            $image = $product->getAuthor
                                ?->getImage()
                                ->latest()
                                ->first();
                            
                        @endphp
                        <div class="profile-img ">
                            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 's') }}"
                                alt="{{ $product->getAuthor->getFullName() }}" />
                        </div>
                    @endif
                    <div class="fs-22 fw-400 text-blue">{{ $product->getAuthor?->getFullName() }}</div>
                </div>
                <h1 class="d-md-block d-none">{{ $product->product_name }}</h1>
            </div>
            <div>
                <div class="fs-17 fw-400 text-blue text-md-end mb-3">
                    Author’s Location:
                </div>
                <div class="location-badge gap-2">
                    <img src="https://flagcdn.com/28x21/{{ strtolower($product->getAuthor?->getCountry?->code) }}.png"
                        alt="">
                    {{ $product->getAuthor?->getCountry?->name }}
                </div>
                <h1 class="d-md-none d-block mt-3">{{ $product->product_name }}</h1>

            </div>
        </div>
        @if ($product->getImage()->where('type', 'gallery')->count())
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($product->getImage()->where('type', 'gallery')->with('image')->get() as $image)
                        <div class="carousel-item @if ($loop->iteration == 1) active @endif">
                            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm') }}"
                                class="d-block w-100" alt="{{ $product->product_name }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-center flex-wrap gap-3 mt-4">
            @php
                $categories = \App\Models\Category::whereIn('id', $product->categories)->get();
            @endphp
            @foreach ($categories as $category)
                <div class="list-badge">{{ $category->category_name }}</div>
            @endforeach
        </div>

        <div class="layout flex-md-row flex-column mt-5 detail-layout">
            <div class="main">
                <div class="fs-23 fw-400 text-blue">
                    {!! $category->full_description !!}
                </div>
                <div class="d-flex align-items-center flex-wrap gap-3 mt-4">
                    @php
                        $pricings = [$category->item_price];
                        if ($product->getRecommendedProject) {
                            $pricings = [$product->getRecommendedProject->min_donation_amount];
                            if ($product->getRecommendedProject->max_donation_amount > $pricings[count($pricings) - 1]) {
                                $pricings[] = $product->getRecommendedProject->min_donation_amount * 2;
                            }
                            if ($product->getRecommendedProject->max_donation_amount > $pricings[count($pricings) - 1]) {
                                $pricings[] = $pricings[count($pricings) - 1] * 2;
                            }
                        
                            // get pricing breaks.
                            if ($product->getRecommendedProject->getDonationBreaks) {
                                $pricings = [];
                                foreach ($product->getRecommendedProject->getDonationBreaks as $breaks) {
                                    $pricings[] = $breaks->amount;
                                }
                            }
                        }
                        
                    @endphp

                    @foreach ($pricings as $pricing)
                        @if ($pricing)
                            <a href="javascript:void(0)" class="buy-btn ajax-modal"
                                data-body='{{ json_encode(['amount' => $pricing]) }}' data-method="post"
                                data-action="{{ route('frontend.books.default_selection', ['product' => $product]) }}"
                                data-bs-target="#dynamic_js_modal">
                                <span class="no-wrap">Buy e-pay</span>
                                <span>{{ \App\Classes\Helpers\Money::AU($pricing) }}</span>
                            </a>
                        @endif
                        <a href="javascript:void(0)" class="buy-btn ajax-modal"
                            data-body='{"amount": "10.2"
                                }' data-method="post"
                            data-action="{{ route('frontend.books.default_selection', ['product' => $product]) }}"
                            data-bs-target="#dynamic_js_modal">
                            <span class="no-wrap">Buy PaperBack</span>
                            <span>{{ \App\Classes\Helpers\Money::AU(10.2) }}</span>
                        </a>
                    @endforeach
                    <a href="/report-a-problem" class="border-btn">
                        Report Issue
                    </a>
                </div>
                <a href="javascript:void(0)" data-bs-target="#what_to_expect" data-bs-toggle="modal"
                    class="fs-16 fw-400 text-grey text-decoration-underline mt-4 d-block">
                    <img src="assets/images/info.svg" alt="">
                    What to expect
                </a>
                @if (count($recommendedProject))
                    <h1 class="mb-3 mt-5">
                        Related Books
                    </h1>
                    <div class="d-md-block d-none">
                        <div class="row justify-content-center ">
                            @foreach ($recommendedProject as $recommended_product)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-img">
                                            @php
                                                // get featured or cover image.
                                                $image = \App\Models\FileRelation::where('relation', 'App\Models\Product')
                                                    ->where('relation_id', $recommended_product->product_id)
                                                    ->where('type', 'cover_image')
                                                    ->with('image')
                                                    ->first();
                                                
                                                if (!$image) {
                                                    $image = \App\Models\FileRelation::where('relation', 'App\Models\Product')
                                                        ->where('relation_id', $recommended_product->product_id)
                                                        ->where('type', 'featured_image')
                                                        ->with('image')
                                                        ->first();
                                                }
                                                
                                                if (!$image) {
                                                    $image = \App\Models\FileRelation::where('relation', 'App\Models\Product')
                                                        ->where('relation_id', $recommended_product->product_id)
                                                        ->where('type', 'featured_image')
                                                        ->with('image')
                                                        ->latest()
                                                        ->first();
                                                }
                                                
                                                $image = $image?->image?->filepath;
                                                
                                            @endphp

                                            @if ($image)
                                                <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}"
                                                    alt="{{ $recommended_product->product_name }}">
                                            @else
                                                <img src="{{ asset('missing-image.png') }}"
                                                    alt="{{ $recommended_product->product_name }}">
                                            @endif
                                        </div>
                                        <div class="card-content px-md-3 px-2">
                                            <div class="fs-16 fw-600 my-2 textAdd text-center">
                                                {{ $recommended_product->name }}</div>
                                            <div class="fs-16 fw-600 text-900">{{ $recommended_product->first_name }}
                                                {{ $recommended_product->last_name }}</div>
                                            <div class="fs-22 fw-700 text-900">{{ $recommended_product->product_name }}
                                            </div>
                                            <div class="fs-14">
                                                <b class="text-900">Values this book explore</b>
                                                @php
                                                    $recom_categories = \App\Models\Category::whereIn('id', json_decode($recommended_product->categories))
                                                        ->get()
                                                        ->keyBy('category_name')
                                                        ->toArray();
                                                    echo implode(', ', array_keys($recom_categories));
                                                @endphp
                                            </div>
                                        </div>
                                        <div class="seller-button">
                                            <a href="{{ route('frontend.books.detail', ['slug' => $recommended_product->slug]) }}"
                                                class="more-btn mt-md-3 w-100">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            <div class="side">
                <div class="side-card">
                    <div class="filter-heading">
                        Author's Recommended Project
                    </div>
                    <div class="padding-box">
                        <div class="fs-15 fw-400 text-darkpurple">
                            {{ $product->getRecommendedProject?->intro_text }}
                        </div>
                    </div>
                    <div class="people-img">
                        @include('frontend.books.tabs.profile-book-image', ['product' => $product])
                    </div>
                    <div class="padding-box">
                        <div class="fs-22 fw-700 text-blue text-decoration-underline">
                            Invest in {{ $product->getRecommendedProject?->title }}
                        </div>
                        <div class="fs-15 fw-400 text-darkpurple">
                            Opportunity International Australia
                        </div>
                        <a href="javascript:void(0)" data-bs-target="#how_to_help" data-bs-toggle="modal"
                            class="fs-15 fw-400 text-darkpurple text-decoration-underline">Learn
                            how you can help.</a>
                    </div>
                </div>
                <div class="side-card mt-3">
                    <div class="padding-box">
                        <div class="fs-18 fw-400 text-purple">
                            Total amount this has generated for Charity:
                        </div>
                        <div class="fs-36 fw-700 text-red">
                            AU $0.00
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="javascript:void(0)" class="view-btn">View all books from this author</a>
                </div>
            </div>
        </div>
    </div>
    <x-modal id='how_to_help'>
        @include('frontend.books.modal.how-to-help')
    </x-modal>
    <x-modal id='what_to_expect'>
        @include('frontend.books.modal.what-to-expect')
    </x-modal>
    <x-modal id='authors_book'>
        @include('frontend.books.modal.authors-book')
    </x-modal>
    <x-modal id='dynamic_js_modal'>
    </x-modal>
@endsection
