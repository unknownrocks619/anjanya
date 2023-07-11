@if ($isFooter == true)
    <div class="footer-main">
        <div class="footer-bg">
            <div class="footer-overlay"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-4">
                        <img src="assets/images/upschool-14.png" class="w-100" alt="">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2>Change Making Communities</h2>
                        <p>Upschool is an <a href="https://upschool.co/">online learning platform</a> for students
                            and
                            teachers. Underpinning everything we do at <a href="https://upschool.co/">Upschool</a>
                            is a
                            deep desire to empower students to find their voice, refine and develop their message
                            and
                            teach them how to collaborate with each other so that they can create the change they
                            want
                            to see in the world.</p>
                        <div class="w-25 border-top pt-4 mt-4 mx-auto">
                            <img src="assets/images/indigenous-art.jpg" class="w-100" alt="">
                            <h5>Acknowledgement of Country</h5>
                        </div>
                        <p class="fs-10">Upschool would like to acknowledge that we live, work, learn and play on
                            the
                            lands of the Aboriginal and Torres Strait Islander people’s – who are the oldest
                            continuing
                            culture in human history and the traditional owners of the land we now call Australia.
                            We
                            acknowledge the wisdom and diversity of these people and seek to learn from and be
                            inspired
                            by their culture. We are grateful for the dignity they show us in allowing us to share
                            this
                            land with them. Our pledge is to continue to work to bring more awareness to topics that
                            the
                            elders past, present and emerging bring our attention to and take meaningful action to
                            create positive change here in Australia and the wider world.&nbsp;</p>
                    </div>
                </div>

                <div class="row align-items-center justify-content-between py-4">
                    <div class="col-md-3">
                        <img src="assets/images/logo.webp" height="30px" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-md-end gap-3 flex-wrap mt-4 justify-content-center">
                            @foreach (\App\Classes\Helpers\Menu::all() as $footer_menu)
                                @php
                                    if ($footer_menu->menu_position != 'footer') {
                                        continue;
                                    }
                                @endphp
                                <a href="javascript:void(0)" class="footer-link">{{ $footer_menu->menu_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
