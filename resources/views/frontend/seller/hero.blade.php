<div class="dashboard-post2 mb--24 mt--24 p-2">
    <div class="d--flex justify-content-between">
        <div class="dd--flex align-items-center">
            <div class="d-flex align-items-center">
                <div class="total-star">
                    <span class="total-star-text">{{ $rating_details['average'] }}</span>
                </div>
                <div class="ml--16 d-flex align-items-start flex-column">
                    <div class="mb-auto">
                        @for ($i = 0; $i < $rating_details['average']; $i++)
                            <svg width="20" height="20" viewBox="0 0 20 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.4135 15.8812L15.1419 18.8769C15.7463 19.2598 16.4967 18.6903 16.3173 17.9847L14.9512 12.6108C14.9127 12.4611 14.9173 12.3036 14.9643 12.1564C15.0114 12.0092 15.0991 11.8783 15.2172 11.7787L19.4573 8.24959C20.0144 7.78588 19.7269 6.86126 19.0111 6.81481L13.4738 6.45544C13.3247 6.44479 13.1816 6.39198 13.0613 6.30317C12.941 6.21437 12.8484 6.09321 12.7943 5.95382L10.7292 0.753229C10.673 0.605277 10.5732 0.477903 10.443 0.38802C10.3127 0.298137 10.1582 0.25 10 0.25C9.84176 0.25 9.68726 0.298137 9.55702 0.38802C9.42678 0.477903 9.32697 0.605277 9.27083 0.753229L7.20568 5.95382C7.15157 6.09321 7.05897 6.21437 6.93868 6.30317C6.81838 6.39198 6.67533 6.44479 6.52618 6.45544L0.98894 6.81481C0.273153 6.86126 -0.0144031 7.78588 0.542723 8.24959L4.78278 11.7787C4.90095 11.8783 4.9886 12.0092 5.03566 12.1564C5.08272 12.3036 5.08727 12.4611 5.0488 12.6108L3.78188 17.5945C3.56667 18.4412 4.46715 19.1246 5.19243 18.6651L9.58647 15.8812C9.71005 15.8025 9.85351 15.7607 10 15.7607C10.1465 15.7607 10.29 15.8025 10.4135 15.8812Z"
                                    fill="#FFBF00" />
                            </svg>
                        @endfor
                    </div>
                    <div class="">
                        <div class="average-rating-text">{{ $rating_details['average'] }}
                            {{ __('star_average_rating') }}</div>
                        <div class="average-rating-muted-text">{{ $rating_details['total'] }}
                            {{ __('people_written_reviews') }}
                        </div>
                    </div>
                </div>
            </div>
            @if ($user->id != auth()->id())
                <button class="review-btn ml--32" id="profile-review-button">
                    <svg width="20" height="20" viewBox="0 0 20 19" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.4135 15.8812L15.1419 18.8769C15.7463 19.2598 16.4967 18.6903 16.3173 17.9847L14.9512 12.6108C14.9127 12.4611 14.9173 12.3036 14.9643 12.1564C15.0114 12.0092 15.0991 11.8783 15.2172 11.7787L19.4573 8.24959C20.0144 7.78588 19.7269 6.86126 19.0111 6.81481L13.4738 6.45544C13.3247 6.44479 13.1816 6.39198 13.0613 6.30317C12.941 6.21437 12.8484 6.09321 12.7943 5.95382L10.7292 0.753229C10.673 0.605277 10.5732 0.477903 10.443 0.38802C10.3127 0.298137 10.1582 0.25 10 0.25C9.84176 0.25 9.68726 0.298137 9.55702 0.38802C9.42678 0.477903 9.32697 0.605277 9.27083 0.753229L7.20568 5.95382C7.15157 6.09321 7.05897 6.21437 6.93868 6.30317C6.81838 6.39198 6.67533 6.44479 6.52618 6.45544L0.98894 6.81481C0.273153 6.86126 -0.0144031 7.78588 0.542723 8.24959L4.78278 11.7787C4.90095 11.8783 4.9886 12.0092 5.03566 12.1564C5.08272 12.3036 5.08727 12.4611 5.0488 12.6108L3.78188 17.5945C3.56667 18.4412 4.46715 19.1246 5.19243 18.6651L9.58647 15.8812C9.71005 15.8025 9.85351 15.7607 10 15.7607C10.1465 15.7607 10.29 15.8025 10.4135 15.8812Z"
                            fill="white" />
                    </svg>
                    <span class="review-btn-text">{{ __('write_review') }}</span>
                </button>
            @endif
        </div>
        <div class="d-flex justify-content-between align-items-center active-ads mt-12-px">
            <div class="active-ads-amount">
                <span class="active-ads-amount-number">{{ $total_active_ad }}</span>
                <span class="active-ads-text">{{ __('active_ads') }}</span>
            </div>
            <div class=""><svg width="52" height="52" viewBox="0 0 52 52" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect width="52" height="52" rx="3" fill="white" />
                    <path d="M22 29H30" stroke="#00AAFF" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M22 25H30" stroke="#00AAFF" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M30.0002 15H35C35.2652 15 35.5196 15.1054 35.7071 15.2929C35.8946 15.4804 36 15.7348 36 16V37C36 37.2652 35.8946 37.5196 35.7071 37.7071C35.5196 37.8946 35.2652 38 35 38H17C16.7348 38 16.4804 37.8946 16.2929 37.7071C16.1054 37.5196 16 37.2652 16 37V16C16 15.7348 16.1054 15.4804 16.2929 15.2929C16.4804 15.1054 16.7348 15 17 15H21.9997"
                        stroke="#00AAFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M21 19V18C21 16.6739 21.5268 15.4021 22.4645 14.4645C23.4021 13.5268 24.6739 13 26 13C27.3261 13 28.5979 13.5268 29.5355 14.4645C30.4732 15.4021 31 16.6739 31 18V19H21Z"
                        stroke="#00AAFF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg></div>
        </div>
    </div>
