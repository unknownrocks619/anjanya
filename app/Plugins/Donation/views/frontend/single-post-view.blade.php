@php
    /** @var  \App\Models\AdminModel $modelInstance */
    // based on give model instance check which donation has been integrated.
    $donationProgress = \App\Plugins\Donation\Http\Models\DonationHooks::where('relation_model_class', $modelInstance::class)
                                                                        ->where('relation_model_id',$modelInstance->getKey())
                                                                        ->with(['getDonation' => function($query) {
                                                                            $query->whereNotNull('donation_cap_amount');
                                                                        }])
                                                                        ->get();
@endphp
@foreach ($donationProgress as $donation)
    <div class="d-flex flex-wrap progress-wrap">
        <div class="progress progress-moved">
            <div class="progress-bar secondary-bg" style="width: 70%">
                <span class="progress-text">Raised Funds</span>
                <span class="progress-percentage">70%</span>
            </div>
        </div>
        <div class="fund-detail">
            <div class="fund-item">
                <i class="fas fa-hand-holding-usd"></i>
                <h5 class="fund-content">$7,000 Raised</h5>
            </div>
            <div class="fund-item">
                <i class="fas fa-chart-line"></i>
                <h5 class="fund-content">$10,000 (Goal)</h5>
            </div>
        </div>
    </div>
@endforeach
