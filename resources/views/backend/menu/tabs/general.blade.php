<form action="{{ route('admin.menu.update', ['menu' => $menu, 'current_tab' => 'general']) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="menu_name">Menu Name</label>
                                <input class="form-control" id="menu_name" name="menu_name" type="text"
                                    required="" placeholder="Menu name" autocomplete="off"
                                    value="{{ $menu->menu_name }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-0">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control" id="slug" name="slug" type="text" required=""
                                    placeholder="menu-slug" autocomplete="off" value="{{ $menu->slug }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="description">Menu Description</label>
                                <textarea name="description" id="description" class="form-control ">{{ $menu->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_type">
                                    Menu Type
                                </label>
                                <select name="menu_type" id="menu_type" class="form-control">
                                    <option value="">Please Select Menu Type</option>
                                    @foreach (\App\Models\Menu::MENU_TYPES as $key => $value)
                                        <option @if ($menu->menu_type == $key) selected @endif
                                            value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="menu_position">
                                    Menu Position
                                </label>
                                <select name="menu_position" id="menu_position" class="form-control">
                                    <option value="">Please Select Menu Position</option>
                                    @foreach (\App\Models\Menu::MENU_POSITIONS as $key => $value)
                                        <option @if ($menu->menu_position == $key) selected @endif
                                            value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="parent_menu">
                                    Parent Menu
                                </label>
                                <select name="parent_menu" id="parent_menu" class="form-control ajax-select-2"
                                    data-action="{{ route('admin.menu.json_output', ['selectionMenu' => $menu]) }}">
                                    @if ($menu->parent)
                                        <option value="{{ $menu->parent->getKey() }}">{{ $menu->parent->menu_name }}
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-3">
                            <div class="form-group d-flex align-items-center mt-1">
                                <div class="m-t-15 m-checkbox-inline">
                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                        <input {{ $menu->active ? 'checked' : '' }} class="form-check-input"
                                            name="active" id="active" type="checkbox" data-bs-original-title=""
                                            title="Active">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Menu
            </button>
        </div>
    </div>
</form>
