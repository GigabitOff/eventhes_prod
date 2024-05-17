@extends('layouts.filter')
@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container" >
        <div class="row justify-content-center">
            <div class="container margin_60">
                <div class="row">
                    <aside class="col-lg-3">
                        <form action="{{ route('search') }}" method="GET" >
                            <div id="filters_col">
                                <input name="what" class="form-control" aria-describedby="emailHelp" placeholder="Search">
                                <div class="collapse show">
                                    <div class="filter_type">
                                        <label for="category">{{ __('translate.Select category') }}:</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="">{{ __('translate.All') }}</option>
                                            <option value="4">{{ __('translate.Goods') }}</option>
                                            <option value="2">{{ __('translate.Services') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="content"></div>
                                <script>
                                    $(document).ready(function() {
                                        $('#category').change(function() {
                                            var category = $(this).val();
                                            var url = '';

                                            switch(category) {
                                                case '3':
                                                    url = '/category/event';
                                                    break;
                                                case '2':
                                                    url = '/category/trade';
                                                    break;
                                                case '1':
                                                    url = '/category/courses';
                                                    break;
                                            }
                                            if (url) {
                                                $.ajax({
                                                    url: url,
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    type: 'get',
                                                    success: function(response) {
                                                        $('#content').html(response);
                                                        // Добавляем код для переключения содержимого
                                                        toggleContent(); // Вызываем функцию после загрузки контента
                                                    }
                                                });
                                            }
                                        });

                                        // Функция для переключения содержимого
                                        function toggleContent() {
                                            document.getElementById('toggleLink').addEventListener('click', function(event) {
                                                event.preventDefault(); // Предотвращаем стандартное поведение ссылки
                                                var content = document.getElementById('toggleContent');
                                                if (content.style.display === 'none') {
                                                    content.style.display = 'block';
                                                    this.textContent = 'Close';
                                                } else {
                                                    content.style.display = 'none';
                                                    this.textContent = 'Раскрыть';
                                                }
                                            });
                                        }
                                    });
                                </script>
                                <div class="form-group">
                                    <label for="category">{{ __('translate.Select region') }}:</label>
                                    <select class="form-control" id="regionSelect" onchange="sendAjaxRequest(this.value)">
                                        @foreach ($regions as $region)
                                            <option value="{{ substr($region->code, 0, 2) }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="townSelectContainer" style="display: none;">
                                    <label for="town">{{ __('translate.Select town') }}:</label>
                                    <select name="town" class="form-control" id="townSelect">
                                    </select>
                                </div>
                                <div class="collapse show" >
                                    <div class="filter_type">
                                        <h6>{{ __('translate.Price') }} $ From <output id="ong">0</output> - To <output id="ong2">10000</output></h6>
                                        <input id="rng" name="rng" type="range" min="1" max="10000" value="0">
                                       <input id="rng2" name="rng2" type="range" min="1" max="10000" value="10000">
                                    </div>
                                </div>
                                <span>&nbsp;</span>
                                <a href="#" onclick="updateHiddenFieldsAndSubmit(); return false;" style="text-decoration: none; margin-top:20px; " class="btn_map mb-2">{{ __('translate.Send') }}</a>

                            </div>
                        </form>
                        <script>
                            function updateHiddenFieldsAndSubmit() {
                                var whatValue = $('input[name="what"]').val();
                                var rngValue = $("#rng").val();
                                var rng2Value = $("#rng2").val();
                                var category = $("#category").val();

                                // Записываем значения в скрытые поля
                                $("#hiddenWhat").val(whatValue);
                                $("#hiddenRng").val(rngValue);
                                $("#hiddenRng2").val(rng2Value);
                                var newUrl = "{{ route('search') }}" + "?" + $.param({ what: whatValue, rng: rngValue, rng2: rng2Value, cat:category });
                                window.location.href = newUrl;
                            }
                            $(function() {
                                $("#rng").on("input", function() {
                                    $("#ong").text($(this).val());
                                });

                                $("#rng2").on("input", function() {
                                    $("#ong2").text($(this).val());
                                });
                            });
                        </script>
                        <!--End filters col-->
                        <div class="box_style_2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                            </svg>
                            <h4>Need <span>Help?</span></h4><a href="tel://+970599593301"style="font-size: 12px;" class="phone">+38(099)217-5697</a>
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
                                <div class="col-lg-4 col-md-4">
                                    <div class="ribbon_3 popular"> <span>{{ $event->discounte ? '- ' . $event->discounte . '%' : 'FREE' }}</span>
                                    </div>
                                    <div class="img_list">
                                        <a href="/{{$event->id}}">
                                            <img
                                                src="{{ asset('files/' . $event->user_id . '/' . $event->foto_title) }}"
                                                alt="Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="tour_list_desc">
                                        <div class="rating">
                                            <div class="rating">
                                                @for ($i = 0; $i < mt_rand(1, 7); $i++)
                                                    <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                                        </svg></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <a href="http://eventhes.com/tours/galata-tower" class="tour_title"><img src="https://eventhes.com/storage/files/ua.png" alt="Flag" style="vertical-align: middle; width: 5%;"><strong>{{$event->title}}</strong></a>
                                        @if($event->shedule)
                                            <p style="width: 100%; white-space: nowrap; overflow: hidden; font-weight: bold; border-radius: 5px; background-color: #eeeeee;">{{ $event->shedule->reserv }}</p>
                                        @else
                                            <p>No schedule available</p>
                                        @endif
                                        <span>
                                        @if ($event->town)
                                                м.{{ $event->town->name }}
                                            @else
                                                On-Line
                                            @endif
                                        </span>
                                        <p>{!! $event->phone !!}</p>
                                        <i style="font-size: 30px; cursor: pointer;" onclick="likeButtonClicked({{ $event->id }});"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg></i>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="price_list" style="font-size: small;">
                                        <div>
                                            <span>
                                                @if ($event->amount == 0 || $event->discounte === null)
                                                    FREE
                                                @else
                                                    @php
                                                        $discountedAmount = $event->amount - ($event->amount * $event->discounte / 100);
                                                        $currencySymbols = [
                                                            '0' => '$',
                                                            '1' => '₽',
                                                            '2' => '€',
                                                            '3' => '₴',
                                                            '4' => 'Zł',
                                                        ];
                                                        $currencySymbol = $currencySymbols[$event->currency] ?? ''; // Получаем символ валюты из массива
                                                    @endphp
                                                    <span style="color:#989fa6;font-size: smaller; text-decoration: line-through;">{{ number_format($event->amount, 2) }}{{ $currencySymbol }}</span><br>
                                                    {{ number_format($discountedAmount, 2) }}{{ $currencySymbol }}
                                                @endif
                                                </span>
                                            <span class="normal_price_list"></span>
                                            <small>*{{ __('translate.Per person') }}</small>
                                            <p><a href="/{{$event->id}}" class="btn_1" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                                    </svg> {{ __('translate.Details') }}</a></p>
                                            <p><a href="/{{$event->id}}" type="button" data-toggle="modal" data-target="#bonusProgramModal"  style="text-decoration: none; color: #ffffff; background-color: #eaad14; padding: 10px 20px; border-radius: 5px; display: inline-block;" class="btn_1" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                                                    </svg> BONUS</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <style>.pagination {
                                display: inline-block;
                                padding-left: 0;
                                margin: 20px 0;
                                border-radius: 4px;
                            }

                            .pagination > li {
                                display: inline;
                            }

                            .pagination > li > a,
                            .pagination > li > span {
                                position: relative;
                                float: left;
                                padding: 6px 12px;
                                margin-left: -1px;
                                line-height: 1.42857143;
                                color: #000000;
                                text-decoration: none;
                                background-color: #fff;
                                border: 1px solid #ddd;
                            }

                            .pagination > li:first-child > a,
                            .pagination > li:first-child > span {
                                margin-left: 0;
                                border-top-left-radius: 4px;
                                border-bottom-left-radius: 4px;
                            }

                            .pagination > li:last-child > a,
                            .pagination > li:last-child > span {
                                border-top-right-radius: 4px;
                                border-bottom-right-radius: 4px;
                            }

                            .pagination > li > a:hover,
                            .pagination > li > span:hover,
                            .pagination > li > a:focus,
                            .pagination > li > span:focus {
                                z-index: 2;
                                color: #000000;
                                background-color: #eee;
                                border-color: #ddd;
                            }

                            .pagination > .active > a,
                            .pagination > .active > span,
                            .pagination > .active > a:hover,
                            .pagination > .active > span:hover,
                            .pagination > .active > a:focus,
                            .pagination > .active > span:focus {
                                z-index: 3;
                                color: #fff;
                                background-color: #565a5c;;
                                border-color: #565a5c;;
                                cursor: default;
                            }
                        </style>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                @if ($events->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">{{ __('translate.Previous') }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $events->previousPageUrl() }}">{{ __('translate.Previous') }}</a></li>
                                @endif
                                @for ($i = 1; $i <= $events->lastPage(); $i++)
                                    @if ($i == $events->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor
                                @if ($events->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $events->nextPageUrl() }}">{{ __('translate.Next') }}</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">{{ __('translate.Next') }}</span></li>
                                @endif
                            </ul>
                        </nav>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Наверх">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up-circle"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
        </svg>
    </button>
@endsection

<script>
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

    function likeButtonClicked(eventId) {
        fetch('/like', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({event_id: eventId})
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

</script>
<script>

    function regionSet(value) {
        var regionId = value;
        $.ajax({
            url: "{{ route('cities.by.region', ['region' => ':regionId']) }}".replace(':regionId', regionId),
            method: 'GET',
            success: function (response) {
                // Очищаем текущий список городов
                $('#citySelect').empty();

                // Добавляем новые города в список
                $.each(response, function (key, value) {
                    $('#citySelect').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>
<script>
    function regionSet(value) {
        var regionId = value;
        $.ajax({
            url: "{{ route('cities.by.region', ['region' => ':regionId']) }}".replace(':regionId', regionId),
            method: 'GET',
            success: function (response) {
                $('#citySelect').empty();
                $.each(response, function (key, value) {
                    $('#citySelect').append($('<option>', {
                        value: value.id,
                        text: value.name
                    }));
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
    function sendAjaxRequest(regionCodePrefix) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.ajax({
            url: '/admin/events/st/' + regionCodePrefix,
            type: 'POST',
            dataType: 'json',
            success: function(response) {
                $('#townSelectContainer').show();
                var townSelect = $('#townSelect');
                townSelect.empty();
                response.sort(function(a, b) {
                    var nameA = a.name.toLowerCase();
                    var nameB = b.name.toLowerCase();
                    if (nameA < nameB) return -1;
                    if (nameA > nameB) return 1;
                    return 0;
                });
                $.each(response, function(index, town) {
                    townSelect.append('<option value="' + town.id + '">' + town.name + '</option>');
                });
                townSelect.select2({
                    placeholder: 'Выберите город или начните вводить...',
                    allowClear: true
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

</script>













