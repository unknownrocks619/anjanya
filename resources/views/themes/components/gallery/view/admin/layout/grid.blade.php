@foreach ($gallery as $image)
    <div class="col-3">
        <div class="card">
            <div class="card-body">
                <img src='' class="img-fluid w-50" />
            </div>
            <div class="card-footer">
                <button> Delete </button>
            </div>
        </div>
    </div>
@endforeach
