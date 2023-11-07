@php
    /** @var array $componentValue = */
    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',$componentValue['albums'])
                                    ->where('active',true)
                                    ->get();
    $rowLoop = 0;
    $colLoop = false;
    $countImage = 1;
@endphp
<div class="row justify-content-center">
@foreach ($galleryAlbums as $albums)
    @foreach ($albums->items ?? [] as $gallery_item)

        @if($countImage === 1)
            <div class="col-lg-4 mb-4 mb-lg-0">
        @endif
            <img src="https://images.unsplash.com/photo-1547140741-00d6fd251528?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=1080&amp;h=768" class="w-100 shadow-1-strong rounded mb-4" alt="Photo by Marc Pell" srcset="https://images.unsplash.com/photo-1547140741-00d6fd251528?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=1080&amp;h=768 1080w, https://images.unsplash.com/photo-1547140741-00d6fd251528??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=150 150w, https://images.unsplash.com/photo-1547140741-00d6fd251528??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=300 300w, https://images.unsplash.com/photo-1547140741-00d6fd251528??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=768 768w, https://images.unsplash.com/photo-1547140741-00d6fd251528??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTR8fGZvcmVzdHxlbnwwfDB8fHwxNjM0OTg5MzI1&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=1024 1024w" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="768" loading="lazy">
        @if($countImage >= 2)
            </div>
        @endif
        @if($countImage >= 2)
            @php
                $countImage = 0;
            @endphp
        @endif
        @php
            $countImage++;
        @endphp
    @endforeach
@endforeach
</div>
