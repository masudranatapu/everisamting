<div>
    @livewire('seller-review', ['user_id' => $user->id])
</div>

<style>
    .review-wrap {
        gap: 24px;
        margin-bottom: 32px;
    }

    .profile-img img {
        width: 88px;
        height: 88px;
        border-radius: 50%;
    }

    .review-info {
        max-width: 653px;
    }

    .review-info .rating {
        align-items: center;
        margin-bottom: 4px;
        gap: 4px;
    }

    .review-info .rating-amount {
        font-weight: 600;
        font-size: 14px;
        line-height: 1.43;
        display: flex;
        align-items: center;
        color: #191F33;
        margin-top: 3px;
    }

    .seller-details {
        padding: 0px;
        gap: 6px;
        margin-bottom: 8px;
    }

    .seller-details .name {
        font-weight: 600;
        font-size: 16px;
        line-height: 1.5;
        color: #191F33;
    }

    .seller-details .ads {
        font-weight: 400;
        font-size: 12px;
        line-height: 16px;
        color: #939AAD;
    }

    .seller-details .ads-text {
        font-weight: 400;
        font-size: 12px;
        line-height: 16px;
        color: #464D61;
    }

    .review-text {
        font-size: 16px;
        line-height: 1.5;
        color: #464D61;
    }

    .load-more {
        text-align: center;
    }

    .btn-load-more {
        background: #E8F7FF !important;
        border-radius: 4px !important;

    }

    .btn-load-more span {
        color: #00AAFF;
    }

    @media (max-width:767px) {

        .review-wrap,
        .seller-details {
            flex-direction: column;
        }
    }
</style>
