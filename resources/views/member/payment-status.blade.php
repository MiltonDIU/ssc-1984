@extends('member.layouts.master')

@section('content')


    <div class="event_box_main">
        <div class="event_box school_event_box">

    <div class="data_table">
        <table class="table table-borderless table-hover">
            <thead class="datalist_heading">
            <tr>
                <th scope="col">Event Name</th>
                <th scope="col">Payment Status</th>

            </tr>
            </thead>

            <tbody>

            @foreach($eventUsers as $ventUser)
                <tr>
                    <td class="data_name">
                        {{  $ventUser->event?$ventUser->event->name:""}}
                    </td>
                    <td>
                        @if($ventUser->payment_status=='1')
                            {{ "Paid" }}
                        @else
                            {{ "Unpaid" }}
                        @endif
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
        </div>
    </div>
@endsection
@push('script')
    @parent

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.searchable-field').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route("member.schoolSearch") }}',
                    dataType: 'json',
                    type: 'GET',
                    delay: 200,
                    data: function (term) {
                        return {
                            search: term
                        };
                    },
                    results: function (data) {
                        return {
                            data
                        };
                    }
                },
                escapeMarkup: function (markup) { return markup; },
                templateResult: formatItem,
                templateSelection: formatItemSelection,
                placeholder : '{{ trans('global.search') }}...',
                language: {
                    inputTooShort: function(args) {
                        var remainingChars = args.minimum - args.input.length;
                        var translation = '{{ trans('global.search_input_too_short') }}';

                        return translation.replace(':count', remainingChars);
                    },
                    errorLoading: function() {
                        return '{{ trans('global.results_could_not_be_loaded') }}';
                    },
                    searching: function() {
                        return '{{ trans('global.searching') }}';
                    },
                    noResults: function() {
                        return '{{ trans('global.no_results') }}';
                    },
                }

            });
            function formatItem (item) {
                if (item.loading) {
                    return '{{ trans('global.searching') }}...';
                }
                var markup = "<div class='searchable-link' href='" + item.url + "'>";
                markup += "<div class='searchable-title'>" + item.model + "</div>";
                $.each(item.fields, function(key, field) {
                    markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
                });
                markup += "</div>";

                return markup;
            }

            function formatItemSelection (item) {
                if (!item.model) {
                    return '{{ trans('global.search') }}...';
                }
                return item.model;
            }
            $(document).delegate('.searchable-link', 'click', function() {
                var url = $(this).attr('href');
                window.location = url;
            });
        });

    </script>
@endpush

@push('style')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/alumni/css/custom.css') }}">

@endpush
