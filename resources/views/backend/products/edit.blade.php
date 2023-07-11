@extends('themes.admin.master')

@push('page_title')
    - {{ $product->product_name ? $product->product_name : 'Product Edit' }}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ $product->product_name ? 'Edit -' . $product->product_name : 'Product Information' }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-end">
                        <div class="row">
                            <div class="col-md-12">
                                @if (isset($book) && $book)
                                    <a href="{{ route('admin.book.list') }}" class="btn btn-warning">
                                        Back
                                    </a>
                                @else
                                    <a href="{{ route('admin.ecom.list') }}" class="btn btn-warning">
                                        Back
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                @php
                                    $tabKeyname = isset($value['name']) ? strtolower($value['name']) : $key;
                                @endphp

                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $tabKeyname == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-{{ $tabKeyname }}-tab" data-bs-toggle="pill"
                                        href="#pills-danger-{{ $tabKeyname }}" role="tab"
                                        aria-controls="pills-danger-home" aria-selected="true">
                                        @if (!isset($value['name']))
                                            {{ __('admin/products/edit.' . $tabKeyname) }}
                                        @else
                                            {{ $value['name'] }}
                                        @endif

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                @php
                                    $tabKeyname = isset($content['name']) ? strtolower($content['name']) : $key;
                                @endphp

                                <div class="mt-4 tab-pane fade {{ $tabKeyname == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $tabKeyname }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $tabKeyname }}-tab">

                                    @if (!isset($content['name']))
                                        @include('backend.products.tabs.' . $key, [
                                            'content' => $content,
                                            'product' => $product,
                                            'book' => $book,
                                        ])
                                    @else
                                        @include($content['view'], [
                                            'model' => $product,
                                            'seo' => $product->getSeo?->seo,
                                            'content' => $product->getImage,
                                        ])
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
