@php
    // if Banner image is not available from page, try from menu.
    $post = new App\Models\Post;
    $post->title = $product->name;
    $galleries = $product->getImage;
    // dd($gallery);
@endphp
@extends($user_theme->frontend_layout($extends))

@section('page_title') - {{$product->name}} @endsection

@section('main')
{!! $user_theme->partials('post.cover',['post' => $post,'category' => $category]) !!}
<style>
    /* .splide__slide img {
        width: 100%;
        height: auto;
    } */
    .instagram{
        background: #f09433; 
        background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); 
        background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
        background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); 
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 );
        }
</style>
<section>
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-4 border">
              <div class="splide no-component rounded-4" id="caraImage" aria-labelledby="carousel-heading">
                <div class="splide__track">
                    <div class="splide__list">
                        @foreach ($galleries as $gallery)
                            <div class="splide__slide">
                                <a data-type="image"  href="{{\App\Classes\Helpers\Image::getImageAsSize($gallery->image->filepath,'xl')}}" data-lightbox="Image - {{$loop->iteration}}">
                                    <img class="zoom-me" data-origin="{{\App\Classes\Helpers\Image::getImageAsSize($gallery->image->filepath,'xl')}}" class="rounded-4 fit" src="{{\App\Classes\Helpers\Image::getImageAsSize($gallery->image->filepath,'l')}}" />
                                </a>
                            </div>
                        @endforeach
    
                    </div>
                </div>
              </div>
              <div class="splide no-component mb-3 d-flex justify-content-center" aria-labelledby="carousel-heading" id="thumbArea">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($galleries as $gallery)
                            <li class="splide__slide border">
                                <img class="rounded-2 fit"  src="{{\App\Classes\Helpers\Image::getImageAsSize($gallery->image->filepath,'s')}}" />
                            </li>   
                        @endforeach
                    </ul>
                </div>
              </div>
              <!-- thumbs-wrap.// -->
              <!-- gallery-wrap .end// -->
            </aside>

            <main class="col-lg-8">
              <div class="ps-lg-3">
                <h4 class="title text-dark" id="carousel-heading">
                  {{$product->name}}
                </h4>
                <div class="d-flex flex-row my-3">
                  @if($product->stock > 1)
                  {{-- <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span> --}}
                  <span class="text-success ms-2">In stock</span>
                  @else
                  <span class="text-danger ms-2">Out of Stock</span>
                  @endif
                </div>
        
                <div class="mb-3">
                  <span class="h5">NRs. 
                    @if($product->price_range)
                        {{$product->price_range}}
                    @else
                        {{$product->base_price}}
                    @endif
                  </span>
                </div>
        
                <div class="mb-2 border-bottom">
                    <h6>
                        Category : {{$category->category_name}}
                    </h6>
                </div>
        
                {!! $product->short_description !!}
                <hr />
                <a href="#" data-bs-toggle="modal" data-bs-target='#enquiryForm' class="p-3 px-5 btn btn-warning shadow-0 fs-3 text-white"> Enquiry </a>

                @if($product->youtube_link || $product->facebook_link || $product->instagram_link || $product->twitter_link)
                    <div class="bg-light mt-4 py-4 px-3">
                        <h6>
                            View Products On
                        </h6>
                        @if($product->youtube_link)
                            <a href="{{$product->youtube_link}}" target="_blank" class="btn fs-3  btn-danger">
                                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd"/>
                                  </svg>
                                  
                                Youtube
                            </a>
                        @endif
                        @if($product->facebook_link)
                            <a href="{{$product->facebook_link}}" target="_blank" class="btn fs-3  btn-primary">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z" clip-rule="evenodd"/>
                                  </svg>
                                  
                                Facebook
                            </a>
                        @endif

                        @if($product->instagram_link)
                            <a href="{{$product->instagram_link}}" target="_blank" class="btn fs-3 btn-warning text-white instagram">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" clip-rule="evenodd"/>
                                  </svg>
                                  
                                  
                                Instagram
                            </a>
                        @endif
                        @if($product->twitter_link)
                            <a href="{{$product->twitter_link}}" target="_blank" class="btn fs-3 btn-dark text-white btn-icon">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z"/>
                                  </svg>
                                   
                            </a>
                        @endif
                    </div>
                @endif
              </div>
            </main>
          </div>
        </div>
        
    </div>
