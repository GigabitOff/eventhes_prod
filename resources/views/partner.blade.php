@extends('layouts.filter')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
    <main>
        <div class="container margin_60" style="margin-top: -22px;">
            <!-- HTML-код для вкладок и их содержимого -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link " href="#wishlist">{{ __('translate.Wishlist') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#orders">{{ __('translate.Orders') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#data">{{ __('translate.Data') }}</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="wishlist" class="tab-pane fade">
                    <div class="row">
                        @if(!empty($events))
                            @foreach($events as $event)
                                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                                    <div class="tour_container">
                                        <!-- Перенесли вывод переменных из массива $event -->
                                        <div class="ribbon_3 popular">
                                            <span>{{ $event->discounte ? '- ' . $event->discounte . '%' : 'FREE' }}</span>
                                        </div>
                                        <div class="img_container">
                                            <a href="/{{$event->id}}" target="_blank">
                                                <!-- Использовали динамические данные из $event -->
                                                <img
                                                    src="{{ asset('files/' . $event->user_id . '/' . $event->foto_title) }}"
                                                    width="800" height="533" class="img-fluid" alt="Image">
                                                <div class="short_info">
                                                    <!-- Использовали динамические данные из $event -->
                                                    <i></i>{{$event->reserv}}<span
                                                        class="price">@if ($event->amount == 0 || $event->discounte === null)
                                                            FREE
                                                        @else
                                                            @php
                                                                $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                                            @endphp
                                            </span>
                                                    <span
                                                        style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}$</span><br>
                                                    {{ number_format($discountedAmount, 2) }}$
                                                    @endif</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tour_title">
                                            <h3>
                                                <strong>{{$event->title}}</strong></h3>
                                            <div class="parent-container"
                                                 style="display: flex; justify-content: flex-end;">
                                                <div class="rating">
                                                    <i style="font-size: 30px; color: #e14d67;  cursor: pointer;"
                                                       onclick="likeButtonClickedNo({{ $event->id }});">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                             fill="currentColor" class="bi bi-heart-fill"
                                                             viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                        </svg>
                                                    </i>
                                                </div><!-- end rating -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No events found</p>
                        @endif

                    </div>
                </div>
                <div id="orders" class="tab-pane fade show active">
                    {{--                    <table class="table">--}}
                    {{--                        <thead>--}}
                    {{--                        <tr>--}}
                    {{--                            <th scope="col">#</th>--}}
                    {{--                            <th scope="col">Code</th>--}}
                    {{--                            <th scope="col">Event</th>--}}
                    {{--                            <th scope="col">Имя</th>--}}
                    {{--                            <th scope="col">Дата заказа</th>--}}
                    {{--                            <th scope="col">Сумма</th>--}}
                    {{--                            <th scope="col">Status</th>--}}
                    {{--                        </tr>--}}
                    {{--                        </thead>--}}
                    {{--                        <tbody>--}}
                    {{--                        @foreach($orders as $order)--}}
                    {{--                            <tr>--}}
                    {{--                                <th scope="row">{{ $order->id }}</th>--}}
                    {{--                                <td>{{ $order->code }}</td>--}}
                    {{--                                <td>{{ $order->order_id}}</td>--}}
                    {{--                                <td>{{ $order->name }}</td>--}}
                    {{--                                <td>{{ $order->order_date }}</td>--}}
                    {{--                                <td>{{ $order->amount }}</td>--}}
                    {{--                                <td>{{ $order->status }}</td>--}}
                    {{--                            </tr>--}}
                    {{--                        @endforeach--}}
                    {{--                        </tbody>--}}
                    {{--                    </table>--}}
                    <section class="mb-3 mb-md-4 mt-2 mt-md-3">
                        <div class="container">
                            <div class="row align-items-end justify-content-between">
                                <div class="col-12 col-sm-auto">
                                    <h1 class="section-title mb-4">Ваші замовлення</h1>
                                </div>
                                <div class="col-12 col-sm-auto">
                                    <div class="mb-4 text-start text-sm-end">
                                        Ви накопичили <strong>442 грн</strong>
                                    </div>
                                    @if($use == NULL)
                                        <a class="btn btn-warning" id="buttonBonusModal" href="#" data-toggle="modal"
                                           data-target="#bonusModal">Получить Бонус !</a>
                                    @else
                                        <a class="btn btn-success" id="buttonBonusModalSucc">BONUS + (active)</a>
                                    @endif
                                </div>
                            </div>
                            <div class="gray-line mb-3 mb-lg-4"></div>
                            <div class="pb-3 pt-2">
                                @foreach($orders as $order)
                                    <div class="card card-body table-orders-card mb-3">
                                        <div class="row px-1">
                                            <div class="col-12 col-md-6 col-lg-10 px-2">
                                                <div class="ps-sm-3 ps-md-4 ps-lg-0">
                                                    <div class="d-none d-lg-block">
                                                        <div class="row align-items-center">
                                                            <div class="col-4 col-lg-2">
                                                                <p class="mb-2"><strong>Code</strong></p>
                                                            </div>
                                                            <div class="col-8 col-lg-6">
                                                                <p class="mb-2"><strong>Послуги</strong></p>
                                                            </div>
                                                            <div class="col-8 col-lg-2">
                                                                <p class="mb-2"><strong>Продавець</strong></p>
                                                            </div>
                                                            @if($order->event->user_orders->type_pay == 1)
                                                                <div class="col-6 col-lg-2">
                                                                    <p class="mb-2"><strong>Всього</strong></p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center">
                                                        <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                                            <p class="mb-0 gray-text">
                                                                <strong></strong><br>{{ $order->code }}</p>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                                            <p class="mb-1 d-lg-none"><strong>Послуги</strong></p>
                                                            <div class="mb-0">
                                                                <table class="table table-striped table-sm mb-0">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="align-middle">
                                                                            {{ $order->event->title }}
                                                                        </td>
                                                                        <td class="align-middle"
                                                                            style="white-space: nowrap;">шт
                                                                        </td>
                                                                        <td class="align-middle"
                                                                            style="white-space: nowrap;">{{ $order->amount }}</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row align-items-center">
                                                                <div class="col-4 col-lg-2">
                                                                    <p class="mb-2"><strong><a class="btn btn-warning" onclick="">BONUS-</a></strong></p>
                                                                </div>
                                                               <span>------</span>
                                                                <div class="col-8 col-lg-6">
                                                                    <p class="mb-2"><strong><a class="btn btn-primary" onclick="">BONUS+</a></strong></p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                                                            <p class="mb-0"><a
                                                                    style="text-decoration: underline; font-weight: bold;"
                                                                    href="/search?what=&rng=&rng2=&cat=&salesman={{$order->event->user_orders->id}}"
                                                                    target="_blank">{{$order->event->user_orders->name}}</a>
                                                            </p>
                                                        </div>
                                                        @if($order->event->user_orders->type_pay == 1)
                                                            <div class="col-12 col-lg-2 mb-0">
                                                                <p class="d-inline-block mb-0 old-price">
                                                                    <strong>1330</strong> грн</p>
                                                                <p class="mb-0 new-price"><strong>888</strong> грн</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3 col-lg-2 px-2 text-center pt-4 pt-md-0">
                                                <div
                                                    class="d-flex flex-column align-items-center justify-content-center h-100">
                                                    @if($order->event->user_orders->type_pay == 1)
                                                        <a class="btn btn-primary" onclick="">Списать %</a>
                                                    @endif
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-toggle="modal" data-bs-target="#cancelModal4">
                                                        Скасувати
                                                    </button>
                                                    <a class="btn btn-danger" onclick="">Видалити</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <script>
                                    Share = {
                                        facebook: function (purl, ptitle, pimg, text) {
                                            url = 'http://www.facebook.com/sharer.php?s=100';
                                            url += '&p[title]=' + encodeURIComponent(ptitle);
                                            url += '&p[summary]=' + encodeURIComponent(text);
                                            url += '&p[url]=' + encodeURIComponent(purl);
                                            url += '&p[images][0]=' + encodeURIComponent(pimg);
                                            Share.popup(url);
                                        },
                                        popup: function (url) {
                                            window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
                                        }
                                    };
                                </script>
                            </div>
                        </div>
                    </section>
                </div>
                <div id="data" class="tab-pane fade">
                    <div class="row">
                        @if(!empty($ordersdata))
                            @foreach($ordersdata as $ord)
                                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                                    <div class="tour_container">
                                        <div class="ribbon_3 popular">
                                            <span>{{ $event->discounte ? '- ' . $event->discounte . '%' : 'FREE' }}</span>
                                        </div>
                                        <div class="img_container">
                                            <a href="/open/{{$ord->id}}" target="_blank">
                                                <img
                                                    src="{{ asset('files/' . $ord->user_id . '/' . $ord->foto_title) }}"
                                                    width="800" height="533" class="img-fluid" alt="Image">
                                                <div class="short_info">
                                                    <i></i>{{$ord->reserv}}<span class="price">@if ($event->amount == 0 || $event->discounte === null)
                                                            FREE
                                                        @else
                                                            @php
                                                                $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                                            @endphp
                                            </span>
                                                    <span
                                                        style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}$</span><br>
                                                    {{ number_format($discountedAmount, 2) }}$
                                                    @endif</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tour_title">
                                            <h3>
                                                <strong>{{$ord->title}}</strong></h3>
                                            <div class="parent-container"
                                                 style="display: flex; justify-content: flex-end;">
                                                <div class="rating">
                                                    <a href="/open/{{$ord->id}}" target="_blank"
                                                       class="btn btn-success">Open</a>
                                                </div>
                                            </div>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            @if(!empty($ordersdata))
                                                <tr>
                                                    <th scope="col">Данные:</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($userDataRecords as $data)
                                                <tr>
                                                    <th scope="row">{!!$data->settings !!}</th>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No events found</p>
                        @endif
                    </div>
                </div>
                <div id="message" class="tab-pane fade">
                    Not message ...
                </div>
            </div>
        </div><!-- End container -->

    </main>
@endsection
<script>
    $(document).ready(function () {
        $('.nav-link').click(function (event) {
            event.preventDefault();
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            var tab_id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('show active');
            $(tab_id).addClass('show active');
        });
    });

    function likeButtonClickedNo(eventId) {
        fetch('/likeno', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Исправлено для получения токена CSRF
            },
            body: JSON.stringify({event_id: eventId})
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.removeItem('likedEventId', eventId);
                    alert('Like removed!');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    window.onscroll = function () {
        scrollFunction()
    };

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

</script>
