<div class="modal fade modal-bookmark" id="{{ $id }}" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" id='{{ $id }}-modal-document' role="document">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot ?? '<p>Please wait loading content.</p>' }}
        </div>
    </div>
</div>
