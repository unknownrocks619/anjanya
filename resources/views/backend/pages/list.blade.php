@extends('themes.admin.master')

@push('page_title')
    - Pages
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row my-2">
                <div class="col justify-content-between d-flex">
                    <h1 class="text-dark">Pages</h3>
                        <button class="btn btn-primary" data-bs-target='#new-user' data-bs-toggle='modal'>
                            <i class="icon-plus me-1"></i>
                            Create New Page
                        </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">


        <div class="row mt-2 mb-2">
            <div class="col-md-12">
                <form action="" method="get">
                    <input type="text" name="search" id="" class="form-control" placeholder="Search Page" />
                </form>
            </div>
            @if (request()->get('search') && !empty(request()->get('search')))
                <div class="col-md-12 mt-1 text-end">
                    <a href="{{ route('admin.posts.list') }}" class="">Clear Search Result</a>
                </div>
            @endif

        </div>

        @foreach ($pages as $page)
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card mb-1 rounded-0">
                        <div class="card-header py-1 ps-3 border-radius-none d-flex justify-content-between">
                            <div>
                                <h4 class="card-title py-2 px-0 mb-0">
                                    {{ $page->title }}
                                    <span>{!! \App\Classes\Helpers\Status::active_label($page->active, 'badge') !!}</span>
                                </h4>
                                <div class="row">
                                    <div class="col">
                                        Created Date: {{ $page->created_at->format('Y-m-d') }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a title="" data-bs-toggle="tooltip" data-bs-original-title='Designer Mode'
                                    title='Designer Mode' data-bs-title="Designer Mode."
                                    class="btn btn-icon btn-primary px-2"
                                    href="{{ route('admin.pages.edit', ['page' => $page]) }}">
                                    <i class="fa fa-paint-brush fs-4"></i>
                                </a>

                                <a class="px-2 btn btn-icon btn-primary" title='Edit Page' data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Edit Content"
                                    href="{{ route('admin.pages.edit', ['page' => $page]) }}">
                                    <i class="fa fa-pencil fs-4"></i>
                                </a>
                                <a href="" data-bs-toggle="tooltip" data-bs-placement="top" title='Delete Page'
                                    data-bs-title="Delete Page" class="px-2 btn btn-icon btn-danger data-confirm"
                                    data-confirm="Ooops ! You are about to delete Do you wish to continue ? "
                                    data-method="post" data-action="{{ route('admin.pages.delete', ['page' => $page]) }}">
                                    <i class="fa fa-trash fs-4"></i>
                                </a>

                            </div>
                        </div>
                        <div class="card-body ps-3 mt-0 py-0 quick-edit">

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($pages->hasPages())
            <div class="row mt-2">
                <div class="col-md-12 text-right justify-content-end">
                    {{ $pages->links() }}
                </div>
            </div>
        @endif
    </div>
    <x-modal id='new-user'>
        @include('backend.pages.modals.new')
    </x-modal>
@endsection
