@extends('filter_header')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
@section('content')
    <main>


        <p class="container margin_60" >
            <div class="main_title" style="background-color: white;">
                <p>
                <h2>{{ $specificLesson->terms }}</h2></p>
            </div>
            <div class="specific_lesson">
                @foreach ($lessonsWithFiles as $lesson)
                    <h2 style="margin-left: 30px; text-decoration: #0a0e14;"> {{ $lesson->title }}</h2>
                    <h4 style="margin-left: 30px;">{!! $lesson->description !!}</h4>
                   <center> <div class="video_player" >
                           <video
                               id="my-video"
                               class="video-js"
                               controls
                               preload="auto"
                               width="auto"
                               height="auto"
                               poster="../../../storage/css/site_logo.png"
                               data-setup="{}" style="border-radius: 10px;">
                               <source src="{{ asset('videos/' . $lesson->lessonFileText) }}" type="video/mp4" />
                               <p class="vjs-no-js" style="border-radius:4px;">
                                   <a href="https://videojs.com/html5-video-support/" target="_blank"
                                   >supports HTML5 video</a>
                               </p>
                           </video>

                           <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
                       </div></center>
                @endforeach
            </div>
        <div class="main_title">
            <h2>&nbsp;</h2>
        </div>
            </div>
    </main>
@endsection

