<div class="seller-dashboard__navigation">
    <div class="dashboard__navigation-top">
        <div class="dashboard__user-proifle">
            <div class="dashboard__user-img">
                <img src="{{ $user->image_url }}" alt="user-photo" />
            </div>
            <div class="dashboard__user-info">
                <h2 class="name text-center">{{ $user->username }}</h2>
                <p class="rating">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.31015 13.4109L12.8564 15.6576C13.3097 15.9448 13.8725 15.5177 13.738 14.9886L12.7134 10.9581C12.6845 10.8458 12.688 10.7277 12.7233 10.6173C12.7586 10.5069 12.8243 10.4087 12.9129 10.334L16.093 7.68719C16.5108 7.33941 16.2951 6.64595 15.7583 6.61111L11.6054 6.34158C11.4935 6.33359 11.3862 6.29399 11.296 6.22738C11.2058 6.16078 11.1363 6.06991 11.0957 5.96537L9.54688 2.06492C9.50478 1.95396 9.42992 1.85843 9.33224 1.79102C9.23456 1.7236 9.11868 1.6875 9 1.6875C8.88132 1.6875 8.76544 1.7236 8.66777 1.79102C8.57009 1.85843 8.49523 1.95396 8.45312 2.06492L6.90426 5.96537C6.86367 6.06991 6.79423 6.16078 6.70401 6.22738C6.61378 6.29399 6.5065 6.33359 6.39464 6.34158L2.24171 6.61111C1.70486 6.64595 1.4892 7.33941 1.90704 7.68719L5.08709 10.334C5.17571 10.4087 5.24145 10.5069 5.27674 10.6173C5.31204 10.7277 5.31546 10.8458 5.2866 10.9581L4.33641 14.6959C4.175 15.3309 4.85036 15.8434 5.39432 15.4988L8.68985 13.4109C8.78254 13.3519 8.89013 13.3205 9 13.3205C9.10987 13.3205 9.21747 13.3519 9.31015 13.4109V13.4109Z" fill="#FFBF00" />
                    </svg>
                    <span>{{ $rating_details['average'] }} {{ __('star_rating') }}</span>
                </p>
            </div>
        </div>
        <hr>
    </div>

    @if($user->about_public_profile)
        <div class="seller-dashboard__navigation-bottom mb-4">
            <p style="text-align: text-justify">{!! $user->about_public_profile !!}</p>
        </div>
    @endif

    @if($user->show_phone == 1 || $user->show_email == 1)
        <div class="seller-dashboard__navigation-bottom">
            <p>{{ __('contact_information') }}</p>
            <ul class="dashboard__nav">
                @if($user->show_phone == 1)
                    @if ($user->phone)
                        <li class="dashboard__nav-item">
                            <a href="tel:{{ $user->phone }}" class="seller-dashboard__nav-link">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.9454 3.75C16.2168 4.09194 17.3761 4.76196 18.3071 5.69294C19.238 6.62392 19.908 7.78319 20.25 9.05462" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.1687 6.6485C14.9316 6.85366 15.6271 7.25567 16.1857 7.81426C16.7443 8.37285 17.1463 9.06841 17.3515 9.83127" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M8.66965 11.7014C9.44762 13.2919 10.7369 14.5753 12.3309 15.346C12.4475 15.4013 12.5765 15.4252 12.7052 15.4155C12.8339 15.4058 12.9579 15.3627 13.0648 15.2905L15.4119 13.7254C15.5157 13.6562 15.6352 13.6139 15.7594 13.6025C15.8837 13.5911 16.0088 13.6109 16.1235 13.66L20.5144 15.5419C20.6636 15.6052 20.7881 15.7154 20.8693 15.8556C20.9504 15.9959 20.9838 16.1588 20.9643 16.3197C20.8255 17.4057 20.2956 18.4039 19.4739 19.1273C18.6521 19.8508 17.5948 20.2499 16.5 20.25C13.1185 20.25 9.87548 18.9067 7.48439 16.5156C5.0933 14.1245 3.75 10.8815 3.75 7.49997C3.75006 6.40513 4.14918 5.34786 4.87264 4.5261C5.5961 3.70435 6.59428 3.17448 7.68028 3.03569C7.84117 3.01622 8.00403 3.04956 8.14432 3.1307C8.28461 3.21183 8.39473 3.33636 8.4581 3.48552L10.3416 7.88032C10.3903 7.994 10.4101 8.11796 10.3994 8.24116C10.3886 8.36436 10.3475 8.48299 10.2798 8.58647L8.72011 10.9696C8.64912 11.0768 8.60716 11.2006 8.59831 11.3288C8.58947 11.4571 8.61405 11.5855 8.66965 11.7014V11.7014Z" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                {{ $user->phone }}
                            </a>
                        </li>
                    @endif
                @endif
                @if($user->show_email == 1)
                    @if ($user->email)
                        <li class="dashboard__nav-item">
                            <a href="mailto:{{ $user->email }}" class="seller-dashboard__nav-link">
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 5.25L12 13.5L3 5.25" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M3 5.25H21V18C21 18.1989 20.921 18.3897 20.7803 18.5303C20.6397 18.671 20.4489 18.75 20.25 18.75H3.75C3.55109 18.75 3.36032 18.671 3.21967 18.5303C3.07902 18.3897 3 18.1989 3 18V5.25Z" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M10.3637 12L3.23132 18.5381" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.7688 18.5381L13.6364 12" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                {{ $user->email }}
                            </a>
                        </li>
                    @endif
                @endif
                @if ($user->website)
                    <li class="dashboard__nav-item">
                        <a href="javascript:;" class="seller-dashboard__nav-link">
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.64868 17.1932L5.74348 16.5323C5.85345 16.4659 5.94453 16.3724 6.00799 16.2607C6.07144 16.149 6.10514 16.0229 6.10586 15.8944L6.12488 12.5073C6.12567 12.3658 6.16649 12.2274 6.24261 12.1081L8.10285 9.19271C8.15783 9.10654 8.22985 9.03251 8.31448 8.97519C8.39911 8.91786 8.49456 8.87844 8.59498 8.85934C8.6954 8.84024 8.79866 8.84187 8.89843 8.86413C8.99819 8.88639 9.09236 8.92881 9.17513 8.98878L11.0179 10.3238C11.1739 10.4369 11.3676 10.4856 11.5585 10.4597L14.5098 10.06C14.6909 10.0355 14.8567 9.94576 14.9763 9.80762L17.0535 7.40755C17.1796 7.26184 17.2448 7.07319 17.2355 6.88072L17.126 4.60227" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M17.5376 19.0953L16.5315 18.0872C16.4374 17.9929 16.3198 17.9254 16.191 17.8915L14.1793 17.3636C14.0007 17.3168 13.8457 17.2057 13.7439 17.0517C13.6421 16.8977 13.6007 16.7116 13.6276 16.5289L13.8512 15.0105C13.8701 14.8824 13.9218 14.7613 14.0014 14.6591C14.081 14.5568 14.1857 14.477 14.3053 14.4272L17.1601 13.2407C17.2919 13.1859 17.4367 13.1698 17.5774 13.1945C17.718 13.2191 17.8487 13.2834 17.9541 13.3798L20.288 15.5143" stroke="#00AAFF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <span class="website">{{ $user->website }}</span>
                            <svg class="go-to-icon" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.1875 7.03125L15.1869 2.81306L10.9688 2.8125" stroke="#464D61" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10.123 7.87701L15.1855 2.81451" stroke="#464D61" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12.9375 10.125V14.625C12.9375 14.7742 12.8782 14.9173 12.7727 15.0227C12.6673 15.1282 12.5242 15.1875 12.375 15.1875H3.375C3.22582 15.1875 3.08274 15.1282 2.97725 15.0227C2.87176 14.9173 2.8125 14.7742 2.8125 14.625V5.625C2.8125 5.47582 2.87176 5.33274 2.97725 5.22725C3.08274 5.12176 3.22582 5.0625 3.375 5.0625H7.875" stroke="#464D61" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    @endif

    @if($user->opening_hour || $user->closing_hours )
        <div class="seller-dashboard__navigation-bottom mt-4 mb-3">
            <p>{{ __('SELLER INFORMATION') }}</p>
            <ul class="dashboard__nav mt-3">
                <li class="dashboard__nav-item">
                    <a href="mailto:{{ $user->email }}" class="seller-dashboard__nav-link">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00aaff" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                                <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        Opening Hour : {{ date('h:i A', strtotime( $user->opening_hour )) }}
                    </a>
                </li>
                <li class="dashboard__nav-item">
                    <a href="mailto:{{ $user->email }}" class="seller-dashboard__nav-link">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00aaff" stroke-width="2" stroke-linecap="round" stroke-linejoin="bevel">
                                <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </span>
                        Closing Hour :  {{ date('h:i A', strtotime( $user->closing_hours )) }}
                    </a>
                </li>
            </ul>
        </div>
    @endif
    @if ($social_medias)
        <div class="seller-dashboard__navigation-bottom mt-4 mb-3">
            {{-- social_medias --}}
            <p>{{ __('follow_on_social_media') }}</p>
            <ul class="{{ $social_medias->count() > 3 ? '' : 'd-flex justify-content-center' }}">
                <li style="margin-right: 2px;">
                    <a href="{{ $user->web }}" target="_blank">
                        <x-svg.link-round-icon />
                    </a>
                </li>
                @foreach ($social_medias as $media)
                    @if ($media->social_media && $media->url)
                        <li style="margin-right: 2px;">
                            <a href="{{ $media->url }}" target="_blank">
                                @if ($media->social_media == 'facebook')
                                    <x-svg.facebook-round-icon />
                                @elseif ($media->social_media == 'twitter')
                                    <x-svg.twitter-round-icon />
                                @elseif ($media->social_media == 'linkedin')
                                    <x-svg.linkedin-round-icon />
                                @elseif ($media->social_media == 'instagram')
                                    <x-svg.instagram-round-icon />
                                @elseif ($media->social_media == 'youtube')
                                    <x-svg.youtube-round-icon />
                                @elseif ($media->social_media == 'pinterest')
                                    <x-svg.pinterest-round-icon />
                                @elseif ($media->social_media == 'reddit')
                                    <x-svg.reddit-round-icon />
                                @elseif ($media->social_media == 'github')
                                    <x-svg.github-round-icon />
                                @elseif ($media->social_media == 'other')
                                    <x-svg.link-round-icon />
                                @endif
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
            <hr>
        </div>
    @endif
    @if (auth('user')->check() && $user->id != auth('user')->id())
        <div class="dashboard__navigation-report new-report">
            <div class="report">
                <button class="seller-dashboard__nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 9.75V13.5" stroke="#767E94" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M10.7018 3.74857L2.45399 17.9978C2.32201 18.2258 2.25242 18.4846 2.2522 18.748C2.25198 19.0115 2.32115 19.2703 2.45275 19.4986C2.58434 19.7268 2.77373 19.9163 3.00184 20.0481C3.22996 20.1799 3.48876 20.2493 3.7522 20.2493H20.2477C20.5112 20.2493 20.77 20.1799 20.9981 20.0481C21.2262 19.9163 21.4156 19.7268 21.5472 19.4986C21.6788 19.2703 21.748 19.0115 21.7478 18.748C21.7475 18.4846 21.6779 18.2258 21.546 17.9978L13.2982 3.74857C13.1664 3.52093 12.9771 3.33193 12.7493 3.20055C12.5214 3.06916 12.263 3 12 3C11.7369 3 11.4785 3.06916 11.2507 3.20055C11.0228 3.33193 10.8335 3.52093 10.7018 3.74857V3.74857Z" stroke="#767E94" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 18C12.6213 18 13.125 17.4963 13.125 16.875C13.125 16.2537 12.6213 15.75 12 15.75C11.3787 15.75 10.875 16.2537 10.875 16.875C10.875 17.4963 11.3787 18 12 18Z" fill="#767E94" />
                        </svg>
                    </span>
                    {{ __('report_seller') }}
                </button>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('report_seller') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('frontend.seller.report') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label" for="reasonn">{{ __('reason') }}</label>
                                <textarea required name="reason" id="reasonn" rows="8" class="form-control" style="width: 100%; height: 120px !important;"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-secondary"
                                data-bs-dismiss="modal">{{ __('close') }}</button>
                            <button type="submit" class="btn">{{ __('submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
<style>
    .seller-dashboard__navigation {
        background: #FFFFFF;
        border-radius: 2px;
        padding: 32px 0px;
    }

    .seller-dashboard__navigation .dashboard__user-info .name {
        font-weight: 600;
        font-size: 22px;
        line-height: 1.4;
        color: #191F33;
        margin-bottom: 10px;
    }

    .seller-dashboard__navigation .dashboard__user-info .rating {
        justify-content: center;
    }

    .seller-dashboard__navigation .dashboard__user-info .rating span {
        font-weight: 600;
        font-size: 14px;
        line-height: 1.43;
        color: #191F33;
        margin-top: 1px;
        margin-left: 2px;
    }

    .seller-dashboard__navigation .dashboard__navigation-top {
        padding: 0px 32px;
        padding-bottom: 0px;
        border-bottom: none;
    }

    hr {
        background-color: #DADDE6;
        height: 1px;
        margin: 24px 0px;
    }

    .dashboard__user-proifle {
        flex-direction: column;
        gap: 24px;
    }

    .rating {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 14px;
        line-height: 1.43;
        color: #191F33;
    }

    .dashboard__navigation_social-mdeia {
        padding: 0px 32px;
        text-align: center;
    }

    .dashboard__navigation_social-mdeia p {
        margin-bottom: 10px;
        font-size: 14px;
        line-height: 1.43;
        color: #767E94;
    }

    .seller-dashboard__navigation-bottom {
        padding: 0px 32px;
    }

    .seller-dashboard__navigation-bottom p {
        font-weight: 600;
        font-size: 16px;
        line-height: 1.33;
        color: #939AAD;
        margin-bottom: 8px;
    }

    .seller-dashboard__navigation .seller-dashboard__nav-link {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #464D61;
        margin-bottom: 16px;
        display: flex;
    }

    .new-report .seller-dashboard__nav-link {
        margin-left: 34px;
    }

    .seller-dashboard__navigation .seller-dashboard__nav-link span {
        display: block;
    }

    .seller-dashboard__navigation .seller-dashboard__nav-link span.icon {
        margin-right: 12px;
        margin-left: -4px;
    }

    .seller-dashboard__navigation .seller-dashboard__nav-link .website {
        margin-right: 6px;
    }

    .seller-dashboard__navigation .seller-dashboard__nav-link .go-to-icon {
        margin-top: 2px;
    }

    .seller-info {
        padding: 0px 32px;
    }

    .seller-info h4 {
        font-weight: 600;
        font-size: 12px;
        line-height: 1.33;
        color: #939AAD;
        margin-bottom: 8px;
    }

    .seller-info p {
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: #464D61;
    }

    .dashboard__navigation-report hr {
        margin: 24px 32px;
    }

    .dashboard__navigation_social-mdeia ul {
        margin: 0px auto;
        column-count: 4;
    }

    .dashboard__navigation_social-mdeia li {
        display: inline-block;
        margin: 8px 4px;
    }
</style>
