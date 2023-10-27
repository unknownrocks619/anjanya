<div class="row">
    <div class="col-md-12">
        <form enctype="multipart/form-data" action="{{route('admin.maintenance.store-button',['mode'=>$mode])}}" method="post" class="ajax-component-form">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="button_title">Title</label>
                                <input type="text" name="button_title" id="button_title" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="button_description">Description</label>
                                <textarea name="button_description" id="button_description" cols="30" rows="10"
                                          class="form-control tiny-mce"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_label">Button Label</label>
                                <input type="text" name="button_label" id="button_label" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_label">Button Type</label>
                                <select name="response_type" id="button_type"
                                        class="form-control maintenance_mode_button_type">
                                    @foreach (\App\Plugins\Maintanance\Http\Models\MaintenanaceModeButtons::BUTTON_TYPES as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    @foreach (\App\Plugins\Maintanance\Http\Models\MaintenanaceModeButtons::BUTTON_TYPES as $key => $value)
                        <div class="row mode_button_label {{$key}}" @if(! $loop->first) style="display:none" @endif>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="{{$key}}">
                                        {{$value}}
                                    </label>
                                    @if(in_array($key,['pdf','image']))
                                        <input type="file" name="response_value" id="{{$key}}" class="form-control"/>
                                    @else
                                        <input type="text" required name="response_value" id="{{$key}}"
                                               class="form-control"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card rounded-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover display datatable-lister" id='user-list-table'>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Button label</th>
                    <th>Button Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($content as $button)
                        <tr>
                            <td>{{$button->title}}</td>
                            <td>{!! $button->description !!}</td>
                            <td>
                                {{$button->button_label}}
                            </td>
                            <td>
                                {{\App\Plugins\Maintanance\Http\Models\MaintenanaceModeButtons::BUTTON_TYPES[$button->response_type]}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger data-confirm" data-action="{{route('admin.maintenance.delete-button',['button'=>$button])}}" data-confirm="Confirm Delete Selected button ?">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('custom_script')
    <script type="text/javascript">
        $(document).on('change','.maintenance_mode_button_type', function(){
            $('.mode_button_label').fadeOut();
            $('.mode_button_label').find('input').removeAttr('required').removeAttr('name');
            $('.'+$(this).find(':selected').val()).fadeIn();
            $('.'+$(this).find(':selected').val()).find('input').attr('required','required').attr('name','response_value')
        })
    </script>
@endpush
