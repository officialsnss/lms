@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.Courses')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{ asset('public/frontend/infixlmstheme/js/classes.js') }}"></script>
@endsection
@section('mainContent')
    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="breadcam_wrap">
                          <span>
                            {{@$frontendContent->course_page_title}}
                        </span>
                        <h3>
                            {{@$frontendContent->course_page_sub_title}}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->

    <!-- course ::start  -->
    <div class="courses_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="course_category_chose mb_30 mt_10">
                        <div class="course_title mb_30 d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="13" viewBox="0 0 19.5 13">
                                <g id="filter-icon" transform="translate(28)">
                                    <rect id="Rectangle_1" data-name="Rectangle 1" width="19.5" height="2" rx="1"
                                          transform="translate(-28)" fill="#fb1159"/>
                                    <rect id="Rectangle_2" data-name="Rectangle 2" width="15.5" height="2" rx="1"
                                          transform="translate(-26 5.5)" fill="#fb1159"/>
                                    <rect id="Rectangle_3" data-name="Rectangle 3" width="5" height="2" rx="1"
                                          transform="translate(-20.75 11)" fill="#fb1159"/>
                                </g>
                            </svg>
                            <h5 class="font_16 f_w_500 mb-0">{{__('frontend.Filter Category')}}</h5>
                        </div>
                        <div class="course_category_inner">
                            @if(isset($search))
                                <div class="single_course_categry">
                                    <h4 class="font_18 f_w_700">
                                        {{__('frontend.Course Category')}}
                                    </h4>
                                    <ul class="Check_sidebar">
                                        @if(isset($categories))
                                            @foreach ($categories as $cat)
                                                <li>
                                                    <label class="primary_checkbox d-flex">
                                                        <input type="checkbox" value="{{$cat->id}}"
                                                               class="category" {{in_array($cat->id,explode(',',$category))?'checked':''}}>
                                                        <span class="checkmark mr_15"></span>
                                                        <span class="label_name">{{$cat->name}}</span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            @endif
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    {{__('frontend.Level')}}
                                </h4>
                                <ul class="Check_sidebar">

                                    @foreach($levels as $l)
                                        <li>
                                            <label class="primary_checkbox d-flex">
                                                <input name="level" type="checkbox" value="{{$l->id}}"
                                                       class="level" {{in_array($l->id,explode(',',$level))?'checked':''}}>
                                                <span class="checkmark mr_15"></span>
                                                <span class="label_name">{{$l->title}}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    {{__('frontend.Course Price')}}
                                </h4>
                                <ul class="Check_sidebar">
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox" class="type"
                                                   value="paid" {{in_array("paid",explode(',',$type))?'checked':''}}>
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">{{__('frontend.Paid Course')}}</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox" class="type"
                                                   value="free" {{in_array("free",explode(',',$type))?'checked':''}}>
                                            <span class="checkmark mr_15"></span>
                                            <span class="label_name">{{__('frontend.Free Course')}}</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="single_course_categry">
                                <h4 class="font_18 f_w_700">
                                    {{__('frontend.Language')}}
                                </h4>
                                <ul class="Check_sidebar">
                                    @if(isset($languages))
                                        @foreach ($languages as $lang)
                                            <li>
                                                <label class="primary_checkbox d-flex">
                                                    <input type="checkbox" class="language"
                                                           value="{{$lang->code}}" {{in_array($lang->code,explode(',',$language))?'checked':''}}>
                                                    <span class="checkmark mr_15"></span>
                                                    <span class="label_name">{{$lang->name}}</span>
                                                </label>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="box_header d-flex flex-wrap align-items-center justify-content-between">

                                <h5 class="font_16 f_w_500 ">
                                    @if(isset($search))

                                        {{__('courses.Search result for')}} "{{$search}}
                                        "<br style="line-break: auto">
                                        @if($courses->count()==0)
                                            {{--  <span
                                                  class="subtitle">    {{__('frontend.No results found for')}} {{$search}} </span>--}}
                                        @else
                                            <span
                                                class="subtitle">{{$total}} {{__('coupons.Topics are available')}}</span>
                                        @endif
                                    @endif
                                </h5>

                                <div class="box_header_right mb_30">
                                    <div class="short_select d-flex align-items-center">
                                        <h5 class="mr_10 font_16 f_w_500 mb-0">{{__('frontend.Order By')}}:</h5>
                                        <select class="small_select" id="order">
                                            <option data-display="None">{{__('frontend.None')}}</option>
                                            <option
                                                value="price" {{$order=="price"?'selected':''}}>{{__('frontend.Price')}}</option>
                                            <option
                                                value="date" {{$order=="date"?'selected':''}}>{{__('frontend.Date')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($courses))
                            @foreach ($courses as $course)
                                <div class="col-lg-6 col-xl-4">

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
                        @if(count($courses)==0)

                            <div class="col-lg-12">
                                <div class="Nocouse_wizged text-center d-flex align-items-center justify-content-center">
                                    <h1>
                                        <div class="thumb">
                                            <img style="width: 50px"
                                                 src="{{ asset('public/frontend/infixlmstheme') }}/img/not-found.png"
                                                 alt="">
                                            @if(!isset($search))
                                                {{__('frontend.No Course Found')}}
                                            @else
                                                {{__('frontend.No results found for')}} {{$search}}
                                            @endif
                                        </div>

                                    </h1>
                                </div>
                            </div>

                        @endif
                    </div>

                    {{ $courses->appends(Request::all())->links() }}
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" class="class_route" name="class_route" value="{{url()->current()}}">

    <input type="hidden" class="search" value="{{isset($search)?$search:''}}">

@endsection

