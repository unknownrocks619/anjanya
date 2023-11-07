@php
    /** @var array $componentValue = */
    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',$componentValue['albums'])
                                    ->where('active',true)
                                    ->get();
    $rowLoop = 0;
    $colLoop = false;
@endphp
@foreach ($galleryAlbums as $albums)
    @foreach ($albums->items ?? [] as $gallery_item)
        @php
            if (($rowLoop % 2 == 0) || $loop->first) {
                echo '<div class="row g-0">';
            }
        @endphp

        <div class="@if($colLoop == false) {{$loop->odd ? 'col-8' : 'col-4'}} @else {{$loop->odd ? 'col-4' : 'col-8'}} @endif lc-block border-3 border border-light">
            <img
                class="h-100  w-100" style="object-fit:cover" src="https://images.unsplash.com/photo-1496196614460-48988a57fccf?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8NDJ8fG9jZWFufGVufDB8MHx8fDE2MzQ5OTYyODY&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=1080&amp;h=768" alt="{{ $gallery_item->alt_text }}" loading="lazy">
        </div>

        @php
            if( ($rowLoop % 2 == 1) || $loop->last) {
                echo "</div>";
                $colLoop = !$colLoop;
            }
            $rowLoop++
        @endphp
  @endforeach
@endforeach
