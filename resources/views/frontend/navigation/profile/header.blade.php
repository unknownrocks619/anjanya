<header>
    <div class="d-none d-lg-flex align-items-center justify-content-between p-3">
        <div class="header-logo">
            <a href="javascript:void(0)" class=""><img src="assets/images/logo.svg" alt="" /></a>
        </div>
        <div class="header-info">
            <div class="header-links">
                <ul>
                    <li>
                        <a href="javascript:void(0)"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 17H19.781L19 13.877V10C18.998 8.31815 18.3906 6.69324 17.2888 5.42253C16.187 4.15181 14.6646 3.32026 13 3.08V2H11V3.08C9.3354 3.32026 7.81295 4.15181 6.71118 5.42253C5.60941 6.69324 5.00197 8.31815 5 10V13.877L4.219 17H3V19H8.142C8.36027 19.8576 8.85806 20.618 9.55672 21.1611C10.2554 21.7042 11.1151 21.9991 12 21.9991C12.8849 21.9991 13.7446 21.7042 14.4433 21.1611C15.1419 20.618 15.6397 19.8576 15.858 19H21V17ZM6.97 14.243L7 10C7 8.67392 7.52678 7.40215 8.46447 6.46447C9.40215 5.52678 10.6739 5 12 5C13.3261 5 14.5979 5.52678 15.5355 6.46447C16.4732 7.40215 17 8.67392 17 10V14L17.728 17H6.281L6.97 14.243ZM12 20C11.6505 19.9989 11.3074 19.906 11.0052 19.7305C10.7029 19.555 10.4521 19.303 10.278 19H13.722C13.5479 19.303 13.2971 19.555 12.9948 19.7305C12.6926 19.906 12.3495 19.9989 12 20Z"
                                    fill="#9A9AB0" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="user">
                <div class="user-img d-flex justify-content-center align-items-center">
                    <?php
                    $userImage = auth()
                        ->guard('web')
                        ->user()
                        ->getImage()
                        ->whereNull('type')
                        ->latest()
                        ->first();
                    if ($userImage) {
                        echo "<img src='" .
                            App\Classes\Helpers\Image::getImageAsSize($userImage->image->filepath, 's') .
                            "'
                                                                                                                                                                                                                                                                                                                                class='img-fluid rounded-5' />";
                    } else {
                        echo strtoupper(
                            substr(
                                auth()
                                    ->guard('web')
                                    ->user()->first_name,
                                0,
                                1,
                            ),
                        ) .
                            strtoupper(
                                substr(
                                    auth()
                                        ->guard('web')
                                        ->user()->last_name,
                                    0,
                                    1,
                                ),
                            );
                    }
                    ?>
                </div>
                <div class="user-detail">
                    <div class="name">
                        {{ auth()->guard('web')->user()->getFullName() }}
                    </div>
                    <div class="email">{{ auth()->guard('web')->user()->getEmail() }}</div>
                </div>
            </div>
        </div>


    </div>
</header>
