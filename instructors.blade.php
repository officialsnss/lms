@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.Instructor')}} @endsection
@section('css')
    <style>


        .ajax-loading {
            text-align: center;
            width: 250px;
        }
    </style>
@endsection
@section('js')
    <script>

        var SITEURL = "{{route('instructors')}}";
        var page = 1;
        load_more(page);
        $(window).scroll(function () { //detect page scroll
            // console.log($(window).scrollTop());
            // console.log($(window).height());
            // console.log($(document).height());


            console.log($(window).scrollTop());
            console.log($(window).height());
            console.log($("#results").height());
            if($(window).scrollTop() + $(window).height() >= $(document).height()-600) {
                page++;
                load_more(page);
            }


        });

        function load_more(page) {
            $.ajax({
                url: SITEURL + "?page=" + page,
                type: "get",
                datatype: "html",
                beforeSend: function () {
                    $('.ajax-loading').show();
                }
            })
                .done(function (data) {
                    if (data.length == 0) {
                        console.log(data.length);
                        //notify user if nothing to load
                        $('.ajax-loading').html("No more records!");
                        return;
                    }
                    $('.ajax-loading').hide(); //hide loading animation once data is received
                    $("#results").append(data); //append data into #results element


                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });

        }
    </script>

@endsection

@section('mainContent')
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->instructor_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->instructor_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->instructor_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->
    <!-- instractors_wrapper::start  -->
    <div class="instractors_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="section__title2 mb_76">
                        <span>{{__('frontend.Popular Instructors')}}</span>
                        <h4>{{__('frontend.Making sure that our products exceed customer expectations')}}
                            <br>{{__('frontend.for quality, style and performance')}}.</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                @if(isset($instructors))
                    @foreach($instructors->take(4) as $instructor)

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="single_instractor mb_30">
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}"
                                   class="thumb">
                                    <img src="{{getInstructorImage($instructor->image)}}" alt="">
                                </a>
                                <a href="{{route('instructorDetails',[$instructor->id,Str::slug($instructor->name,'-')])}}">
                                    <h4>{{$instructor->name}}</h4></a>
                                <span>{{$instructor->headline}}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- instractors_wrapper::end  -->

    <!-- instractors_wrapper::start  -->
    <div class="instractors_wrapper instractors_wrapper2">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section__title2 mb_76">
                        <span>{{__('frontend.Meet Our world-class instructors')}}</span>
                        <h4>{{__('frontend.We are here to meet your demand and teach the most beneficial way for you in Personal')}}
                            .</h4>
                    </div>
                </div>
            </div>
            <div class="row" id="results">
                <div class="ajax-loading">

                    <svg version="1.1" id="L4" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100"
                         enable-background="new 0 0 0 0" xml:space="preserve"> <circle fill="#7c32ff" stroke="none"
                                                                                       cx="6" cy="50" r="6">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite"
                                     begin="0.1"></animate>
                        </circle>
                        <circle fill="#7c32ff" stroke="none" cx="26" cy="50" r="6">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite"
                                     begin="0.2"></animate>
                        </circle>
                        <circle fill="#7c32ff" stroke="none" cx="46" cy="50" r="6">
                            <animate attributeName="opacity" dur="1s" values="0;1;0" repeatCount="indefinite"
                                     begin="0.3"></animate>
                        </circle>
                        </svg>

                </div>


            </div>
        </div>
    </div>
    <!-- instractors_wrapper::end  -->

    <!-- CTA::START  -->
    <div class="cta_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-1">
                    <div class="section__title white_text">
                        <h3 class="large_title">{{__('frontend.Become a Instructor')}}.</h3>
                        <p>{{__('frontend.Teach what you love. Corrector gives you the tools to create a course')}}.</p>
                        <a href="{{route('becomeInstructor')}}"
                           class="theme_btn small_btn">{{__('frontend.Start Teaching')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CTA::END  -->
@endsection
