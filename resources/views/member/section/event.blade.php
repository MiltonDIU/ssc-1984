@if(auth()->id()===2)

@foreach($events as $event)
    <div class="event_box_main">
        <div class="event_box school_event_box">
            @if($event->banner)
                @php
                    $url =$event->banner->getUrl();
                @endphp
            @else
                @php
                    $url = 'assets/alumni/images/gray.png';
                @endphp
            @endif
            <div class="event_banner" style="background: url({{ url($url) }});">
                <div class="event_date">
                    <p class="day"> {{ date('j ', strtotime($event->event_date))  }}</p>
                    <p class="month">{{ date('M ', strtotime($event->event_date))  }}</p>
                </div>

                <div class="event_details">
                    <p class="event_title">{{ $event->name }}</p>
                    <p class="event_title">{{ $event->event_category->name }}</p>
                    <p class="event_location">{{ $event->address }}</p>
                </div>
            </div>
            <div class="going_box">
                <div class="participant_box">
                    <p>Going</p>
                    <div class="participant_img_count">
                        @foreach($event->lastFiveusers as $user)
                            <div class="participant_img ml_negative">
                                @if($user->avatar)
                                    <img src="{{ $user->avatar->getUrl('thumb') }}" alt="{{ $user->name }}">
                                @else
                                    <img src="{{ url('assets/alumni/images/gray.png') }}" alt=" {{ $user->id }}">
                                @endif
                            </div>
                        @endforeach
                        <div class="participant_img participant_count ml_negative">
                            <p>{{ count($event->users) }}</p>
                        </div>
                    </div>
                </div>
                <div class="going_btn_box">
                    @if(\App\Models\EventUser::checkEventRegistration($event->id)==false)
                        <a href="{{ route('member.eventDetails',[$event->id,$event->slug]) }}"
                           class="going_btn">Going</a>
                    @else
                        <a href="#" class="going_btn">You already going</a>

                        @if(\App\Models\EventUser::getRegisterUser($event->id)!=false)
                            @php
                                $registerUser = \App\Models\EventUser::getRegisterUser($event->id);

                                $amount = $registerUser->amount + $registerUser->spouse_amount + $registerUser->driver_amount;
                            @endphp
                        @endif
                        @if($registerUser->payment_status==0)

                            <form method="POST" action="{{ route('event-payment') }}">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="event_user_id" value="{{ $registerUser->event_user_id }}">
                                <input type="hidden" name="user_id" value="{{ $registerUser->user_id }}">
                                <input type="hidden" name="event_id" value="{{ $registerUser->event_id }}">
                                <input type="hidden" name="currency" value="BDT">
                                <button class="going_btn" style="background-color: orangered" type="submit">Make
                                    Payment
                                </button>
                            </form>
                        @else
                            <a class="going_btn" style="background-color: orangered">Your Payment Done</a>

                        @endif

                    @endif

                </div>
            </div>
        </div>
    </div>
@endforeach

@push('style')
    <link rel="stylesheet" href="{{ url('assets/alumni/css/custom.css') }}">
@endpush
@endif
