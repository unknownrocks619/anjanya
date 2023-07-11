@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white landing-page'], 'isLanding' => $isLanding, 'isFooter' => $isFooter])
@push('title')
    |
    {{ $bundle->bundle_title }}
@endpush

@section('main_content')
    <div class="container pt-5 mt-2">
        @if (isset($bundle) && isset($bundle->getImage) && count($bundle->getImage))
            @php
                $bannerImageRelation = $bundle
                    ->getImage()
                    ->where('type', 'banner')
                    ->first();
                $bannerImage = null;
                if ($bannerImageRelation) {
                    $bannerImage = $bannerImageRelation->image;
                }
            @endphp
            @if ($bannerImage)
                <div class="row mt-3">
                    <div class="col-md-12"
                        style="min-height: {{ $bannerImage->sizes->height }}px;background:url({{ \App\Classes\Helpers\Image::getImageAsSize($bannerImage, 'cus') }});background-size:contain;background-repeat:no-repeat;background-position:center">

                    </div>
                </div>
            @endif
        @endif
        <div class="row">
            <div class="col-md-12 d-flex">
                <div>
                    <a href="javascript:void(0)" style="height:auto;width:fit-content;"
                        class="buy-btn ajax-modal py-1 btn-rounded rounded" data-body='{{ json_encode(['amount' => 399]) }}'
                        data-method="post"
                        data-action="{{ route('frontend.books.default_selection', ['product' => $bundle, 'type' => 'bundle']) }}"
                        data-bs-target="#dynamic_js_modal">
                        <span class="no-wrap" style="font-weight:normal">Buy Paperback</span>
                        <span>{{ \App\Classes\Helpers\Money::AU(399) }}</span>
                        <span class="no-wrap" style="font-weight:normal">Donation:
                            {{ \App\Classes\Helpers\Money::AU(50) }}</span>
                    </a>
                </div>
                <div class="mx-3">
                    <a href="javascript:void(0)" style="height:auto;width:fit-content;"
                        class="buy-btn ajax-modal py-1  btn-rounded rounded"
                        data-body='{{ json_encode(['amount' => 549]) }}' data-method="post"
                        data-action="{{-- route('frontend.books.default_selection', ['product' => $bundle]) --}}" data-bs-target="#dynamic_js_modal">
                        <span class="no-wrap" style="font-weight:normal">Buy Hardback</span>
                        <span>{{ \App\Classes\Helpers\Money::AU(549) }}</span>
                        <span class="no-wrap" style="font-weight:normal">Donation:
                            {{ \App\Classes\Helpers\Money::AU(50) }}</span>
                    </a>
                </div>
                <div>
                    <a href="javascript:void(0)" style="height:auto;width:fit-content;"
                        class="buy-btn ajax-modal py-1  btn-rounded rounded"
                        data-body='{{ json_encode(['amount' => 399]) }}' data-method="post"
                        data-action="{{-- route('frontend.books.default_selection', ['product' => $bundle]) --}}" data-bs-target="#dynamic_js_modal">
                        <span class="no-wrap" style="font-weight:normal">Buy Ebook</span>
                        <span>{{ \App\Classes\Helpers\Money::AU(399) }}</span>
                        <span class="no-wrap" style="font-weight:normal">Donation:
                            {{ \App\Classes\Helpers\Money::AU(25) }}</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- / Buttons -->

        <div class="row">
            <div class="col-md-12">
                <h4>
                    {{ $bundle->bundle_title }}
                </h4>
                <div>
                    {!! $bundle->full_description !!}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class='table table-responsive table-border'>
                            <thead>
                                <tr>
                                    <th>Book Name</th>
                                    <th>Value Explored</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bundle->getBundleProducts() as $product)
                                    <tr>
                                        <td>
                                            {{ $product->product_name }}
                                        </td>
                                        <td>
                                            @php
                                                $categories = $product->getCategories();
                                                foreach ($categories as $category) {
                                                    echo $category->category_name, ' , ';
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal id='dynamic_js_modal'>
    </x-modal>
@endsection
