@php
    /** @var array $componentValue = */
    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                ->whereIn('id',$componentValue['albums'])
                                ->where('active',true)
                                ->get();
@endphp

<div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
    @foreach ($galleryAlbums as $albums)
        @foreach ($albums->items ?? [] as $gallery_item)
            <div class="col">
                <div class="lc-block card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" lc-helper="background" style="background-image: url('{{App\Classes\Helpers\Image::getImageAsSize($gallery_item->getImage()->first()?->image->filepath,'xl')}}'); background-size:cover;background-position: center">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <div class="lc-block pt-5 mt-5 mb-4">
                            <div editable="rich">
                                @if($gallery_item->heading_one)
                                    <h2 class="display-6 lh-1 fw-bold" style="color: #FFDA0F !important;">{{$gallery_item->heading_one}}</h2>
                                @endif
                                @if($gallery_item->description)
                                    <div>Quickly design and customize responsive mobile-first sites with Bootstrap.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      @endforeach
    @endforeach
</div>
