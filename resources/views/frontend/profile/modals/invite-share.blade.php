 <!-- Modal -->
 <div class="modal fade add-popup" id="inviteShare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-xl">
         <div class="modal-content">
             <div class="student-pills">
                 <div class="d-md-flex align-items-start">
                     <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                         <h2>
                             Invite Students
                         </h2>
                         <p>Invite students from your class</p>
                         <h3>Choose an invite option</h3>
                         <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                             data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                             aria-selected="true">
                             <span class="side-ic"><svg width="19" height="15" viewBox="0 0 19 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <g clip-path="url(#clip0_1_1786)">
                                         <path
                                             d="M17.2129 7.84268C18.8903 6.18741 18.8903 3.50674 17.2129 1.85147C15.7286 0.386626 13.3892 0.196197 11.6821 1.4003L11.6346 1.43252C11.2071 1.73428 11.1092 2.32022 11.415 2.73917C11.7207 3.15811 12.3145 3.25772 12.739 2.95596L12.7865 2.92374C13.7395 2.25284 15.0428 2.35831 15.8681 3.17569C16.8032 4.09854 16.8032 5.59268 15.8681 6.51553L12.5371 9.8085C11.602 10.7314 10.0879 10.7314 9.15277 9.8085C8.32449 8.99112 8.21762 7.70499 8.89746 6.76749L8.93012 6.72061C9.2359 6.29874 9.13496 5.7128 8.71043 5.41397C8.2859 5.11514 7.68918 5.21182 7.38637 5.63077L7.35371 5.67764C6.13059 7.35928 6.32355 9.66788 7.80793 11.1327C9.48527 12.788 12.2017 12.788 13.879 11.1327L17.2129 7.84268ZM1.7873 7.15713C0.109961 8.81241 0.109961 11.4931 1.7873 13.1483C3.27168 14.6132 5.61105 14.8036 7.31809 13.5995L7.36559 13.5673C7.79309 13.2655 7.89105 12.6796 7.58527 12.2606C7.27949 11.8417 6.68574 11.7421 6.26121 12.0439L6.21371 12.0761C5.26074 12.747 3.95746 12.6415 3.13215 11.8241C2.19699 10.8983 2.19699 9.4042 3.13215 8.48135L6.46309 5.19131C7.39824 4.26846 8.9123 4.26846 9.84746 5.19131C10.6757 6.0087 10.7826 7.29483 10.1028 8.23526L10.0701 8.28213C9.76434 8.70401 9.86527 9.28995 10.2898 9.58877C10.7143 9.8876 11.3111 9.79092 11.6139 9.37198L11.6465 9.3251C12.8696 7.64053 12.6767 5.33194 11.1923 3.86709C9.51496 2.21182 6.79855 2.21182 5.12121 3.86709L1.7873 7.15713Z"
                                             fill="#242254" fill-opacity="0.5" />
                                     </g>
                                     <defs>
                                         <clipPath id="clip0_1_1786">
                                             <rect width="19" height="15" fill="white" />
                                         </clipPath>
                                     </defs>
                                 </svg></span> <span class="side-link">Invite via Share Link</span>
                         </button>
                         <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                             data-bs-target="#v-pills-profile" type="button" role="tab"
                             aria-controls="v-pills-profile" aria-selected="false">
                             <span class="side-ic dash"><svg width="22" height="22" viewBox="0 0 22 22"
                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M2.75 4.8125C2.37188 4.8125 2.0625 5.12188 2.0625 5.5V6.44961L9.47461 12.534C10.3641 13.2645 11.6402 13.2645 12.5297 12.534L19.9375 6.44961V5.5C19.9375 5.12188 19.6281 4.8125 19.25 4.8125H2.75ZM2.0625 9.11797V16.5C2.0625 16.8781 2.37188 17.1875 2.75 17.1875H19.25C19.6281 17.1875 19.9375 16.8781 19.9375 16.5V9.11797L13.8359 14.1281C12.1859 15.4816 9.80977 15.4816 8.16406 14.1281L2.0625 9.11797ZM0 5.5C0 3.9832 1.2332 2.75 2.75 2.75H19.25C20.7668 2.75 22 3.9832 22 5.5V16.5C22 18.0168 20.7668 19.25 19.25 19.25H2.75C1.2332 19.25 0 18.0168 0 16.5V5.5Z"
                                         fill="#242254" fill-opacity="0.5" />
                                 </svg></span> <span class="side-link">Invite via Email</span>
                         </button>
                         <button class="nav-link mb-0" id="v-pills-messages-tab" data-bs-toggle="pill"
                             data-bs-target="#v-pills-messages" type="button" role="tab"
                             aria-controls="v-pills-messages" aria-selected="false">
                             <span class="side-ic"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M15.0976 7.88127L10.6008 12.1256V0.682361C10.6008 0.501388 10.5289 0.327826 10.4009 0.199859C10.273 0.0718914 10.0994 0 9.91843 0V0C9.73746 0 9.5639 0.0718914 9.43593 0.199859C9.30796 0.327826 9.23607 0.501388 9.23607 0.682361V12.1426L4.77684 7.88468C4.71169 7.823 4.63502 7.77476 4.55121 7.74275C4.4674 7.71073 4.37809 7.69555 4.28841 7.69809C4.19873 7.70062 4.11043 7.72082 4.02856 7.75752C3.94669 7.79422 3.87286 7.84671 3.8113 7.91198C3.6866 8.04102 3.61775 8.21399 3.61967 8.39343C3.62158 8.57288 3.69411 8.74434 3.82154 8.87069L9.89455 14.6366L16.0358 8.87069C16.1654 8.74871 16.2423 8.58091 16.2499 8.40307C16.2576 8.22524 16.1954 8.05146 16.0767 7.9188C16.0157 7.85079 15.9416 7.79573 15.8589 7.7569C15.7761 7.71807 15.6864 7.69626 15.5951 7.69276C15.5038 7.68926 15.4127 7.70414 15.3272 7.73652C15.2417 7.76891 15.1636 7.81813 15.0976 7.88127Z"
                                         fill="#242254" fill-opacity="0.5" />
                                     <path
                                         d="M19.2903 19.4643H0.716479C0.529376 19.4644 0.349675 19.3913 0.215789 19.2606C0.0819029 19.1299 0.00445483 18.952 0 18.7649L0 13.9202C0 13.7392 0.0718914 13.5656 0.199859 13.4377C0.327826 13.3097 0.501388 13.2378 0.682361 13.2378C0.863334 13.2378 1.0369 13.3097 1.16486 13.4377C1.29283 13.5656 1.36472 13.7392 1.36472 13.9202V17.6117C1.36472 17.7411 1.41612 17.8652 1.50762 17.9567C1.59912 18.0482 1.72321 18.0996 1.85261 18.0996H18.2293C18.337 18.0996 18.4402 18.0568 18.5164 17.9807C18.5925 17.9046 18.6353 17.8013 18.6353 17.6936V13.9202C18.6353 13.7392 18.7072 13.5656 18.8351 13.4377C18.9631 13.3097 19.1367 13.2378 19.3176 13.2378C19.4986 13.2378 19.6722 13.3097 19.8001 13.4377C19.9281 13.5656 20 13.7392 20 13.9202V18.7649C19.9956 18.9508 19.9191 19.1277 19.7867 19.2582C19.6542 19.3887 19.4763 19.4626 19.2903 19.4643Z"
                                         fill="#242254" fill-opacity="0.5" />
                                 </svg></span> <span class="side-link">Import from CSV file</span>
                         </button>
                     </div>
                     <div class="tab-content" id="v-pills-tabContent">
                         <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab" tabindex="0">
                             <div class="p-4 p-lg-5">
                                 <h3>Invite with a Share Link</h3>
                                 <p>Anyone with this link can join Upschool as your student. <br>
                                     This link will expire in 120 minutes.</p>
                                 <?php
                                 $url = \Illuminate\Support\Facades\URL::temporarySignedRoute('frontend.users.invite_user', now()->addHours(2), ['token' => $user->invite_token]);
                                 ?>
                                 <div class="input-btn">
                                     <input type="text" readonly
                                         value="{{ route('frontend.users.invite_user', ['token' => $user->invite_token]) }}"
                                         placeholder="{{ $url }}">
                                     <a href="javascript:void(0)" data-url="{{ $url }}"
                                         class="save-btn copy_link">Copy</a>
                                 </div>
                                 <h3>Invite with a Share Link</h3>

                                 <a href="javascript:void(0)" class="me-4"><img src="assets/images/whatsapp.svg"
                                         alt=""></a>
                                 <a href="javascript:void(0)"><img src="assets/images/envelope.svg" alt=""></a>

                             </div>
                         </div>
                         <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab" tabindex="0">
                             <div class="p-4 p-lg-5">
                                 <h3>Invite via Email</h3>
                                 <p>Students will be able to access Upschool Courses once <br>
                                     they create an account from the link on the email.</p>

                                 <form action="{{ route('frontend.users.invite_email') }}"
                                     class="ajax-form ajax-append" method="post">
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="form-group">
                                                 <textarea name="emails" id="emails" class='form-control' required rows="7"
                                                     placeholder="Enter multiple email addresses, separated by comma. e.g. ryan@school.com.au, phillip@sydney.com,"></textarea>
                                             </div>
                                         </div>
                                         <div class="col-md-12 mt-3">
                                             <div class="row  d-flex justify-content-end">
                                                 <div class="col-md-4">
                                                     <button type="submit" class="save-btn btn btn-primary"
                                                         style="color:#fff !important">
                                                         Send Invitations
                                                     </button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </form>

                             </div>
                         </div>
                         <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab" tabindex="0">
                             <div class="p-4 p-lg-5">
                                 <h3>Bulk upload Excel file</h3>
                                 <div class="cvc-card">
                                     <div class="cvc-head">
                                         <a href="{{ asset('User Onboarding Template.xlsx') }}"
                                             class="cvc-btn">Download sample CSV File</a>
                                     </div>
                                     @if (auth()->guard('web')->user()->role == 'teacher' &&
                                             auth()->guard('web')->user()->getOrganisation &&
                                             auth()->guard('web')->user()->getOrganisation->active == true &&
                                             auth()->guard('web')->user()->getOrganisation->role == 'teacher')
                                         <div class="cvc-body">
                                             <form action="{{ route('frontend.users.profile.bulk-upload') }}"
                                                 method="post">
                                                 <div class="cvc-uploader">
                                                     Click to browse or drag and drop your .csv file
                                                     <label class="label">
                                                         <input type="file" accept="application/csv"
                                                             name="file"
                                                             class="default-file-input upload-bulk-user" />
                                                     </label>
                                                 </div>
                                             </form>
                                         </div>
                                     @else
                                         <form action="{{ route('frontend.users.profile.organisation_update') }}"
                                             method="post" class="ajax-form">
                                             <div class="row my-2">
                                                 <div class="col-md-12 px-4">
                                                     <div class="form-group">
                                                         <label for="university">Please Select your University</label>
                                                         <select name="university" id="university_selection"
                                                             data-action="{{ route('frontend.users.universities_list') }}"
                                                             class="form-control ajax-select-2">
                                                         </select>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="row d-flex justify-content-end">
                                                 <div class="col-md-6 mt-3">
                                                     <button type="submit" class="save-btn update-my-university">
                                                         Save my University
                                                     </button>
                                                 </div>
                                             </div>
                                         </form>
                                     @endif
                                 </div>


                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
