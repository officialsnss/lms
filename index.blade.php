@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontendmanage.Home')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')


    @foreach($blocks as $block)

        @if($block->id==1)
            @if($homeContent->show_banner_section==1)
                <!-- BANNER::START  -->
                <form action="{{route('search')}}">
                    <div class="banner_area"
                         @if(isset($homeContent->slider_banner) && !empty($homeContent->slider_banner))
                         style="background-image: url('{{asset(@$homeContent->slider_banner)}}')"
                        @endif>
                        <div class="container">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-9 offset-lg-1">
                                    <div class="banner_text">
                                        <h3>{{@$homeContent->slider_title}}</h3>
                                        <p>{{@$homeContent->slider_text}}</p>
                                        @if(@$homeContent->show_banner_search_box==1)
                                            <div class="input-group theme_search_field large_search_field">
                                                <div class="input-group-prepend">
                                                    <button class="btn" type="button" id="button-addon2"><i
                                                            class="ti-search"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="query" class="form-control"
                                                       placeholder="{{__('frontend.Search for course, skills and Videos')}}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- BANNER::END  -->
            @endif
        @elseif($block->id==3)
            @if($homeContent->show_category_section==1)
                <!-- CATEGORY::START  -->
                <div class="category_area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                @if(isset($homeContent))
                                    @if($homeContent->show_key_feature==1)

                                        <div class="couses_category">
                                            <div class="row">


                                                <div class="col-xl-4 col-md-4">
                                                    <div class="single_course_cat">
                                                        <div class="icon">
                                                            @if(!empty($homeContent->key_feature_logo1))
                                                                <img
                                                                    src="{{asset($homeContent->key_feature_logo1)}}"
                                                                    alt="">
                                                            @endif
                                                        </div>
                                                        <div class="course_content">
                                                            <h4>
                                                                @if(!empty($homeContent->feature_link1))<a
                                                                    href="{{$homeContent->feature_link1}}"> @endif
                                                                    {{$homeContent->key_feature_title1}}
                                                                    @if(!empty($homeContent->feature_link1))   </a> @endif
                                                            </h4>
                                                            <p>{{$homeContent->key_feature_subtitle1}} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4">
                                                    <div class="single_course_cat">
                                                        <div class="icon">
                                                            @if(!empty($homeContent->key_feature_logo2))
                                                                <img
                                                                    src="{{asset($homeContent->key_feature_logo2)}}"
                                                                    alt="">
                                                            @endif
                                                        </div>
                                                        <div class="course_content">
                                                            <h4>
                                                                @if(!empty($homeContent->feature_link2))<a
                                                                    href="{{$homeContent->feature_link2}}"> @endif
                                                                    {{$homeContent->key_feature_title2}}
                                                                    @if(!empty($homeContent->feature_link2))   </a> @endif
                                                            </h4>
                                                            <p>{{$homeContent->key_feature_subtitle2}} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4">
                                                    <div class="single_course_cat">
                                                        <div class="icon">
                                                            @if(!empty($homeContent->key_feature_logo3))
                                                                <img
                                                                    src="{{asset($homeContent->key_feature_logo3)}}"
                                                                    alt="">
                                                            @endif
                                                        </div>
                                                        <div class="course_content">
                                                            <h4>
                                                                @if(!empty($homeContent->feature_link3))<a
                                                                    href="{{$homeContent->feature_link3}}"> @endif
                                                                    {{$homeContent->key_feature_title3}}
                                                                    @if(!empty($homeContent->feature_link3))   </a> @endif
                                                            </h4>
                                                            <p>{{$homeContent->key_feature_subtitle3}} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="section__title mb_40">
                                    <h3>
                                        {{@$homeContent->category_title}}
                                    </h3>
                                    <p>
                                        {{@$homeContent->category_sub_title}}
                                    </p>

                                    <a href="{{route('courses')}}"
                                       class="line_link">{{__('frontend.View All Courses')}}</a>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        @if(isset($categories))
                                            @foreach ($categories as $key=>$category)
                                                @if($key==0)
                                                    <div class="category_wiz mb_30">
                                                        <div class="thumb cat1"
                                                             style="background-image: url('{{asset($category->thumbnail)}}')">
                                                            {{--                                            <img class="w-100" src="{{asset($category->image)}}" alt="">--}}
                                                            <a href="{{route('courses')}}?category={{$category->id}}"
                                                               class="cat_btn">{{$category->name}}</a>
                                                        </div>
                                                    </div>
                                                    <a href="{{route('courses')}}"
                                                       class="brouse_cat_btn ">
                                                        {{__('frontend.Browse all of other categories')}}
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        @if(isset($categories))
                                            @foreach ($categories as $key=>$category)

                                                @if($key==1)
                                                    <div class="category_wiz mb_30">
                                                        <div class="thumb cat2"
                                                             style="background-image: url('{{asset($category->thumbnail)}}')">
                                                            <a href="{{route('courses')}}?category={{$category->id}}"
                                                               class="cat_btn">{{$category->name}}</a>
                                                        </div>
                                                    </div>
                                                @elseif($key==2)
                                                    <div class="category_wiz mb_30">
                                                        <div class="thumb  cat3"
                                                             style="background-image: url('{{asset($category->thumbnail)}}')">
                                                            <a href="{{route('courses')}}?category={{$category->id}}"
                                                               class="cat_btn">{{$category->name}}</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CATEGORY::END  -->
            @endif
        @elseif($block->id==4)
            @if($homeContent->show_instructor_section==1)
                <!-- CTA::START  -->
                <div class="cta_area" style="background-image: url('{{asset(@$homeContent->instructor_banner)}}')">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 offset-xl-1">
                                <div class="section__title white_text">
                                    <h3 class="large_title">
                                        {{@$homeContent->instructor_title}}

                                    </h3>
                                    <p>

                                        {{@$homeContent->instructor_sub_title}}
                                    </p>
                                    <a href="{{route('instructors')}}"
                                       class="theme_btn">{{__('frontend.Find Our Instructor')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CTA::END  -->
            @endif
        @elseif($block->id==5)
            @if($homeContent->show_course_section==1)
                <!-- COURSE::START  -->
                <div class="course_area section_spacing">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="section__title text-center mb_80">
                                    <h3>
                                        {{@$homeContent->course_title}}


                                    </h3>
                                    <p>
                                        {{@$homeContent->course_sub_title}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(isset($top_courses))
                                @foreach($top_courses as $course)
                                    <div class="col-lg-4 col-xl-3 col-md-6">
                                        <div class="couse_wizged">
                                            <a href="{{courseDetailsUrl(@$course->id,@$course->type,@$course->slug)}}">
                                                <div class="thumb">

                                                    <div class="thumb_inner lazy"
                                                         data-src="{{ file_exists($course->thumbnail) ? asset($course->thumbnail) : asset('public/\uploads/course_sample.png') }}">
                                                    </div>
                                                    <span class="prise_tag">
                                            <span>
                                                @if (@$course->discount_price!=null)
                                                    {{getPriceFormat($course->discount_price)}}
                                                @else
                                                    {{getPriceFormat($course->price)}}
                                                @endif

                                              </span>
                                        </span>
                                                </div>
                                            </a>
                                            <div class="course_content">
                                                <a href="{{courseDetailsUrl(@$course->id,@$course->type,@$course->slug)}}">

                                                    <h4 class="noBrake" title=" {{$course->title}}">
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
                                                    @guest()
                                                        @if(!$course->isGuestUserCart)
                                                            <a href="#" class="cart_store"
                                                               data-id="{{$course->id}}">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </a>
                                                        @endif
                                                    @endguest

                                                </div>
                                                <div class="course_less_students">
                                                    <a> <i class="ti-agenda"></i> {{count($course->lessons)}}
                                                        {{__('frontend.Lessons')}}</a>
                                                    <a>
                                                        <i class="ti-user"></i> {{$course->total_enrolled}} {{__('frontend.Students')}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12 text-center pt_70">
                                <a href="{{route('courses')}}"
                                   class="theme_btn mb_30">{{__('frontend.View All Courses')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COURSE::END  -->
            @endif
        @elseif($block->id==6)
            @if($homeContent->show_best_category_section==1)
                <div class="package_area"
                     style="background-image: url('{{asset(@$homeContent->best_category_banner)}}')">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-9">
                                <div class="section__title text-center mb_80">
                                    <h3>
                                        {{@$homeContent->best_category_title}}
                                    </h3>
                                    <p>
                                        {{@$homeContent->best_category_sub_title}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="package_carousel_active owl-carousel">
                                    @if(isset($categories))
                                        @foreach($categories as $category)

                                            <div class="single_package">
                                                <div class="icon">
                                                    <img src="{{asset($category->image)}}" alt="">
                                                </div>
                                                <a href="{{route('courses')}}?category={{$category->id}}">
                                                    <h4>{{$category->name}}</h4>
                                                </a>
                                                <p>{{$category->courses_count}} {{__('frontend.Courses')}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @elseif($block->id==7)
            @if($homeContent->show_quiz_section==1)
                <!-- POPULAR_QUIZ::START  -->
                <div class="quiz_area">
                    <div class="container">
                        <div class="white_box">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="section__title text-center mb_80">
                                        <h3 class="mb-0">{{@$homeContent->quiz_title}}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @if(isset($top_quizzes))
                                    @foreach($top_quizzes as $quiz)

                                        <div class="col-lg-4 col-xl-3 col-md-6">
                                            <div class="quiz_wizged mb_30">
                                                <a href="{{courseDetailsUrl(@$quiz->id,@$quiz->type,@$quiz->slug)}}">
                                                    <div class="thumb">
                                                        <div class="thumb_inner lazy"
                                                             data-src="{{ file_exists($quiz->thumbnail) ? asset($quiz->thumbnail) : asset('public/\uploads/course_sample.png') }}">
                                                        </div>
                                                        <span class="prise_tag">
                                            <span>
                                                @if (@$quiz->discount_price!=null)
                                                    {{getPriceFormat($quiz->discount_price)}}
                                                @else
                                                    {{getPriceFormat($quiz->price)}}
                                                @endif

                                              </span>
                                        </span>
                                                        <span class="live_quiz">{{__('quiz.Quiz')}}</span>
                                                    </div>

                                                </a>

                                                <div class="course_content">
                                                    <a href="{{courseDetailsUrl(@$quiz->id,@$quiz->type,@$quiz->slug)}}">
                                                        <h4 class="noBrake" title=" {{$quiz->title}}">
                                                            {{$quiz->title}}
                                                        </h4>
                                                    </a>
                                                    <div class="rating_cart">
                                                        <div class="rateing">
                                                            <span>{{$quiz->totalReview}}/5</span>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        @auth()
                                                            @if(!$quiz->isLoginUserEnrolled && !$quiz->isLoginUserCart)
                                                                <a href="#" class="cart_store"
                                                                   data-id="{{$quiz->id}}">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            @endif
                                                        @endauth
                                                        @guest()
                                                            @if(!$quiz->isGuestUserCart)
                                                                <a href="#" class="cart_store"
                                                                   data-id="{{$quiz->id}}">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            @endif
                                                        @endguest
                                                    </div>
                                                    <div class="course_less_students">
                                                        <a> <i class="ti-agenda"></i> {{count($quiz->quiz->assign)}}
                                                            {{__('frontend.Question')}}</a>
                                                        <a>
                                                            <i class="ti-user"></i> {{$quiz->total_enrolled}} {{__('frontend.Students')}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12 text-center pt_70">
                                    <a href="{{route('quizzes')}}"
                                       class="theme_btn mb_30">{{__('frontend.View All Quiz')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- POPULAR_QUIZ::END  -->
            @endif
        @elseif($block->id==8)
            @if($homeContent->show_testimonial_section==1)
                <!-- TESTMONIAL::START  -->
                <div class="testmonial_area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="section__title text-center mb_80">
                                    <h3>{{@$homeContent->testimonial_title}}</h3>
                                    <p>
                                        {{@$homeContent->testimonial_sub_title}}

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="testmonail_active owl-carousel">
                                    @if(@$testimonials != "")
                                        @foreach ($testimonials as $testimonial)
                                            <div class="single_testmonial">
                                                <div class="testmonial_header d-flex align-items-center">
                                                    <div class="thumb profile_info ">
                                                        <div class="profile_img">
                                                            <div class="testimonialImage"
                                                                 style="background-image: url('{{getTestimonialImage($testimonial->image)}}')"></div>
                                                        </div>

                                                    </div>
                                                    <div class="reviewer_name">
                                                        <h4>{{@$testimonial->author}}</h4>
                                                        <h6>{{@$testimonial->profession}}</h6>
                                                        <div class="rate d-flex align-items-center">

                                                            @for($i=1;$i<=$testimonial->star;$i++)
                                                                <i class="fas fa-star"></i>
                                                            @endfor

                                                        </div>
                                                    </div>
                                                </div>
                                                <p> “{{@$testimonial->body}}”</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TESTMONIAL::END  -->
            @endif
        @elseif($block->id==9)
            @if($homeContent->show_sponsor_section==1)
                <!-- BRAND::START  -->
                <div class="brand_area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="barnd_wrapper brand_active owl-carousel">
                                    @foreach($sponsors as $sponsor)
                                        <div class="single_brand">
                                            <img src="{{asset($sponsor->image)}}" alt="{{$sponsor->title}}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BRAND::END  -->
            @endif
        @elseif($block->id==10)
            @if($homeContent->show_article_section==1)
                <!-- BLOG::START  -->
                <div class="blog_area">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-8">
                                <div class="section__title text-center mb_80">
                                    <h3>
                                        {{@$homeContent->article_title}}
                                    </h3>
                                    <p>
                                        {{@$homeContent->article_sub_title}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(isset($blogs))
                                @foreach($blogs as $blog)
                                    <div class="col-lg-6 col-xl-3 col-md-6">

                                        <div class="single_blog couse_wizged">
                                            <a href="{{route('blogDetails',[$blog->slug])}}">
                                                <div class="thumb">
                                                    <div class="thumb_inner lazy"
                                                         data-src="{{ file_exists($blog->thumbnail) ? asset($blog->thumbnail) : asset('public/\uploads/course_sample.png') }}">
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="blog_meta">
                                                <span>{{$blog->user->name}} . {{$blog->authored_date}}</span>
                                                <a href="{{route('blogDetails',[$blog->slug])}}">
                                                    <h4 class="noBrake" title="{{$blog->title}}">{{$blog->title}}</h4>
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                @endforeach
                            @endif
                            <div class="row col-md-12">
                                <div class="col-12 text-center pt_70">
                                    <a href="{{route('blogs')}}"
                                       class="theme_btn mb_30">{{__('frontend.View All Articles & News')}}</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- BLOG::END  -->
            @endif
        @elseif($block->id==11)
            @if($homeContent->show_become_instructor_section==1)
                <!-- service_cta_area::start  -->
                @if(@Settings('instructor_reg') )
                    <div class="service_cta_area">
                        <div class="container">
                            <div class="border_top_1px"></div>
                            <div class="row justify-content-center">
                                <div class="col-xl-10">
                                    <div class="row">
                                        <div class="offset-3 col-lg-6 ">
                                            <div class="single_cta_service mb_30">
                                                <div class="thumb">
                                                    <img src="{{asset(@$homeContent->become_instructor_logo)}}" alt="">
                                                </div>
                                                <div class="cta_service_info">
                                                    <h4>  {{@$homeContent->become_instructor_title}}</h4>
                                                    <p>  {{@$homeContent->become_instructor_sub_title}}
                                                    </p>
                                                    <a href="{{route('becomeInstructor')}}"
                                                       class="theme_btn small_btn">{{__('frontend.Start Teaching')}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- service_cta_area::end  -->
            @endif
        @endif
    @endforeach
@endsection
