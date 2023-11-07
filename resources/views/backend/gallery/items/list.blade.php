@extends('themes.admin.master')

@push('page_title')
    - Gallery Album - {{ $album->album_name }}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{$album->album_name}} - Images</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-xl-3 box-col-30 pe-0">
                @include('backend.gallery.items.tabs.new')
            </div>
            <!-- Zero Configuration  Ends-->
            <div class="col-xl-9 col-md-12 box-col-70">
                <div class="file-content">
                    <div class="card">
                        <div class="card-body file-manager component-parent"  data-action="{{route('admin.gallery-items.reorder',['album'=>$album->getKey()])}}">
                            <div class="row">
                                <div class="col-md-12 mt-3 text-end">
                                    <a href="{{route('admin.gallery-album.index')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Go Back</a>
                                </div>
                            </div>

                            <div id="slider-file-preview"></div>
                            <h5 class="mt-4">Images</h5>
                            @include('backend.gallery.items.tabs.preview', [
                                'items' => $items,
                                'album' => $album
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal id='newAlbum'>
        @include('backend.sliders.album.modal.new-album')
    </x-modal>
@endsection
