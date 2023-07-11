<div class="modal-content orderlineDetail" data-order-index={{ $orderLine->getKey() }}
    data-orderLine-pricing={{ $orderLine->item_price }}>
    <button type="button" class="close-modal" data-bs-dismiss="modal" aria-label="Close">
        <img src="assets/images/close-modal.svg" alt="">
    </button>
    <div class="modal-body p-0" data-amount={{ $orderLine->item_price }} data-selection-type="product"
        data-product="{{ $product->getKey() }}" href="#" data-method="post"
        data-body="{{ json_encode(['amount' => $orderLine->item_price, 'product' => $product->getKey(), 'project' => $orderLine->project_id, 'quantity' => $orderLine->quantity]) }}"
        data-project="{{ $orderLine->project_id }}">
        <div class="text-center fs-23 fw-700 text-blue mb-4">
            Buy and Download the eBook - AU
            {{ \App\Classes\Helpers\Money::AU($orderLine->item_price) }}
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="selection-card">
                    <div class="fs-23 fw-700 text-blue">
                        Your Selection
                    </div>
                    <div class="fs-16 fw-600 text-blue mb-2">
                        Book
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-6">
                            <div class="book-img br-12">
                                <img src="assets/images/sellerCard.png" class="br-12" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6 ps-lg-0">
                            <div class="fs-14 fw-700 text-blue mb-2">
                                {{ $product->product_name }}
                            </div>
                            <div class="fs-12 fw-600 text-blue">
                                {{ $product->getAuthor?->getFullName() }}
                            </div>
                        </div>
                    </div>
                    <div class="project-card mb-3">
                        <div class="people-img">
                            <img src="assets/images/people-img.png" class="w-100" alt="">
                        </div>
                        <div class="project-body">
                            <div class="fs-19 fw-700 text-blue text-decoration-underline mb-3">
                                {{ $project->title }}
                            </div>
                            <div class="fs-15 fw-400 text-darkpurple">
                                {{ $project->organisation->organisation_name }}
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" data-amount="{{ $orderLine->item_price }}"
                        data-product="{{ $product->getKey() }}" href="javascript:void(0)"
                        data-action="{{ route('frontend.project.modal-list') }}"
                        class="fs-15 fw-400 text-blue text-decoration-underline select-bundle-project">
                        Change
                        Project</a>
                </div>
            </div>
            <div class="col-lg-8 mt-md-0 mt-4">
                <div class="fs-23 fw-700 text-blue mb-4">
                    Book Quantity
                </div>
                <div class="d-flex align-items-center  gap-4 mb-3">
                    <a href="javascript:void(0)" class="count-btn order_minus">-</a>
                    <div class="fs-19 fw-700 text-blue order_qty" data-qty="{{ $orderLine->quantity }}">
                        {{ $orderLine->quantity }}
                    </div>
                    <a href="javascript:void(0)" class="count-btn order_plus">+</a>
                </div>
                <div class="mb-4">
                    <div class="fs-23 fw-700 text-blue mb-3">
                        Extra Donation
                    </div>
                    <div class="fs-16 fw-600 text-blue mb-3">
                        $2.50 from the purchase of this book will be donated to your selected charity. Would you like to
                        make an extra donation?
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <a href="javascript:void(0)" class="count-btn donation_button" data-amount="5">
                            {{ \App\Classes\Helpers\Money::AU(5, '') }}
                        </a>
                        <a href="javascript:void(0)" class="count-btn donation_button" data-amount="10">
                            {{ \App\Classes\Helpers\Money::AU(10, '') }}
                        </a>
                        <a href="javascript:void(0)" class="count-btn donation_button" data-amount="15">
                            {{ \App\Classes\Helpers\Money::AU(15, '') }}
                        </a>
                        <a href="javascript:void(0)" class="count-btn donation_button" data-amount="25">
                            {{ \App\Classes\Helpers\Money::AU(25, '') }}
                        </a>
                        <div class="d-flex align-items-center">
                            <a href="javascript:void(0)" class="count-btn donation_minus">
                                -
                            </a>
                            <div class="count-box donation_text" data-amount="{{ $orderLine->donation_amount }}">
                                {{ \App\Classes\Helpers\Money::AU($orderLine->donation_amount, '') }}
                            </div>
                            <a href="javascript:void(0)" class="count-btn donation_plus">
                                +
                            </a>
                        </div>
                    </div>
                </div>
                <div class="fs-23 fw-700 text-blue mb-3">
                    Tip
                </div>
                <div class="fs-16 fw-600 text-blue mb-3">
                    Please consider giving Upschool a tip to help fund our FREE courses and resources.
                </div>
                <div class="d-flex align-items-center flex-wrap gap-2">
                    <a href="javascript:void(0)" class="count-btn tip_button" data-amount="5">
                        {{ \App\Classes\Helpers\Money::AU(5, '') }}
                    </a>
                    <a href="javascript:void(0)" class="count-btn tip_button" data-amount="10">
                        {{ \App\Classes\Helpers\Money::AU(10, '') }}
                    </a>
                    <a href="javascript:void(0)" class="count-btn tip_button" data-amount="15">
                        {{ \App\Classes\Helpers\Money::AU(15, '') }}
                    </a>
                    <a href="javascript:void(0)" class="count-btn tip_button" data-amount="25">
                        {{ \App\Classes\Helpers\Money::AU(25, '') }}
                    </a>
                    <div class="d-flex align-items-center">
                        <a href="javascript:void(0)" class="count-btn tip_minus">
                            -
                        </a>
                        <div class="count-box tip_text" data-amount="{{ $orderLine->tip_amount }}">
                            {{ \App\Classes\Helpers\Money::AU($orderLine->tip_amount, '') }}
                        </div>
                        <a href="javascript:void(0)" class="count-btn tip_plus">
                            +
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-flex align-items-center justify-content-between px-3 py-2 bg-row">
                        <div class="fs-16 fw-400 text-blue">
                            Credit Card/Bank Processing Fee (2.9% + AU $0.30)
                        </div>
                        <div class="fs-16 fw-400 text-blue processing_fee"
                            data-amount="{{ $orderLine->processing_charge }}">
                            {{ \App\Classes\Helpers\Money::AU($orderLine->processing_charge) }}

                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between px-3 py-2">
                        <div class="fs-16 fw-400 text-blue">
                            Extra Donation
                        </div>
                        <div class="fs-16 fw-400 text-blue extra_donation"
                            data-amount="{{ $orderLine->donation_amount }}">
                            {{ \App\Classes\Helpers\Money::AU($orderLine->donation_amount) }}

                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between px-3 py-2 bg-row">
                        <div class="fs-16 fw-400 text-blue">
                            Upschool Tip
                        </div>
                        <div class="fs-16 fw-400 text-blue tip_amount" data-amount={{ $orderLine->tip_amount }}>
                            {{ \App\Classes\Helpers\Money::AU($orderLine->tip_amount) }}
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between px-3 py-2">
                        <div class="fs-27 fw-600 text-blue">
                            Total
                        </div>
                        <div class="fs-27 fw-600 text-blue total_field" data-amount="{{ $orderLine->final_amount }}">
                            {{ \App\Classes\Helpers\Money::AU($orderLine->final_amount) }}
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-md-center gap-3 flex-md-row flex-column justify-content-between mt-4">
                    <div class="d-flex align-items-center gap-1">
                        <img src="assets/images/arrow.svg" alt="">
                        <div class="fs-15 fw-400 text-blue text-decoration-underline">
                            Continue to Shopping
                        </div>
                    </div>
                    <a href="{{ route('frontend.orders.checkout') }}" class="checkout-btn">Continue to Checkout</a>
                </div>
            </div>

        </div>
    </div>

</div>
