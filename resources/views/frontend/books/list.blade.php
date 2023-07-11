@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white landing-page', 'id' => 'myDIV'], 'isLanding' => false, 'isFooter' => false])

@push('title')
    | All Books
@endpush

@push('')
@endpush

@section('main_content')
    <div class="container pt-4">
        <div class="layout main-layout pt-5 mt-lg-5 mt-3">
            <div class="side">
                <div class="d-md-block d-none">
                    <h1 class="mb-3">
                        Welcome to Upschool Library
                    </h1>
                    <div class="text-blue fs-14 mb-2">
                        Buy a book to empower a young author to have a voice and change the world!
                    </div>
                    <a href="javascript:void(0)"
                        class="learn-link d-block text-decoration-underline fs-14 mb-3 text-blue">Learn More
                        ></a>
                </div>

                <div class="side-card">
                    <div class="search-input position-relative">
                        <input type="text" placeholder="Search by title, author name or country">
                        <a href="javascript:void(0)" class="search-icon">
                            <span class="iconify" data-icon="ri:search-line"></span>
                        </a>
                    </div>
                    <div class="side-padding">

                        <div class="accordion" id="accordionExample">
                            @foreach ($categories as $category)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#{{ $category->slug }}_{{ $category->getKey() }}"
                                            aria-expanded="true"
                                            aria-controls="{{ $category->slug }}_{{ $category->getKey() }}">
                                            <span class="plus-icon me-2">+</span>
                                            <span class="minus-icon me-2">-</span> {{ $category->category_name }} (

                                            @if (isset($catProduct[$category->getKey()]))
                                                {{ count($catProduct[$category->getKey()]) }}
                                            @else
                                                0
                                            @endif

                                            )
                                        </button>
                                    </h2>
                                    <div id="{{ $category->slug }}_{{ $category->getKey() }}"
                                        class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            @if (isset($catProduct[$category->getKey()]))
                                                <a href="javascript:void(0)"
                                                    class=" fs-16 fw-700 text-blue text-decoration-underline ">View All
                                                    ></a>

                                                <ul class="content-side mt-3">
                                                    @foreach ($catProduct[$category->getKey()] as $product)
                                                        <li class="mb-2">{{ $product->product_name }} </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="side-card mt-3">
                    <div class="filter-heading">
                        Filter by Category
                    </div>
                    <div class="filter-body">
                        <ul class="unstyled centered">
                            @foreach ($allCategory as $category)
                                <li>
                                    <label class="CheckBox d-inline-block">
                                        <input type="checkbox" />
                                        <span class="checkmark"></span>
                                        <span class="fs-14 fw-500 text-900">{{ $category->category_name }}
                                            @if (isset($catProduct[$category->getKey()]))
                                                ({{ count($catProduct[$category->getKey()]) }})
                                            @endif
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="main ps-lg-5">
                @foreach ($categories as $category)
                    <div class="mb-5">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <h1>
                                {{ $category->category_name }}
                            </h1>
                            @if (isset($catProduct[$category->getKey()]))
                                <a href="javascript:void(0)" class="fs-18 fw-700 text-blue text-decoration-underline">View
                                    All ></a>
                            @endif
                        </div>
                        <div class="row ">
                            @if (isset($catProduct[$category->getKey()]))
                                @foreach ($catProduct[$category->getKey()] as $cat_product)
                                    <div class="col-md-4 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-img">
                                                @if ($cat_product->getImage()->count())
                                                    @php
                                                        // get featured or cover image.
                                                        $image = $cat_product
                                                            ->getImage()
                                                            ->where('type', 'cover_image')
                                                            ->first();
                                                        
                                                        if (!$image) {
                                                            $image = $cat_product
                                                                ->getImage()
                                                                ->where('type', 'featured_image')
                                                                ->first();
                                                        }
                                                        
                                                        if (!$image) {
                                                            $image = $cat_product
                                                                ->getImage()
                                                                ->latest()
                                                                ->first();
                                                        }
                                                        
                                                        $image = $image->image->filepath;
                                                    @endphp
                                                    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}"
                                                        alt="{{ $product->product_name }}" class="w-100">
                                                @else
                                                    <img src="{{ asset('missing-image.png') }}"
                                                        alt="{{ $product->product_name }}" class="w-100">
                                                @endif
                                            </div>
                                            <div class="card-content px-md-3 px-2">
                                                <div class="fs-16 fw-600 my-2 textAdd text-center">
                                                    {{ $cat_product->getAuthor?->getCountry?->name }}</div>
                                                <div class="fs-16 fw-600 text-900">
                                                    {{ $cat_product->getAuthor?->getFullName() }}</div>
                                                <div class="fs-22 fw-700 text-900">{{ $product->product_name }}</div>
                                                <div class="fs-14 t-elip">
                                                    <b class="text-900">Values this book explore</b>
                                                    @php
                                                        $productCategories = $allCategory
                                                            ->whereIn('id', $product->categories)
                                                            // ->get()
                                                            ->keyBy('category_name')
                                                            ->toArray();
                                                        echo implode(', ', array_keys($productCategories));
                                                    @endphp

                                                </div>
                                            </div>
                                            <div class="seller-button">
                                                <a href="{{ route('frontend.books.detail', ['slug' => $cat_product->slug]) }}"
                                                    class="more-btn mt-md-3 w-100">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
