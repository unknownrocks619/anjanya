<div class="footer-newsletter">
    <div class="widget-content">
        <h5>Subscribe us for more update & news !!</h5>
        <form class="newsletter ajax-form ajax-message ajax-response ajax-append" method="post" action="{{route('frontend.newsletter.store')}}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Enter Your Email"
                                                     class="subscription">
                        <button type="submit" class="button-round-primary">Subscribe</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
