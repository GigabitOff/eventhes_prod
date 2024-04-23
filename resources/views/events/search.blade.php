
@extends('layouts.filter')
@section('content')
    <div class="container" style="margin-top: 75px;">
        <div class="row justify-content-center">
            <div class="container margin_60">
                    <div class="row">
                        <aside class="col-lg-3">
{{--                            <p>--}}
{{--                                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false"--}}
{{--                                   aria-controls="collapseMap" data-text-swap="Hide map"--}}
{{--                                   data-text-original="View on map">--}}
{{--                                    {{ __('translate.View on map') }} </a>--}}
{{--                            </p>--}}
                            <div id="filters_col">
                                <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false"
                                   aria-controls="collapseFilters" id="filters_col_bt"><i
                                        class="icon_set_1_icon-65"></i>
                                    {{ __('translate.Filters') }} </a>
                                <div class="collapse show" id="collapseFilters">
                                    <div class="filter-type">

                                        <input type="text" class="form-control" id="firstname_booking" name="term"
                                               value="" placeholder="Search by name, description ...">
                                    </div>
                                    <div class="filter_type">
                                        <h6>Price</h6>
                                        <span class="irs js-irs-0 irs-with-grid"><span class="irs"><span
                                                    class="irs-line" tabindex="0"><span
                                                        class="irs-line-left"></span><span
                                                        class="irs-line-mid"></span><span class="irs-line-right"></span></span><span
                                                    class="irs-min"
                                                    style="display: none; visibility: hidden;">0</span><span
                                                    class="irs-max" style="display: none; visibility: visible;">1</span><span
                                                    class="irs-from"
                                                    style="visibility: visible; left: -1.84706%;">$0</span><span
                                                    class="irs-to"
                                                    style="visibility: visible; left: 56.2432%;">$100</span><span
                                                    class="irs-single" style="visibility: hidden; left: 19.5611%;">$0 — $100</span></span><span
                                                class="irs-grid" style="width: 91.2759%; left: 4.26205%;"><span
                                                    class="irs-grid-pol" style="left: 0%"></span><span
                                                    class="irs-grid-text js-grid-text-0"
                                                    style="left: 0%; margin-left: -3.26131%;">0</span><span
                                                    class="irs-grid-pol small" style="left: 20%"></span><span
                                                    class="irs-grid-pol small" style="left: 15%"></span><span
                                                    class="irs-grid-pol small" style="left: 10%"></span><span
                                                    class="irs-grid-pol small" style="left: 5%"></span><span
                                                    class="irs-grid-pol" style="left: 25%"></span><span
                                                    class="irs-grid-text js-grid-text-1"
                                                    style="left: 25%; visibility: visible; margin-left: -4.58697%;">38</span><span
                                                    class="irs-grid-pol small" style="left: 45%"></span><span
                                                    class="irs-grid-pol small" style="left: 40%"></span><span
                                                    class="irs-grid-pol small" style="left: 35%"></span><span
                                                    class="irs-grid-pol small" style="left: 30%"></span><span
                                                    class="irs-grid-pol" style="left: 50%"></span><span
                                                    class="irs-grid-text js-grid-text-2"
                                                    style="left: 50%; visibility: visible; margin-left: -4.4268%;">75</span><span
                                                    class="irs-grid-pol small" style="left: 70%"></span><span
                                                    class="irs-grid-pol small" style="left: 65%"></span><span
                                                    class="irs-grid-pol small" style="left: 60%"></span><span
                                                    class="irs-grid-pol small" style="left: 55%"></span><span
                                                    class="irs-grid-pol" style="left: 75%"></span><span
                                                    class="irs-grid-text js-grid-text-3"
                                                    style="left: 75%; visibility: visible; margin-left: -4.79144%;">113</span><span
                                                    class="irs-grid-pol small" style="left: 95%"></span><span
                                                    class="irs-grid-pol small" style="left: 90%"></span><span
                                                    class="irs-grid-pol small" style="left: 85%"></span><span
                                                    class="irs-grid-pol small" style="left: 80%"></span><span
                                                    class="irs-grid-pol" style="left: 100%"></span><span
                                                    class="irs-grid-text js-grid-text-4"
                                                    style="left: 100%; margin-left: -5.53776%;">150</span></span><span
                                                class="irs-bar" style="left: 4.36205%; width: 60.8506%;"></span><span
                                                class="irs-shadow shadow-from" style="display: none;"></span><span
                                                class="irs-shadow shadow-to" style="display: none;"></span><span
                                                class="irs-slider from" style="left: 0%;"></span><span
                                                class="irs-slider to type_last"
                                                style="left: 60.8506%;"></span></span><input type="text" id="range"
                                                                                             name="price" value=""
                                                                                             data-from="0" data-to="100"
                                                                                             class="irs-hidden-input"
                                                                                             tabindex="-1" readonly="">
                                    </div>
                                </div>
                                <!--End collapse -->
                            </div>
{{--                            <a type="submit" onclick="document.forms['filtersForm'].submit(); return false;"--}}
{{--                               class="btn_map mb-2">--}}
{{--                                <input type="submit" class="d-none">--}}
{{--                                {{ __('translate.Filters') }} </a>--}}
                            <!--End filters col-->
                            <div class="box_style_2">
                                <i class="icon_set_1_icon-57"></i>
                                <h4>Need <span>Help?</span></h4>    <a href="tel://+970599593301" style="font-size: 12px;" class="phone">+38(099)217-5697</a>
                                <small>Monday to Friday 9.00am - 7.30pm</small>
                            </div>
                        </aside>
                        <!--End aside -->
                        <div class="col-lg-9">
                            <div id="tools">
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-6">
                                    </div>
                                    <div class="col-md-6 col-sm-4 d-none d-sm-block text-right ml-auto">
                                      <span style="font-size: 20px;">{{ __('translate.All events') }} 23 789</span>
                                    </div>

                                </div>
                            </div>
                            @foreach($events as $event)
                                <span>&nbsp;</span>
                                <div class="row" style="min-height:233px; border: 1px solid #dddddd; border-radius: 5px;">
                                    <div class="col-lg-4 col-md-4" >
                                        <div class="ribbon_3 popular"><span>{{ $event->discounte ? '- ' . $event->discounte . '%' : 'FREE' }}</span>
                                        </div>
                                        <div class="img_list">
                                            <a href="http://eventhes.com/tours/galata-tower">
                                                <img src="{{ asset('storage/files/' . $event->user_id . '/' . $event->foto_title) }}" alt="Image">
                                            </a>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6" >
                                        <div class="tour_list_desc">
                                            <div class="rating">
                                                <i class="icon-smile "></i>
                                                <i class="icon-smile "></i>
                                                <i class="icon-smile "></i>
                                                <i class="icon-smile "></i>
                                                <i class="icon-smile "></i>
                                            </div>
                                            <a href="http://eventhes.com/tours/galata-tower" class="tour_title"><strong>{{$event->title}}</strong></a>
                                            <p>{!! $event->short_description!!}</p>
                                            <i style="font-size: 30px; cursor: pointer;" onclick="likeButtonClicked({{ $event->id }});"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                </svg></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2">
                                        <div class="price_list">
                                            <div>
                                                   <span>@if ($event->amount == 0 || $event->discounte === null)
                                                           FREE
                                                       @else
                                                           @php
                                                               $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                                           @endphp
                                            </span>
                                                <span style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}$</span><br>
                                                {{ number_format($discountedAmount, 2) }}$
                                                @endif</span>
                                                <span class="normal_price_list"></span>
                                                <small>*{{ __('translate.Per person') }}</small>
                                                <p><a href="/{{$event->id}}" class="btn_1" target="_blank">{{ __('translate.Details') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
{{--                            <div id="test"></div>--}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <style>
        #scrollToTopBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 99;
            border: none;
            outline: none;
            background-color: #565a5c;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Наверх"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
        </svg></button>
@endsection
<script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }

    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    function likeButtonClicked(eventId) {
        fetch('/like', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ event_id: eventId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.setItem('likedEventId', eventId);
                    alert('Added like!');
                } else {
                    // Обработка ошибки
                    alert('Error!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    let lastEventId = {{ $events->last()->id ?? 0 }};
    let loading = false;
    let noMoreEvents = false;

    function loadMoreEvents() {
        if (loading || noMoreEvents) return;
        loading = true;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', `/load-more-events/${lastEventId}`, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                const html = data.html;
                noMoreEvents = data.noMoreEvents;

                const container = document.getElementById('test');
                container.insertAdjacentHTML('beforeend', html);

                if (noMoreEvents) {
                    window.removeEventListener('scroll', loadMoreEvents);
                } else {
                    lastEventId = container.lastElementChild.dataset.id;
                    loading = false;
                }
            } else {
                console.error('Request failed.  Returned status of ' + xhr.status);
                loading = false;
            }
        };

        xhr.send();
    }
    window.addEventListener('scroll', () => {
        const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 100) {
            loadMoreEvents();
        }
    });
    document.addEventListener('DOMContentLoaded', loadMoreEvents);
</script>






