<form action="{{route('admin.products.additional-content.store',['product' => $product])}}" method="post" class="ajax-form">
    <div class="row my-3">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" />
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 text-end">
            <button class="btn btn-primary">Save Additional Content</button>
        </div>
    </div>
</form>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Available Additional Content</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->additionalContent as $additionalContent)
                                        <tr>
                                            <td>
                                                {{$additionalContent->title}}
                                            </td>
                                            <td>
                                                {{$additionalContent->full_description}}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{route('admin.products.additional-content.update',['product' => $product,'additionalProduct' => $additionalContent])}}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#"
                                                           data-confirm="Are you sure?"
                                                           class="data-confirm"
                                                           data-method="post"
                                                           data-action="{{route('admin.products.additional-content.delete',['product' => $product,'additionalProduct' => $additionalContent])}}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
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
        </div>
    </div>
</div>