</section>
<!-- content -->

<section class="bg-light border-top py-4">
<div class="container">
  <div class="row gx-4">
    <div class="col-lg-8 mb-4">
      <div class="border rounded-2 px-3 py-2 bg-white">
        <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
          <li class="nav-item d-flex" role="presentation">
            <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1" data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1" aria-selected="true">Full Description</a>
          </li>
          @if($product->additionalContent->count())
            <li class="nav-item d-flex" role="presentation">
                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2" data-bs-toggle="pill" href="#additonalContent" role="tab" aria-controls="ex1-pills-2" aria-selected="false">Product / Additional Information</a>
            </li>
          @endif
          @if($product->associatedFiles->count() )
            <li class="nav-item d-flex" role="presentation">
                <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3" data-bs-toggle="pill" href="#productFiles" role="tab" aria-controls="ex1-pills-3" aria-selected="false">Product Files </a>
            </li>
          @endif
        </ul>
        <!-- Pills navs -->

        <!-- Pills content -->
        <div class="tab-content" id="ex1-content">
            <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                {!! $product->full_description !!}
            </div>

            @if($product->additionalContent->count())
                <div class="tab-pane fade mb-2" id="additonalContent" role="tabpanel" aria-labelledby="ex1-tab-2">
                    @foreach ($product->additionalContent as $additionalContent)
                        <div class="row mt-3 ">
                            <div class="col-md-12">
                                <h5>{{$additionalContent->title}}</h5>
                            </div>
                            <div class="col-md-12 bg-light py-3 ">
                                {!! $additionalContent->full_description !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if($product->associatedFiles->count() )
                <div class="tab-pane fade mb-2" id="productFiles" role="tabpanel" aria-labelledby="ex1-tab-3">
                </div>
            @endif

        </div>
        <!-- Pills content -->
      </div>
    </div>
    <div class="col-lg-4">
        <div class="px-0 border rounded-2 shadow-0">
            @include("Product::frontend.products.partials.similar-products",['product' => $product])
        </div>
    </div>
  </div>
</div>
</section>
<div class="modal fade modal-bookmark" id="enquiryForm" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" id='enquiryForm-modal-document' role="document">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-bookmark needs-validation ajax-form ajax-append" method="post" action="{{ route('product.enquiry',['product'=>$product->getKey(),'slug' => $product->slug]) }}" id="bookmark-form" novalidate="">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Enqiry Form
                    </h3>
                    <button class="btn-close" data-original-title="test" type="button" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
    
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="course_name">Product Name</label>
                                <input class="form-control border bg-light" id="product_name" name="product_name" type="text"
                                    placeholder="Product Name" readonly value="{{$product->name}}">
                            </div>
                        </div>
                    </div>
    
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="full_name" class="fs-3">Full Name</label>
                                <input class="form-control border" id="full_name" name="full_name" type="text"
                                placeholder="" value="">
                            </div>
                        </div>
                    </div>
    
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control border" id="email" name="email" type="email"
                                value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input class="form-control border" id="phone_number" name="phone_number" type="text"
                                value="">    
                            </div>
                        </div>
                    </div>
    
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="message" id="message" class="form-control border"></textarea>    
                            </div>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-secondary mx-2 fs-3 px-4" data-bs-dismiss="modal" type="submit">Submit</button>
                            {{-- <button class="btn btn-primary mx-2 fs-3" type="button" data-bs-dismiss="modal">Cancel</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    
    </div>
</div>
@endsection

@push('page_script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js" integrity="sha256-FZsW7H2V5X9TGinSjjwYJ419Xka27I8XPDmWryGlWtw=" crossorigin="anonymous"></script>
<script src="{{asset('frontend/kpa/assets/js/vendor/jquery.imgzoom.js')}}"></script>
<script>
    var mainCara = new Splide('#caraImage',{
        type      : 'fade',
        rewind    : true,
        pagination: false,
        arrows    : false,
    })
    var thumbArea = new Splide('#thumbArea',{
        fixedWidth : 60,
        fixedHeight: 60,
        gap: 5,
        rewind : true,
        pagination : false,
        arrows : false,
        isNavigation: true,

    })

    mainCara.sync(thumbArea);
    mainCara.mount();
    thumbArea.mount();
</script>
@endpush