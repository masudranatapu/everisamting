<div class="product-item__sidebar-item user-details">
    <div class="d-flex justify-content-between">
        <div class="user">
            <div class="img">
                @if ($customer->image)
                    <img src="{{ asset($customer->image) }}" alt="">
                @else
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/59/User-avatar.svg/1024px-User-avatar.svg.png"
                        alt="user-photo"/>
                @endif
            </div>
            <div class="info">
                <span class="text--body-4">{{ __('added_by') }}:</span>
                <h2 class="text--body-3-600"> {{ $customer->username }} </h2>
            </div>
        </div>
        <a href="{{ route('frontend.seller.profile', $customer->username) }}">View Profile</a>
    </div>
    <ul class="contact">
        @if ($customer->show_email == 1)
            <li class="contact-item">
                <span class="icon">
                    <x-svg.envelope-icon/>
                </span>
                <h6 class="text--body-3">{{ $customer->email }}</h6>
            </li>
        @endif
        @if(isset($ad->address))
            <li class="contact-item">
            <span class="icon">
                <x-svg.address-icon/>
            </span>
                <h6 class="text--body-3 text-capitalize">{{ $ad->address }}</h6>
            </li>
        @endif
        @if (!is_null($link))
            <li class="contact-item">
                <span class="icon">
                    <x-svg.globe-icon/>
                </span>
                <a target="_blank" href="{{ $link }}" class="text--body-3">
                    {{ $link }}
                    <span class="icon">
                        <x-svg.target-blank-icon/>
                    </span>
                </a>
            </li>
        @endif
    </ul>
</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('frontend.mail.to.customer') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $customer->email }}" name="customer_email">
            <input type="hidden" value="{{ $customer->name }}" name="customer_name">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Send mail to customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="mb-2">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="subject" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="mt-2">Message</label>
                            <textarea name="message" class="form-control" cols="30" rows="10" style="height: 200px;"
                                      placeholder="Message" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-secondary" data-bs-dismiss="modal"
                            style="border: 0;">Close
                    </button>
                    <button type="submit" class="btn btn-primary" style="border: 0;">Mail Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
