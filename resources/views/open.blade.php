
@extends('filter_header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('content')
    <main>
        <div class="container margin_60" style="margin-top: 70px;">
            <div class="main_title">
                <p>Your lessons</p>
            </div>
            <div class="tab-content" style="padding: 30px;
    background-color: #fff;
    margin-bottom: 2px;
    border: 0px solid #ffffff;">
                @foreach ($lessonRecords as $lesson)
                    <div class="row">
                        <!-- Здесь выводим содержимое каждого урока -->
                        <div class="col-md-12">
                            <a href="/open/{{$lesson->events_id}}/lesson/{{$lesson->id}}" style="display: flex; align-items: center; text-decoration: underline; color: #dea929;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-folder-fill" viewBox="0 0 16 16">
                                    <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a2 2 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3m-8.322.12q.322-.119.684-.12h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981z"/>
                                </svg>
                                <h4 style="margin: 0; color: #41444f;">{{ $lesson->terms}}</h4>
                            </a>
                        </div>

                    </div>
                @endforeach

            </div>

        </div><!-- End container -->

    </main>
@endsection

