<div class="col-md-12 mt-4 pt-2">
    <h5 class="mt-4" style="color:#242254;font-family:'Roboto';font-size:23px;">
        Congratulations! Your book is initially approved for upload.
    </h5>
    <p class="pt-4" style="font-size:17px;color:#242254">
        Our team will now do a final check of your book before publishing it on the<br /> Upschool
        Library. We will email you as soon as this check is completed. Thank you.
    </p>
</div>

<div class="row mb-2 text-right me-5 allowNext">
    <div class="col-md-12 mt-5 text-right d-flex justify-content-end mb-4 pb-4">
        <button data-action="{{ route('frontend.books.upload_user', ['book' => $book]) }}" data-method="post"
            class="ajax-button-confirm btn next py-3 px-5 step-back" data-url="" data-step="1"
            data-step-attribute="about-book">
            Next
            <i class="fas fa-arrow-right"></i>
        </button>
    </div>
</div>
