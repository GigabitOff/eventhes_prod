@extends('layouts.filter')
@section('content')
    <div class="container" style="margin-top: 75px;">
        <div class="row justify-content-center">
            <div class="container margin_60">
                <div class="row">
                    <aside class="col-lg-3">
{{--                        <p>--}}
{{--                            <a class="btn_map" data-toggle="collapse" style="text-decoration: none;" href="#collapseMap" aria-expanded="false"--}}
{{--                               aria-controls="collapseMap" data-text-swap="Hide map"--}}
{{--                               data-text-original="View on map">--}}
{{--                                {{ __('translate.View on map') }} </a>--}}
{{--                        </p>--}}
                        <!--End filters col-->
                        <div class="box_style_2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                            </svg>
                            <h4>Need <span>Help?</span></h4>
                            <?php
                            if (isset($phone) && $phone != "") {
                                echo "<a href=\"tel:+38{$phone}\" class=\"phone\">+38{$phone}</a>";
                            }
                            ?>
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
                            <span>&nbsp;</span>
                            <div class="row" style="min-height:233px; border: 1px solid #dddddd; border-radius: 5px;">
                                <div class="col-lg-4 col-md-4">
                                    <div class="ribbon_3 popular"><span>{{ __('translate.Popular') }}</span>
                                    </div>
                                    <div class="img_list">
                                        <a href="">
                                            <img
                                                src=""
                                                alt="Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="tour_list_desc">
                                        <div class="rating">
                                            <i class="icon-smile "></i>
                                            <i class="icon-smile "></i>
                                            <i class="icon-smile "></i>
                                            <i class="icon-smile "></i>
                                            <i class="icon-smile "></i>
                                        </div>
                                        <a href="http://eventhes.com/tours/galata-tower" class="tour_title"><strong></strong></a>

                                        <p></p>
                                        <i style="font-size: 30px; cursor: pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg></i>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <div class="price_list">
                                        <div>
                                            <span class="normal_price_list"></span>
                                            <small>*{{ __('translate.Per person') }}</small>
                                            <p><a href="" class="btn_1" target="_blank">{{ __('translate.Details') }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button onclick="scrollToTop()" id="scrollToTopBtn" title="Наверх">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-up-circle"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
        </svg>
    </button>
@endsection

