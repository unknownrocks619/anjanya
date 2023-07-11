<div class="modal-content">
    <button type="button" class="close-modal" data-bs-dismiss="modal" aria-label="Close">
        <img src="assets/images/close-modal.svg" alt="">
    </button>
    <div class="modal-body" data-amount={{ $amount }} data-selection-type="product"
        data-product="{{ $product->getKey() }}" href="#" data-method="post"
        data-body="{{ json_encode(['amount' => $amount, 'product' => $product->getKey(), 'project' => $product->getRecommendedProject->getKey(), 'quantity' => 1]) }}"
        data-project="{{ $product->getRecommendedProject?->getKey() }}">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-md-0 mb-4">
                <div class="fs-23 fw-700 text-blue mb-4">
                    Your Purchase Supports A Project
                </div>
                <div class="project-card">
                    <div class="people-img">

                        @include('frontend.books.tabs.profile-book-image', ['product' => $product])


                    </div>
                    <div class="project-body">
                        <div class="fs-22 fw-700 text-blue text-decoration-underline mb-3">
                            {{ $product->getRecommendedProject?->title }}
                        </div>
                        <div class="fs-15 fw-400 text-darkpurple">
                            {{ $product->getRecommendedProject?->organisation->organisation_name }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="mb-4">
                    <a data-amount={{ $amount }} data-selection-type="product"
                        data-product="{{ $product->getKey() }}" href="#"
                        data-action="{{ route('frontend.orders.order') }}" data-method="post"
                        class="recommend-btn ajax-modal" data-bs-target="#dynamic_js_modal"
                        data-body="{{ json_encode(['amount' => $amount, 'product' => $product->getKey(), 'project' => $product->getRecommendedProject->getKey(), 'quantity' => 1]) }}"
                        data-project={{ $product->getRecommendedProject?->getKey() }}>
                        Continue with Author’s Recommended Project
                    </a>
                </div>
                <a data-amount="{{ $amount }}" data-product="{{ $product->getKey() }}"
                    data-body="{{ json_encode(['amount' => $amount, 'product' => $product->getKey(), 'project' => $product->getRecommendedProject->getKey(), 'quantity' => 1]) }}"
                    href="javascript:void(0)" data-action="{{ route('frontend.project.modal-list') }}"
                    data-method="get" class="fs-22 fw-400 text-blue text-decoration-underline select-bundle-project">
                    Select Another Project
                </a>
            </div>
        </div>
    </div>

</div>
