@extends('themes.admin.master')

@push('page_title')
    - Posts
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Posts</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <button class="btn btn-primary" data-bs-target='#new-post' data-bs-toggle='modal'>
                            New Post
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Post Title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <th></th>
                                            <th>
                                                {{ $post->title }}
                                            </th>
                                            <th>
                                                {{ $post->created_at }}
                                            </th>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::status_label($post->status) !!}
                                            </td>
                                            <th>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.posts.edit', ['post' => $post]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="data-confirm"
                                                            data-confirm="Are you Sure ? " data-method="post"
                                                            data-action="{{ route('admin.posts.delete', ['post' => $post]) }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='new-post'>
        @include('backend.post.modals.new')
    </x-modal>
@endsection
