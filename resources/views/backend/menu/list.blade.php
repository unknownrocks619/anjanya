@extends('themes.admin.master')

@push('page_title')
    - Menu
@endpush

@push('custom_css')
    <style type="text/css">
        .sortable-helper {
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            /* Adjust background color as needed */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Adjust box shadow as needed */
            transition: transform 0.3s ease-out;
        }

        .sortable-helper-content {
            padding: 10px;
            /* Adjust padding as needed */
            transition: opacity 0.3s ease-out;
        }

        .sortable-helper-content.slide {
            opacity: 0;
            transition: opacity 0.3s ease-out;
        }
    </style>
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Menu List</h3>
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
                        <a data-action="{{ route('admin.menu.clear_cache') }}" href="{{ route('admin.menu.clear_cache') }}"
                            class="btn btn-danger data-confirm" data-confirm="Clear All cache ?">
                            Clear Menu Cache
                        </a>
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
                            Add new Menu
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable-lister-sortable" data-action="{{ route('admin.menu.reorder') }}"
                                id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>

                                        </th>
                                        <th>Menu Name</th>
                                        <th>Type</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr data-sort-id="{{ $menu->getKey() }}">
                                            <td class="text-center sortable-handle">
                                                <i class="fa fa-sort fs-3"></i>
                                            </td>
                                            <td>
                                                {{ $menu->menu_name }}
                                            </td>
                                            <td>
                                                {{ \App\Models\Menu::MENU_TYPES[$menu->menu_type] ?? $menu->menu_type }}
                                            </td>
                                            <td>
                                                {{ \App\Models\Menu::MENU_POSITIONS[$menu->menu_position] ?? $menu->menu_type }}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ route('admin.menu.edit', ['menu' => $menu]) }}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" data-confirm="Are you sure?" class="data-confirm"
                                                            data-method="post"
                                                            data-action="{{ route('admin.menu.delete_menu', ['menu' => $menu]) }}"><i
                                                                class="icon-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @if ($menu->children && count($menu->children))
                                            @foreach ($menu->children as $children)
                                                <tr class=" children bg-light text-dark"
                                                    data-child-sort="{{ $children->getKey() }}"
                                                    data-parent-id="{{ $menu->getKey() }}">
                                                    <td class="text-end child-sortable-handle">
                                                        <i class="fa fa-sort fs-4"></i>
                                                    </td>
                                                    <td>{{ $children->menu_name }}</td>
                                                    <td>{{ \App\Models\Menu::MENU_TYPES[$children->menu_type] ?? $children->menu_type }}</td>
                                                    <td>
                                                        {{ \App\Models\Menu::MENU_POSITIONS[$children->menu_position]  ?? $children->menu_position}}
                                                    </td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a
                                                                    href="{{ route('admin.menu.edit', ['menu' => $children]) }}">
                                                                    <i class="icon-pencil-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete">
                                                                <a href="#" data-confirm="Are you Sure ?"
                                                                    data-method="post" class="data-confirm"
                                                                    data-action="{{ route('admin.menu.delete_menu', ['menu' => $children]) }}"><i
                                                                        class="icon-trash"></i></a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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