</div>

@push('component_script')
    <script>
        $('#profile-review-button').on('click', function() {

            $('#review-tab').tab('show');
        });
    </script>
@endpush

@push('component_style')
    <style>
        .total-star {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 22px 19px;
            gap: 10px;
            width: 84px;
            height: 84px;
            background: #FFF8E0;
            border-radius: 3px;
        }
        @media (max-width:350px){
            .total-star{
                padding: 22px 12px;
            }
        }

        .d--flex {
            display: flex;
        }

        .dd--flex {
            display: flex;
        }

        @media (max-width:1199px) {
            .d--flex {
                display: block
            }

            .mt-12-px {
                margin-top: 12px !important;
            }
        }

        @media (max-width:770px) {
            .dd--flex {
                display: block !important;
            }

            .ml--32 {
                margin-left: 0 !important;
                margin-top: 12px !important;
            }
        }


        .total-star-text {
            width: 46px;
            height: 40px;
            font-family: 'Nunito Sans';
            font-style: normal;
            font-weight: 600;
            font-size: 32px;
            line-height: 40px;
            text-align: center;
            color: #191F33;
        }

        .average-rating-text {
            width: 178px;
            height: 24px;
            font-family: 'Nunito Sans';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            display: flex;
            align-items: center;
            text-transform: capitalize;
            color: #191F33;
        }

        .average-rating-muted-text {
            width: 198px;
            height: 20px;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            display: flex;
            align-items: center;
            color: #767E94;
        }

        .review-btn {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 0px 20px;
            gap: 8px;
            background: #00AAFF;
            border-radius: 4px;
        }

        .review-btn-text {
            font-family: 'Nunito Sans';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 50px;
            display: flex;
            align-items: center;
            text-align: center;
            text-transform: capitalize;
            color: #FFFFFF;
            content: "\a";
            white-space: pre;
        }

        .active-ads {
            padding: 16px;
            gap: 24px;
            width: 214px;
            height: 84px;
            background: #E8F7FF;
            border-radius: 6px;
        }


        .active-ads-amount {
            align-items: center;
            padding: 16px;
            gap: 24px;
            width: 214px;
            height: 84px;
            background: #E8F7FF;
            border-radius: 6px;
        }

        .active-ads-icon {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 10px;
            gap: 10px;
            width: 52px;
            height: 52px;
            background: #FFFFFF;
            border-radius: 3px;
        }

        .active-ads-amount-number {

            font-family: 'Nunito Sans';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 24px;
            display: flex;
            align-items: center;
            color: #191F33;
        }

        .active-ads-text {
            margin-top: 8px !important;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            color: #464D61;
        }

        .mb--24 {
            margin-bottom: 24px;
        }

        .p--24 {
            padding: 24px;
        }

        .ml--16 {
            margin-left: 16px;
        }

        .ml--32 {
            margin-left: 32px;
        }

        @media (max-width:991px) {
            .mt--24 {
                margin-top: 24px !important;
            }
        }
    </style>
@endpush
