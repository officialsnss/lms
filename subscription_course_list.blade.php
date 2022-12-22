@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.Subscription')}} @endsection
@section('css') @endsection


@section('mainContent')

    <style>


        .section_tittle {
            text-align: center;
            margin-bottom: 50px;
        }

        @media (max-width: 991px) {
            .section_tittle {
                margin-bottom: 40px;
            }
        }

        @media only screen and (min-width: 991px) and (max-width: 1200px) {
            .section_tittle {
                margin-bottom: 50px;
            }
        }

        .section_tittle h2 {
            font-size: 28px;
            margin-bottom: 11px;
            line-height: 1.5;
        }

        @media (max-width: 991px) {
            .section_tittle h2 {
                margin-bottom: 15px;
                font-size: 25px;
            }
        }

        @media (max-width: 991px) {
            .section_tittle h2 {
                font-size: 30px;
            }
        }


        .pricing_plan .single_pricing_plan {
            border: 1px solid #e8e8e8;
            border-radius: 5px;
            text-align: center;
            padding: 40px 20px 36px;
            margin: 10px;
        }

        @media (max-width: 768px) {
            .pricing_plan .single_pricing_plan {
                margin-bottom: 20px;
            }
        }

        .pricing_plan .single_pricing_plan h5 {
            font-size: 28px;
            font-weight: 600;
            color: var(--system_primery_color);
            /*margin-bottom: 18px;*/
        }

        .pricing_plan .single_pricing_plan h2 {
            font-size: 50px;
            font-weight: 600;
            position: relative;
            padding-left: 15px;
            display: inline-block;
            margin-bottom: 2px;
        }

        .pricing_plan .single_pricing_plan h2 span {
            font-size: 20px;
            position: absolute;
            left: 0;
            top: -1px;
        }

        .pricing_plan .single_pricing_plan p a {
            color: #8f8f8f;
            text-decoration: underline;
        }

        .pricing_plan .single_pricing_plan .theme_btn small_btn2 {
            margin: 26px 0 16px;
        }


        .list_style {
            /*margin-top: 30px;*/
        }

        .list_style h5 {
            background-color: #f6f8fa;
            font-size: 20px;
            margin-bottom: 0;
            padding: 18px 30px;
            border-radius: 5px 5px 0 0;
        }

        .list_style h5 span {
            font-size: 12px;
            font-weight: 500;
            color: #8f8f8f;
            margin-left: 5px;
        }

        .list_style ul {
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px 30px;
            border: 1px solid #e8e8e8;
            border-radius: 0 0 5px 5px;
        }

        .list_style ul li {
            list-style: none;
            flex: 48% 0 0;
            color: var(--system_secendory_color);
            margin: 7px 0;
        }

        @media (max-width: 768px) {
            .list_style ul li {
                flex: 100% 0 0;
            }
        }

        .list_style ul li i {
            margin-right: 10px;
            color: var(--system_primery_color);
        }

        .theme_according .card .card-header button.collapsed {
            padding: 12px 26px 10px 30px;
        }

        .mb_100 {
            margin-bottom: 100px;
        }

        .mt_100 {
            margin-top: 100px;
        }

        .pb_100 {
            padding-bottom: 100px;
        }

        .pt_100 {
            padding-top: 100px;
        }

        .single_pricing_plan a {
            font-size: 16px;
            font-weight: 500;
            line-height: 35px;
            font-family: "Jost", sans-serif;
        }


        .single_pricing_plan a:hover {
            color: var(--system_primery_color);
        }
    </style>
    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->subscription_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                        <span>
                            {{@$frontendContent->subscription_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->subscription_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--

    <div class="contact_section ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12">
                    <div class="contact_address">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">


                                        <section class="pricing_plan pt_100   bg-white">
                                            <div class="container">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        <div class="section_tittle">
                                                            <h2>{{__('subscription.Pricing Plan & Package')}}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">

                                                </div>


                                            </div>
                                        </section>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
--}}


    <div class="courses_area">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section_tittle">
                                <h2>{{__('subscription.Plan')}}: {{$plan->title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(isset($lists))
                            @foreach ($lists as $list)
                                @php
                                $course =$list->course;
                                @endphp
                                <div class="col-lg-4 col-xl-3">

                                    @if($course->type==1)
                                        <div class="couse_wizged">
                                            <div class="thumb">
                                                <div class="thumb_inner lazy" data-src="{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}">

<span class="prise_tag">
                  @if (@$course->discount_price!=null)
        {{getPriceFormat($course->discount_price)}}
    @else
        {{getPriceFormat($course->price)}}
    @endif
</span>

                                                </div>

                                            </div>
                                            <div class="course_content">
                                                <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                    <h4 class="noBrake" title="{{$course->title}}">
                                                        {{$course->title}}
                                                    </h4>
                                                </a>
                                                <div class="rating_cart">
                                                    <div class="rateing">
                                                        <span>{{$course->totalReview}}/5</span>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    @auth()
                                                        @if(!$course->isLoginUserEnrolled && !$course->isLoginUserCart)
                                                            <a href="#" class="cart_store"
                                                               data-id="{{$course->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <div class="course_less_students">
                                                    <a>
                                                        <i class="ti-agenda"></i> {{count($course->lessons)}} {{__('student.Lessons')}}
                                                    </a>
                                                    <a>
                                                        <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($course->type==2)
                                        <div class="quiz_wizged">
                                            <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                <div class="thumb">
                                                    <div class="thumb_inner lazy" data-src="{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}">

<span class="prise_tag">
                  @if (@$course->discount_price!=null)
        {{getPriceFormat($course->discount_price)}}
    @else
        {{getPriceFormat($course->price)}}
    @endif
</span>


                                                    </div>
                                                    <span class="quiz_tag">{{__('quiz.Quiz')}}</span>
                                                </div>
                                            </a>
                                            <div class="course_content">
                                                <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                    <h4 class="noBrake"
                                                        title="{{$course->title}}"> {{$course->title}}</h4>
                                                </a>
                                                <div class="rating_cart">
                                                    <div class="rateing">
                                                        <span>{{$course->totalReview}}/5</span>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    @auth()
                                                        @if(!$course->isLoginUserEnrolled && !$course->isLoginUserCart)
                                                            <a href="#" class="cart_store"
                                                               data-id="{{$course->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <div class="course_less_students">

                                                    <a>
                                                        <i class="ti-agenda"></i>  {{count($course->quiz->assign)}}
                                                        {{__('student.Question')}}</a>
                                                    <a>
                                                        <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    @elseif($course->type==3)
                                        <div class="quiz_wizged">
                                            <div class="thumb">
                                                <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                    <div class="thumb">
                                                        <div class="thumb_inner lazy" data-src="{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}">

<span class="prise_tag">
                  @if (@$course->discount_price!=null)
        {{getPriceFormat($course->discount_price)}}
    @else
        {{getPriceFormat($course->price)}}
    @endif
</span>


                                                        </div>
                                                        <span class="live_tag">{{__('student.Live')}}</span>
                                                    </div>
                                                </a>


                                            </div>
                                            <div class="course_content">
                                                <a href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}">
                                                    <h4 class="noBrake"
                                                        title="{{$course->title}}"> {{$course->title}}</h4>
                                                </a>
                                                <div class="rating_cart">
                                                    <div class="rateing">
                                                        <span>{{$course->totalReview}}/5</span>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    @auth()
                                                        @if(!$course->isLoginUserEnrolled && !$course->isLoginUserCart)
                                                            <a href="#" class="cart_store"
                                                               data-id="{{$course->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <div class="course_less_students">
                                                    <a> <i
                                                            class="ti-agenda"></i> {{$course->class->total_class}}
                                                        {{__('student.Classes')}}</a>
                                                    <a>
                                                        <i class="ti-user"></i> {{$course->total_enrolled}} {{__('student.Students')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @endif
                        @if(count($lists)==0)

                                <div class="col-lg-12">
                                    <div class="Nocouse_wizged text-center d-flex align-items-center justify-content-center">
                                        <h1>
                                            <div class="thumb">
                                                <img style="width: 50px"
                                                     src="{{ asset('public/frontend/infixlmstheme') }}/img/not-found.png"
                                                     alt="">
                                                {{__('frontend.No Course Found')}}
                                            </div>

                                        </h1>
                                    </div>
                                </div>

                        @endif
                    </div>

                    {{ $lists->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
