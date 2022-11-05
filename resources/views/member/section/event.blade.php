
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

                <a href="{{ route('member.eventDetails',[$event->id,$event->slug]) }}" class="going_btn">Going</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('style')
    <style>
        .event_box{
            width: 100%;
            min-height: 280px;
            height: auto;
        }
        .event_banner{
            min-height: 179px;
            height: auto;
        }
        .event_location{
            text-align:left;
        }

    </style>
@endpush
