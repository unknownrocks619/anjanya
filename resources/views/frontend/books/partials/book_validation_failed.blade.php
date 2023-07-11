<div class="col-md-12 mt-4 pt-2 alreadyErrorUpload">
    <h5 class="mt-4" style="color:#D61A5F !important;font-family:'Roboto';font-size:23px;">
        Oh oh!

    </h5>
    <p class="pt-4" style="font-size:17px;color:#242254">
        It looks like your book needs some changes before it can be uploaded to the
        Upschool Library. Please refer to the checklist here and make sure your book meets
        all of the requirements, then try again.

    </p>
</div>

<div class="row mb-4 text-right me-5 allowReupload">
    <div class="col-md-12 mt-5 text-right d-flex justify-content-end mb-4 pb-4">
        <button type="button" class="btn next py-3 px-5 data-confirm" data-method="post"
            data-action="{{ route('frontend.books.upload_user', ['book' => $book, 'current_tab' => 'destroy']) }}">
            Re-upload
        </button>
    </div>
</div>
