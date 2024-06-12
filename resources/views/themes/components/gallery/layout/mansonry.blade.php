@php
    /** @var array $componentValue = */
    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',explode(',',$componentValue['albums'][0]))
                                    ->where('active',true)
                                    ->get();
    // dd($componentValue['albums']);
    $rowLoop = 0;
    $colLoop = false;
    $countImage = 1;
@endphp
<div class="row justify-content-center">
    <div class="col-md-12 text-end my-2">
        <a class="btn btn-primary py-2 fs-3 toggle-view"
                data-show='.all'>
            All
        </a>

        @foreach ($galleryAlbums as $album)
        <a class="btn btn-primary py-2 fs-3 toggle-view" 
            data-show="#{{$album->slug}}" 
            href="#{{$album->slug}}" role="button">
            {{$album->album_name}}
          </a>
        @endforeach
    </div>
    @foreach ($galleryAlbums as $albums)
        <div class="collapse show all" id="{{$albums->slug}}">
            <div class="card card-body">
                <div class="row my-2">
                    <h4>{{$albums->album_name}}</h4>
                </div>
                <div class="row">
                    @foreach ($albums->items ?? [] as $item)            
                        <div class="col-lg-4 mb-4 mb-lg-0 ">
                            <a href="{{\App\Classes\Helpers\Image::getImageAsSize($item->getImage()->first()->image->filepath,'xl')}}"
                                data-lightbox="{{$item->heading_one ?? 'Image - '.$loop->iteration }}" data-title="{{$item->heading_one ?? 'Image - '.$loop->iteration }}">
                            <img src="{{\App\Classes\Helpers\Image::getImageAsSize($item->getImage()->first()->image->filepath,'m')}}" class="m-1" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="768" loading="lazy">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    @endforeach
</div>
