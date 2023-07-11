@extends('themes.admin.master')

@push('page_title')
    - Book List
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Book List</h3>
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
                        <a class="btn btn-primary" href="{{ route('admin.book.edit') }}">
                            Upload Book
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Author</th>
                                        <th>Project Selected</th>
                                        <th>Status</th>
                                        <th>Categories</th>
                                        <td>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>
                                                {{ $book->book_title }}
                                            </td>
                                            <td>
                                                {{ $book->getAuthor?->getFullName() }}
                                            </td>
                                            <td>
                                                {{ $book->getSelectedProject?->title }}
                                            </td>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::status_label($book->status) !!}
                                            </td>
                                            <td>
                                                @foreach ($book->getCategories() as $category)
                                                    {!! \App\Classes\Helpers\Status::label_text($category->category_name) !!}
                                                @endforeach
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.book.edit', ['book' => $book]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    @if (!$book->is_converted)
                                                        <li class="edit text-warning"> <a class="text-warning data-confirm"
                                                                data-confirm="Convert Book Into Product ?" href=""
                                                                data-method="post"
                                                                data-action="{{ route('admin.ecom.convert_book', ['book' => $book]) }}"><i
                                                                    class="icofont icofont-brand-appstore"></i></a>
                                                        </li>
                                                    @endif
                                                    <li class="delete"><a href="#" class="data-confirm"
                                                            data-action="{{ route('admin.book.delete', ['book' => $book]) }}"
                                                            data-method="post"><i class="icon-trash"></i></a></li>
                                                </ul>
                                            </td>
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
@endsection
