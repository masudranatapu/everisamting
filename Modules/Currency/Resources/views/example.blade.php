@extends('admin.settings.setting-layout')
@section('title') {{ __('Currency Example') }} @endsection
@section('website-settings')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Currency Example') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <center>
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" width="50%" class="img-fluid mb-2 rounded" alt="white sample">
                    </center>
                    <div class="info-box-text text-center text-muted">{{ __('headphone') }} 1</div>
                    <div class="info-box-number text-center text-muted mb-0">
                        @currencyleft
                            <span>{{ defaultCurrencySymbol() }}11</span>
                        @else
                            <span>11{{ defaultCurrencySymbol() }}</span>
                        @endcurrencyleft
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <center>
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" width="50%" class="img-fluid mb-2 rounded" alt="white sample">
                    </center>
                    <div class="info-box-text text-center text-muted">{{ __('headphone') }} 2</div>
                    <div class="info-box-number text-center text-muted mb-0">
                        @currencyleft
                            <span>{{ defaultCurrencySymbol() }}234</span>
                        @else
                            <span>234{{ defaultCurrencySymbol() }}</span>
                        @endcurrencyleft
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
