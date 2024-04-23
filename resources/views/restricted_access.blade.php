
@extends('layouts.filter')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
    <main>
        <div class="container margin_60" style="margin-top: 60px;">
            <div class="main_title">
                <p>{{ __('translate.Select type users') }}</p>
            </div>
            <!-- HTML-код для вкладок и их содержимого -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#wishlist">Type</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="wishlist" class="tab-pane fade show active">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">User</option>
                        <option value="2">Partner</option>
                    </select>
                </div>
                <div id="orders" class="tab-pane fade">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Фамилия</th>
                            <th scope="col">Обращение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
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
</script>
