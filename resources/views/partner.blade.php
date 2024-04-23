
@extends('layouts.filter')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
    <main>
        <div class="container margin_60" style="margin-top: 50px;">
            <div class="main_title">
                <p>{{ __('translate.Your cabinet') }}</p>
            </div>
            <!-- HTML-код для вкладок и их содержимого -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#wishlist">{{ __('translate.Wishlist') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#orders">{{ __('translate.Orders') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#data">{{ __('translate.Data') }}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="wishlist" class="tab-pane fade show active">
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
                                                <img src="{{ asset('files/' . $event->user_id . '/' . $event->foto_title) }}"
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
                                                    <span style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}$</span><br>
                                                    {{ number_format($discountedAmount, 2) }}$
                                                @endif</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tour_title">
                                            <h3>
                                                <strong>{{$event->title}}</strong></h3>
                                            <div class="parent-container" style="display: flex; justify-content: flex-end;">
                                                <div class="rating">
                                                    <i  style="font-size: 30px; color: #e14d67;  cursor: pointer;"
                                                       onclick="likeButtonClickedNo({{ $event->id }});"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                                        </svg></i>
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
                <div id="orders" class="tab-pane fade">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Code</th>
                            <th scope="col">Event</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Дата заказа</th>
                            <th scope="col">Сумма</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->order_id}}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                                                <img src="{{ asset('files/' . $ord->user_id . '/' . $ord->foto_title) }}"
                                                     width="800" height="533" class="img-fluid" alt="Image">
                                                <div class="short_info">
                                                    <i></i>{{$ord->reserv}}<span class="price">@if ($event->amount == 0 || $event->discounte === null)
                                                                FREE
                                                            @else
                                                                @php
                                                                    $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                                                @endphp
                                            </span>
                                                    <span style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}$</span><br>
                                                    {{ number_format($discountedAmount, 2) }}$
                                                @endif</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tour_title">
                                            <h3>
                                                <strong>{{$ord->title}}</strong></h3>
                                            <div class="parent-container" style="display: flex; justify-content: flex-end;">
                                                <div class="rating">
                                                    <a href="/open/{{$ord->id}}" target="_blank" class="btn btn-success">Open</a>
                                                </div><!-- end rating -->
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
    $(document).ready(function(){
        // Обработчик клика по ссылкам вкладок
        $('.nav-link').click(function(){
            // Удаляем класс 'active' со всех ссылок вкладок
            $('.nav-link').removeClass('active');
            // Добавляем класс 'active' только к нажатой ссылке
            $(this).addClass('active');
            // Получаем идентификатор вкладки из атрибута href и скрываем только предыдущую активную вкладку
            var tab_id = $(this).attr('href');
            $('.tab-content .tab-pane').removeClass('show active');
            // Показываем только выбранную вкладку
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
                    sessionStorage.removeItem('likedEventId', eventId); // Изменено на удаление из sessionStorage
                    alert('Like removed!'); // Изменено сообщение
                } else {
                    alert(data.message); // Вывод сообщения из ответа сервера
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

</script>
