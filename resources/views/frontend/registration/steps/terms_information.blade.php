@php
    $sessionInfo = session()->get(session()->getId());
    $personalInfo = $sessionInfo['personal_information'];
    $parseBirth = \Carbon\Carbon::parse($personalInfo['date_of_birth']);
@endphp
<div class="right-side w-100">
    <form action="{{ route('frontend.users.register', ['current_step' => $current_step]) }}" method="post"
        class='ajax-form'>
        <div class="main active">
            <small><i class="fa fa-smile-o"></i></small>
            <div class="text">
                <h2>Terms and Conditions</h2>
                <p>Please read following instructions</p>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3>About Anjaneya Youth Club</h3>
                    <p>
                        An organization FOR the youth, BY the youth spreading the education of Himalayan Siddha Mahayog,
                        the
                        Vedic science of self-realization
                    </p>
                    <p>
                        We are the international youth branch of Mahayogi Siddhababa Spiritual Academy, a spiritual
                        not-for-profit organization founded by enlightened Ananta Shree Vivushit Jagadguru
                        Ramanandacharya Swami Ramakrishnacharya Ji Maharaj (Mahayogi Siddhababa). Through the teachings
                        of Jagadguru Mahayogi Siddhababa and Himalayan Siddha Mahayog, we work to raise human
                        consciousness and foster inner love and peace within ourselves and our communities.
                    </p>
                    <h3>
                        Our Mission
                    </h3>
                    <p>
                        We are dedicated to improving the lives of youth. Through our programs, we share authentic
                        teachings of Sanatan Dharma based on the Guru disciple lineage.

                    </p>
                    <p>
                        We believe Sanatan Dharma, the universal and axiomatic laws that are beyond our temporary belief
                        systems, empowers youth to live their best life and reach their highest potential. Through seva,
                        selfless service to others, we are dedicated to awakening youth to their innate
                        spiritual nature.
                    </p>
                    <h3>
                        Our Programs
                    </h3>
                    <p>
                        Anjaneya Youth Club organizes diverse events and programs. These include: Himalayan Siddha
                        Mahayoga
                        Meditation, Ramcharitmanas Classes, Bhagavad Gita Learning, Sanskrit Classes, Hatha Yoga
                        Classes,
                        Science of Yoga & Spirituality (e.g., chitta-vritti, tri-gunas, pancha kosha, naadis, make up of
                        the
                        mind etc.), Eastern Classical Music, Mental Health Workshops... and many more!
                    </p>
                    <h3>
                        Membership Information
                    </h3>
                    <div class='mt-2'>
                        <h4>Pre-requisite</h4>
                        To apply for membership, you must either:
                        <ol class="text-dark">
                            <li>Already be meditator of Himalayan Siddha Mahayog
                            </li>
                            <li>Register to become a meditator of Himalayan Siddha Mahayog - your membership application
                                will be accepted only upon complete your Himalayan Siddha Mahayog initiation.</li>
                        </ol>
                        <h4>
                            Privileges & Responsibilities
                        </h4>
                        <p>
                            For full membership privileges and responsibilities please carefully read the Anjaneya Youth
                            Club Organizational Framework and Code of Conduct. It is mandatory for all members to follow
                            this.
                            <br /><br />
                            <a href="#">Anjaneya Youth Club Organizational Framework and Code of Conduct
                                [English]</a>
                            <br />
                            <a href="#">आञ्जनेय युवा समूह (क्लब) को संगठानत्मक रूपरेखा र नियमावली [Nepali]</a>
                        </p>
                        <h4>
                            Membership Fee
                        </h4>
                        <p>Nepali Rupee 500 | Indian Rupee 500 | CAD $5 | US $5 | AUS $5 | UK £5 </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group border py-3 px-2 bg-light">
                        <p for="">
                            I, the applicant, have read, understand and agree to strictly follow the Anjaneya Youth Club
                            Organizational Framework and Code of Conduct.
                        </p>
                        <input type="checkbox" name="terms_accept" id="terms_accept" style="display: none"
                            class="d-none">
                        <button type="button" class="btn btn-large btn-primary terms_button">
                            <i class='fa-solid fa-check d-none'></i>
                            I Accept the Code
                            of
                            Conduct</button>
                    </div>
                </div>
            </div>

            <div class="row mt-2 @if ($parseBirth->diffInYears() >= 18) d-none @endif">
                <div class="col-md-8">
                    <h5>
                        Parent or Legal Guardian Signature (Type Full Name)
                    </h5>
                    <p>
                        I, the parent or legal guardian, have read and understand the purpose, code of conduct, rules
                        and
                        regulations stated in the Anjaneya Youth Club Constitution. I hereby consent to my child
                        becoming a
                        member of Anjaneya Youth Club.
                    </p>
                    <div class="row">
                        <p for="">
                            Guardian Signature (Print Full Name)
                        </p>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="parent_full_name" id="" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-md-4">
                    <div class="form-group">
                        <p for="">
                            Applicant Signature (Print Full Name)
                        </p>
                        <input type="text" name="applicant_signature" id="applicant_signature"
                            class="form-control" />
                    </div>
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-start">
                <button type="button" class="btn btn-secondary btn-large mx-2 step-back"
                    data-url="{{ route('frontend.users.register', ['current_step' => $current_step, 'steps' => 'back']) }}">
                    <i class="fa fa-arrow-left">
                    </i>
                    Go Back
                </button>
                <button type="submit" class="btn btn-primary btn-large mx-2">Submit My Application</button>
            </div>
        </div>
    </form>
</div>
