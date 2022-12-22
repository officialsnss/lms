@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} |  {{$course->title}} @endsection

@section('css')
    <style>
        iframe {
            position: relative !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}"/>
    <link rel="stylesheet" href="{{asset('public/frontend/infixlmstheme/css/quiz_details.css')}}"/>
@endsection


@section('mainContent')

    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->quiz_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap width_730px">
                        <h3>
                            {{$course->title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- quiz__details::start  -->
    <div class="quiz__details">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="row">
                        <div class="col-12">
                            <div class="quiz_test_wrapper mb_60">
                                <div class="quiz_test_header">
                                    <h3> {{$course->quiz->title}}</h3>
                                </div>
                                <div class="quiz_test_body">

                                    <ul class="quiz_test_info">

                                        @php
                                            $timer =0;
                                      if(!empty($quizSetup->time_total_question)){
                                          $timer=$quizSetup->time_total_question;
                                      }else{
                                         $timer= $quizSetup->time_per_question*count($course->quiz->assign);
                                      }
                                        @endphp
                                        <li>
                                            <span>{{__('frontend.Questions')}} <span>:</span></span>{{count($course->quiz->assign)}}
                                            {{__('frontend.Question')}}.
                                        </li>
                                        <li>
                                            <span>{{__('frontend.Duration')}}   <span>:</span></span> {{$timer}} {{__('frontend.Question')}}
                                            ({{ $quizSetup->time_per_question}} {{__('frontend.minutes time limit per question')}}
                                            .)
                                        </li>
                                    </ul>
                                    @if (Auth::check() && $isEnrolled)
                                        @if($alreadyJoin == 0 || $quizSetup->multiple_attend == 1)
                                            <a href="{{route('quizStart',[$course->id,$course->quiz->id,$course->title])}}"
                                               class="theme_btn mr_15 m-auto mt-4 text-center"
                                            >{{__('frontend.Start Quiz')}}</a>
                                        @endif
                                        @if($alreadyJoin == 1 && $certificate)
                                            <a href="{{route('getCertificate',[$course->id,$course->title])}}"
                                               class="theme_line_btn mr_15 m-auto mt-4  text-center">
                                                {{__('frontend.Get Certificate')}}
                                            </a>
                                        @endif
                                    @else

                                        @if($isFree)
                                            @if($is_cart == 1)
                                                <a href="javascript:void(0)"
                                                   class="theme_btn text-center height_50 mb_10">{{__('common.Added To Cart')}}</a>
                                            @else
                                                <a href="{{route('addToCart',[@$course->id])}}"
                                                   class="theme_btn text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                            @endif
                                        @else
                                            <a href="{{route('buyNow',[@$course->id])}}"
                                               class="theme_btn mr_15 m-auto mt-4 text-center"
                                            >{{__('frontend.Buy Now')}}</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8">
                            <div class="course_tabs">
                                <ul class="w-100 nav lms_tabmenu mb_55" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview"
                                           role="tab" aria-controls="Overview"
                                           aria-selected="true">{{__('frontend.Overview')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews"
                                           role="tab" aria-controls="Reviews"
                                           aria-selected="false">{{__('frontend.Reviews')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="QA-tab" data-toggle="tab" href="#QASection"
                                           role="tab" aria-controls="Instructor"
                                           aria-selected="false">{{__('frontend.QA')}}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content lms_tab_content" id="myTabContent">
                                <div class="tab-pane fade show active " id="Overview" role="tabpanel"
                                     aria-labelledby="Overview-tab">
                                    <!-- content  -->
                                    <div class="course_overview_description">
                                        <div class="single_overview">
                                            <h4 class="font_22 f_w_700 mb_20">{{__('frontend.Instructions')}}</h4>
                                            <div class="theme_border"></div>
                                            <p class="mb_25">  {{$course->quiz->instruction}} </p>

                                        </div>
                                    </div>
                                    <!--/ content  -->
                                </div>
                                <div class="tab-pane fade " id="Reviews" role="tabpanel" aria-labelledby="Reviews-tab">
                                    <!-- content  -->
                                    <div class="course_review_wrapper">
                                        <div class="details_title">
                                            <h4 class="font_22 f_w_700">{{__('frontend.Student Feedback')}}</h4>
                                            <p class="font_16 f_w_400">{{$course->title}}</p>
                                        </div>
                                        <div class="course_feedback">
                                            <div class="course_feedback_left">
                                                <h2>{{$course->totalReview}}</h2>
                                                <div class="feedmak_stars">
                                                    @php

                                                        $main_stars=$course->totalReview;

                                                        $stars=intval($course->totalReview);

                                                    @endphp
                                                    @for ($i = 0; $i <  $stars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @if ($main_stars>$stars)
                                                        <i class="fas fa-star-half"></i>
                                                    @endif
                                                    @if($main_stars==0)
                                                        @for ($i = 0; $i <  5; $i++)
                                                            <i class="far fa-star"></i>
                                                        @endfor
                                                    @endif
                                                </div>
                                                <span>{{__('frontend.Course Rating')}}</span>
                                            </div>
                                            <div class="feedbark_progressbar">
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->starWiseReview,5)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->starWiseReview,5)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->starWiseReview,5)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->starWiseReview,4)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->starWiseReview,4)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->starWiseReview,4)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->starWiseReview,3)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->starWiseReview,3)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>

                                                        </div>
                                                        <span>{{getPercentageRating($course->starWiseReview,3)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->starWiseReview,2)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->starWiseReview,2)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->starWiseReview,2)}}%</span>
                                                    </div>
                                                </div>
                                                <div class="single_progrssbar">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{getPercentageRating($course->starWiseReview,1)}}%"
                                                             aria-valuenow="{{getPercentageRating($course->starWiseReview,1)}}"
                                                             aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <div class="rating_percent d-flex align-items-center">
                                                        <div class="feedmak_stars d-flex align-items-center">
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span>{{getPercentageRating($course->starWiseReview,1)}}%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="course_review_header mb_20">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="review_poients">
                                                        @if ($course->reviews->count()<1)
                                                            @if (Auth::check() && $isEnrolled)
                                                                <p class="theme_color font_16 mb-0">{{ __('frontend.Be the first reviewer') }}</p>
                                                            @else

                                                                <p class="theme_color font_16 mb-0">{{ __('frontend.No Review found') }}</p>
                                                            @endif

                                                        @else


                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="rating_star text-right">

                                                        @php
                                                            $PickId=$course->id;
                                                        @endphp
                                                        @if (Auth::check() && Auth::user()->role_id==3)
                                                            @if (!in_array(Auth::user()->id,$reviewer_user_ids) && $isEnrolled)


                                                                <div
                                                                    class="star_icon d-flex align-items-center justify-content-end">
                                                                    <a class="rating">
                                                                        <input type="radio" id="star5" name="rating"
                                                                               value="5"
                                                                               class="rating"/><label
                                                                            class="full" for="star5" id="star5"
                                                                            title="Awesome - 5 stars"
                                                                            onclick="Rates(5, {{@$PickId }})"></label>

                                                                        <input type="radio" id="star4" name="rating"
                                                                               value="4"
                                                                               class="rating"/><label
                                                                            class="full" for="star4"
                                                                            title="Pretty good - 4 stars"
                                                                            onclick="Rates(4, {{@$PickId }})"></label>

                                                                        <input type="radio" id="star3" name="rating"
                                                                               value="3"
                                                                               class="rating"/><label
                                                                            class="full" for="star3"
                                                                            title="Meh - 3 stars"
                                                                            onclick="Rates(3, {{@$PickId }})"></label>

                                                                        <input type="radio" id="star2" name="rating"
                                                                               value="2"
                                                                               class="rating"/><label
                                                                            class="full" for="star2"
                                                                            title="Kinda bad - 2 stars"
                                                                            onclick="Rates(2, {{@$PickId }})"></label>

                                                                        <input type="radio" id="star1" name="rating"
                                                                               value="1"
                                                                               class="rating"/><label
                                                                            class="full" for="star1"
                                                                            title="Bad  - 1 star"
                                                                            onclick="Rates(1,{{@$PickId }})"></label>

                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @else

                                                            <p class="font_14 f_w_400 mt-0"><a href="{{url('login')}}"
                                                                                               class="theme_color2">{{__('frontend.Sign In')}}</a>
                                                                {{__('frontend.or')}} <a
                                                                    class="theme_color2"
                                                                    href="{{url('register')}}">{{__('frontend.Sign Up')}}</a>
                                                                {{__('frontend.as student to post a review')}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="course_cutomer_reviews">
                                            <div class="details_title">
                                                <h4 class="font_22 f_w_700">{{__('frontend.Reviews')}}</h4>

                                            </div>
                                            <div class="customers_reviews" id="customers_reviews">


                                            </div>
                                        </div>

                                        <div class="author_courses">
                                            <div class="section__title mb_80">
                                                <h3>{{__('frontend.Course you might like')}}</h3>
                                            </div>
                                            <div class="row">
                                                @foreach(@$related as $r)
                                                    <div class="col-xl-6">
                                                        <div class="couse_wizged mb_30">
                                                            <div class="thumb">
                                                                <a href="{{courseDetailsUrl(@$r->id,@$r->type,@$r->slug)}}">
                                                                    <img class="w-100"
                                                                         src="{{ file_exists($r->thumbnail) ? asset($r->thumbnail) : asset('public/\uploads/course_sample.png') }}"
                                                                         alt="">
                                                                    <span class="prise_tag">
                                                                                                                                @if (@$r->discount_price!=null)
                                                                            {{getPriceFormat($r->discount_price)}}
                                                                        @else
                                                                            {{getPriceFormat($r->price)}}
                                                                        @endif
                                                                                                                           </span>
                                                                </a>
                                                            </div>
                                                            <div class="course_content">
                                                                <a href="{{courseDetailsUrl(@$r->id,@$r->type,@$r->slug)}}">
                                                                    <h4>{{@$r->title}}</h4>
                                                                </a>
                                                                <div class="rating_cart">
                                                                    <div class="rateing">
                                                                        <span>{{$r->totalReview}}/5</span>
                                                                        <i class="fas fa-star"></i>
                                                                    </div>
                                                                    @auth()
                                                                        @if(!$r->isLoginUserEnrolled && !$r->isLoginUserCart)
                                                                            <a href="#" class="cart_store"
                                                                               data-id="{{$r->id}}">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endauth
                                                                    @guest()
                                                                        @if(!$r->isGuestUserCart)
                                                                            <a href="#" class="cart_store"
                                                                               data-id="{{$r->id}}">
                                                                                <i class="fas fa-shopping-cart"></i>
                                                                            </a>
                                                                        @endif
                                                                    @endguest
                                                                </div>
                                                                <div class="course_less_students">
                                                                    <a href="#"> <i
                                                                            class="ti-agenda"></i> {{count($r->lessons)}}
                                                                        {{__('frontend.Lessons')}}</a>
                                                                    <a href="#"> <i
                                                                            class="ti-user"></i> {{$r->total_enrolled}}
                                                                        {{__('frontend.Students')}} </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- content  -->
                                </div>


                                <div class="tab-pane fade " id="QASection" role="tabpanel" aria-labelledby="QA-tab">
                                    <!-- content  -->

                                    <div class="conversition_box">
                                        <div id="conversition_box"></div>

                                        <div class="row">
                                            @if ($isEnrolled)
                                                <div class="col-lg-12 " id="mainComment">
                                                    <form action="{{route('saveComment')}}" method="post" class="">
                                                        @csrf
                                                        <input type="hidden" name="course_id" value="{{@$course->id}}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="section_title3 mb_20">
                                                                    <h3>{{__('frontend.Leave a question/comment') }}</h3>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="single_input mb_25">
                                                                                        <textarea
                                                                                            placeholder="{{__('frontend.Leave a question/comment') }}"
                                                                                            name="comment"
                                                                                            class="primary_textarea gray_input"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 mb_30">

                                                                <button type="submit"
                                                                        class="theme_btn height_50">
                                                                    <i class="fas fa-comments"></i>
                                                                    {{__('frontend.Question') }}/
                                                                    {{__('frontend.comment') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <div class="sidebar__widget mb_30">
                                <div class="sidebar__title">
                                    <h3>
                                        @if (@$course->discount_price!=null)

                                            {{getPriceFormat($course->discount_price)}}
                                        @else
                                            {{getPriceFormat($course->price)}}
                                        @endif
                                    </h3>
                                    <p>
                                        @if (Auth::check() && $isBookmarked )
                                            <i class="fas fa-heart"></i>
                                            <a href="{{route('bookmarkSave',[$course->id])}}"
                                               class=" mr_10 sm_mb_10">{{__('frontend.Already Bookmarked')}}
                                            </a>
                                        @elseif (Auth::check() && !$isBookmarked )
                                            <a href="{{route('bookmarkSave',[$course->id])}}"
                                               class="">
                                                <i
                                                    class="far fa-heart"></i>
                                                {{__('frontend.Add To Bookmark')}}  </a>
                                    @endif
                                </div>
                                @if (Auth::check())
                                    @if ($isEnrolled)
                                        <a href="#"
                                           class="theme_btn d-block text-center height_50 mb_10">{{__('common.Already Enrolled')}}</a>
                                    @else
                                        @if($isFree)
                                            @if($is_cart == 1)
                                                <a href="javascript:void(0)"
                                                   class="theme_btn d-block text-center height_50 mb_10">{{__('common.Added To Cart')}}</a>
                                            @else
                                                <a href="{{route('addToCart',[@$course->id])}}"
                                                   class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                            @endif
                                        @else
                                            <a href=" {{route('addToCart',[@$course->id])}} "
                                               class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                            <a href="{{route('buyNow',[@$course->id])}}"
                                               class="theme_line_btn d-block text-center height_50 mb_20">{{__('common.Buy Now')}}</a>
                                        @endif
                                    @endif

                                @else
                                    @if($isFree)
                                        <a href=" {{route('addToCart',[@$course->id])}} "
                                           class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                    @else
                                        <a href=" {{route('addToCart',[@$course->id])}} "
                                           class="theme_btn d-block text-center height_50 mb_10">{{__('common.Add To Cart')}}</a>
                                        <a href="{{route('buyNow',[@$course->id])}}"
                                           class="theme_line_btn d-block text-center height_50 mb_20">{{__('common.Buy Now')}}</a>
                                    @endif
                                @endif
                                <h4 class="f_w_700 mb_10">{{__('frontend.This course includes')}}:</h4>
                                <ul class="course_includes">
                                    <li><i class="ti-thumb-up"></i>
                                        <p>{{__('frontend.Skill Level')}}
                                            @foreach($levels as $level)
                                                @if (@$course->level==$level->id)
                                                    {{ $level->title}}
                                                @endif
                                            @endforeach
                                        </p>
                                    </li>
                                    <li><i class="ti-agenda"></i>
                                        <p>{{__('frontend.Questions')}} {{count($course->quiz->assign)}} </p></li>
                                    <li><i class="ti-user"></i>
                                        <p>{{__('frontend.Enrolled')}} {{$course->total_enrolled}} {{__('frontend.students')}}</p>
                                    </li>
                                    <li><i class="ti-user"></i>
                                        <p>{{__('frontend.Certificate of Completion')}}</p></li>
                                    <li><i class="ti-blackboard"></i>
                                        <p>{{__('frontend.Full lifetime access')}}</p></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal cs_modal fade admin-query" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('frontend.Course Review') }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><i
                            class="ti-close "></i></button>
                </div>

                <form action="{{route('submitReview')}}" method="Post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="course_id" id="rating_course_id"
                               value="">
                        <input type="hidden" name="rating" id="rating_value" value="">

                        <div class="text-center">
                                                                <textarea class="lms_summernote" name="review" id=""
                                                                          placeholder="{{__('frontend.Write your review') }}"
                                                                          cols="30"
                                                                          rows="10">{{old('review')}}</textarea>
                            <span class="text-danger" role="alert">{{$errors->first('review')}}</span>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <div class="mt-40 d-flex justify-content-between">
                            <button type="button" class="theme_line_btn mr-2"
                                    data-dismiss="modal">{{ __('common.Cancel') }}
                            </button>
                            <button class="theme_btn "
                                    type="submit">{{ __('common.Submit') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include(theme('partials._delete_model'))
@endsection

@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme') }}/js/html2pdf.bundle.js"></script>
    <script src="{{ asset('public/frontend/infixlmstheme/js/quiz_details.js') }}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
    <script>


        $("#formSubmitBtn").on("click", function (e) {
            e.preventDefault();

            var form = $('#deleteCommentForm');
            var url = form.attr('action');
            var element = form.data('element');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {

                }
            });
            var el = '#' + element;
            $(el).hide('slow');
            $('#deleteComment').modal('hide');

        });
    </script>

    <script>
        function deleteCommnet(item, element) {
            let form = $('#deleteCommentForm')
            form.attr('action', item);
            form.attr('data-element', element);
        }
    </script>


    <script>

        var SITEURL = "{{courseDetailsUrl($course->id,$course->type,$course->slug)}}";
        var page = 1;
        load_more(page);
        $(window).scroll(function () { //detect page scroll
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
                page++;
                load_more(page);
            }


        });

        function load_more(page) {
            $.ajax({
                url: SITEURL + "?page=" + page,
                type: "get",
                datatype: "html",
                data: {'type': 'comment'},
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
                    $("#conversition_box").append(data); //append data into #results element


                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });

        }


        load_more_review(page);


        $(window).scroll(function () { //detect page scroll
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
                page++;
                load_more_review(page);
            }


        });

        function load_more_review(page) {
            $.ajax({
                url: SITEURL + "?page=" + page,
                type: "get",
                datatype: "html",
                data: {'type': 'review'},
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
                    $("#customers_reviews").append(data); //append data into #results element


                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('No response from server');
                });

        }
    </script>
@endsection
