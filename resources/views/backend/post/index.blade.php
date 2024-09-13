@extends('themes.admin.master')

@push('page_title')
    - Posts
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col justify-content-between">
                    <h3 class="text-darl">Posts</h3>
                    <button class="btn btn-primary" data-bs-target='#new-post' data-bs-toggle='modal'>
                        <i class="icon-plus mr-1"></i>
                        New Post
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mt-2 mb-2">
            <div class="col-md-12">
                <form action="" method="get">
                    <input type="text" name="search" id="" class="form-control" placeholder="Search Post" />
                </form>
            </div>
            @if (request()->get('search') && !empty(request()->get('search')))
                <div class="col-md-12 mt-1 text-end">
                    <a href="{{ route('admin.posts.list') }}" class="">Clear Search Result</a>
                </div>
            @endif
        </div>

        @forelse ($posts as $post)
            <div class="row mt-1">
                <div class="col-md-12">
                    <div class="card mb-1 rounded-0">
                        <div class="card-header py-1 ps-3 border-radius-none d-flex justify-content-between">
                            <div>
                                <h4 class="card-title py-2 px-0 mb-0">
                                    {{ $post->title }}
                                    <span>{!! \App\Classes\Helpers\Status::status_label($post->status, 'badge') !!}</span>
                                </h4>
                                <div class="row">
                                    <div class="col">
                                        Created Date: {{ $post->created_at->format('Y-m-d') }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.posts.edit', ['post' => $post]) }}">
                                    <i class="icon-pencil-alt fs-4"></i>
                                </a>
                                <a href="" class="data-confirm"
                                    data-confirm="Ooops ! You are about to delete Do you wish to continue ? "
                                    data-method="post" data-action="{{ route('admin.posts.delete', ['post' => $post]) }}">
                                    <i class="icon-trash fs-4 text-danger"></i>
                                </a>

                            </div>
                        </div>
                        <div class="card-body ps-3 mt-0 py-0 quick-edit">

                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="border border-1 d-flex col justify-content-center align-items-center" style="min-height: 30vh">
                    <div>
                        <h3>
                            No Post Available
                        </h3>
                        <p>Start your wild blog imagination now. </p>
                        <a href="" data-bs-target='#new-post' data-bs-toggle='modal'>
                            <i class="icon-plus"></i> Create Post
                        </a>

                    </div>
                </div>
            </div>
        @endforelse

        @if ($posts->hasPages())
            <div class="row mt-2">
                <div class="col-md-12 text-right justify-content-end">
                    {{ $posts->links() }}
                </div>
            </div>
        @endif
    </div>
    <x-modal id='new-post'>
        @include('backend.post.modals.new')
    </x-modal>
@endsection
