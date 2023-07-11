<div class="row bg-light">
    <div class="col-md-12 mt-4">
        <div class="card-body">
            <form method="post" action="{{ route('admin.book.upload', ['book' => $book]) }}" data-max-file='6'>
                <div class="dropzone dropzone-info dz-area" id="fileTypeValidation">
                    <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                        <h4>Drop Your Pdf File Here..</h4><span class="note needsclick">
                            If Book was previously Uploaded, This will replace old book.
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($book->pdf)
    <div class="row mt-2">
        <div class="col-md-12">
            <a target="__blank" href="{{ \App\Classes\Helpers\FileUpload::getFile($book->pdf->filepath) }}"
                class="btn btn-primary">Click to preview</a>
        </div>
    </div>
@endif
