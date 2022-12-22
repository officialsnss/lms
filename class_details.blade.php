@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} |  {{$course->title??''}}  @endsection
@section('css')
    <style>
        .course__details .video_screen {
            background-image: url('{{getCourseImage(@$course->image)}}');
        }

        iframe {
            position: relative !important;
        }
    </style>
    <link href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}" rel="stylesheet"/>

@endsection


@section('mainContent')

    @php
        function secondsToTime($seconds) {
         $dtF = new \DateTime('@0');
         $dtT = new \DateTime("@$seconds");
         return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes');
     }

             function secondsToHour($seconds) {
              $dtF = new \DateTime('@0');
              $dtT = new \DateTime("@$seconds");
           return $dtF->diff($dtT)->format('%h : %i Hour(s)');

          }

    if (Auth::check() &&  $isEnrolled){
        $allow=true;
    }else{
        $allow=false;
    }
    @endphp

    <div class="breadcrumb_area bradcam_bg_2"
         style="background-image: url('{{asset(@$frontendContent->class_page_banner)}}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap width_730px">
                        <span>{{__('frontend.Class Details')}}</span>
                        <h3>{{@$course->title}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bradcam::end  -->
    <input type="hidden" name="start_time" class="class_start_time"
           value="{{isset($course->nextMeeting->start_time)?$course->nextMeeting->start_time:''}}">
    <!-- course_details::start  -->
    <div class="course__details">
        <div class="container">
            <div class="row justify-content-center ">
                <div class="col-xl-10">
                    <div class="course__details_title">
                        <div class="single__details">
                            <div class="thumb"
                                 style="background-image: url('{{getInstructorImage(@$course->user->image)}}')">
                            </div>
                            <div class="details_content">
                                <span>{{__('frontend.Instructor Name')}}</span>
                                <a href="{{route('instructorDetails',[$course->user->id,$course->user->name])}}">
                                    <h4 class="f_w_700">{{@$course->user->name}}</h4>
                                </a>
                            </div>
                        </div>
                        <div class="single__details">
                            <div class="details_content">
                                <span>{{__('frontend.Category')}}</span>
                                <h4 class="f_w_700">{{@$course->class->category->name}}</h4>
                            </div>
                        </div>
                        <div class="single__details">
                            <div class="details_content">
                                <span>{{__('frontend.Reviews')}}</span>


                                <div class="rating_star">


                                    <div class="stars">
                                        @php
                                            $main_stars=@$course->user->totalRating()['rating'];

                                            $stars=intval(@$course->user->totalRating()['rating']);

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
                                    <p>{{@$course->user->totalRating()['rating']}}
                                        ({{@$course->user->totalRating()['total']}} {{__('frontend.rating')}})</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="video_screen theme__overlay mb_60">
                        <div class="video_play text-center">

                            @if (Auth::check())
                                @if ($isEnrolled)

                                    @if(@$course->class->host=="Zoom")
                                        @if(@$course->nextMeeting->currentStatus=="started")
                                            <a target="_blank"
                                               href="{{route('zoom.meeting.join', $course->nextMeeting->meeting_id)}}"
                                               class="theme_btn d-block text-center height_50 mb_10">
                                                {{__('common.Watch Now')}}
                                            </a>
                                        @elseif (@$course->nextMeeting->currentStatus== 'waiting')
                                            <a href="{{route('zoom.meeting.join', $course->nextMeeting->meeting_id)}}"
                                               class="theme_btn d-block text-center height_50 mb_10">
                                                {{__('frontend.Waiting')}}
                                            </a>
                                        @else
                                            <span
                                                class="theme_line_btn d-block text-center height_50 mb_10">
                                                {{__('frontend.Closed')}}
                                            </span>
                                        @endif
                                    @endif

                                    @if(@$course->class->host=="BBB")
                                        @php
                                            $hasClass=false;
                                        @endphp
                                        @foreach($course->class->bbbMeetings as $key=>$meeting)
                                            @if(!$hasClass)
                                                @if(@$meeting->isRunning())
                                                    <a target="_blank"
                                                       href="{{ url('bbb/meeting-start-attendee/' . $course->id . '/' . $meeting->meeting_id)}}"
                                                       class="theme_btn d-block text-center height_50 mb_10">
                                                        {{__('common.Watch Now')}}
                                                    </a>
                                                    @php
                                                        $hasClass=true;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                        @if(!$hasClass)
                                            <span
                                                class="theme_line_btn d-block text-center height_50 mb_10">
                                                {{__('frontend.Closed')}}
                                            </span>
                                        @endif
                                    @endif
                                    @if(@$course->class->host=="Jitsi")
                                        @if(@$course->nextMeeting->date==date('m/d/Y'))
                                            <a target="_blank"
                                               href="{{ url('jitsi/meeting-start/' . $course->id . '/' . $course->nextMeeting->meeting_id)}}"
                                               class="theme_btn d-block text-center height_50 mb_10">
                                                {{__('frontend.Start Now')}}
                                            </a>

                                        @else
                                            <span
                                                class="theme_line_btn d-block text-center height_50 mb_10">
                                                {{__('frontend.Closed')}}
                                            </span>
                                        @endif
                                    @endif


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

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 col-lg-8">
                            <div class="course_tabs text-center">
                                <ul class="w-100 nav lms_tabmenu justify-content-between  mb_55" id="myTab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Overview-tab" data-toggle="tab" href="#Overview"
                                           role="tab" aria-controls="Overview"
                                           aria-selected="true">{{__('frontend.Overview')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Curriculum-tab" data-toggle="tab" href="#Curriculum"
                                           role="tab" aria-controls="Curriculum"
                                           aria-selected="false">{{__('frontend.Course Schedule')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Instructor-tab" data-toggle="tab" href="#Instructor"
                                           role="tab" aria-controls="Instructor"
                                           aria-selected="false">{{__('frontend.Instructor')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Reviews-tab" data-toggle="tab" href="#Reviews"
                                           role="tab" aria-controls="Instructor"
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
                                        <div class="row mb_40">
                                            <div class="col-12">
                                                <div class="description_grid">

                                                    <div class="single_description_grid">
                                                        <h5> {{__('common.Start Date & Time')}}</h5>
                                                        <p>
                                                            {{ showDate($course->class->start_date)}}  {{__('common.At')}}
                                                            {{date('h:i A', strtotime($course->class->time))}}
                                                        </p>
                                                    </div>
                                                    <div class="single_description_grid">
                                                        <h5> {{__('common.End Date & Time')}}</h5>
                                                        <p>{{showDate($course->class->end_date)}} {{__('common.At')}}
                                                            @php
                                                                $duration =$course->class->duration??0;

                                                            @endphp
                                                            {{date('h:i A', strtotime("+".$duration." minutes", strtotime($course->class->time)))}}
                                                        </p>
                                                    </div>

                                                    <div class="single_description_grid">
                                                        <h5> {{__('common.Duration')}}</h5>
                                                        @php

                                                            $days =1;
    if ($course->class->host=="Zoom"){
        $days=count($course->class->zoomMeetings);
    }elseif($course->class->host=="BBB"){
        $days=count($course->class->bbbMeetings);
    }elseif ($course->class->host=="Jitsi"){
        $days=count($course->class->jitsiMeetings);
    }

                                                                $str = ($course->class->duration?? 0)*$days;
        $duration =preg_replace('/[^0-9]/', '', $str);
    $duration =secondsToTime($duration*60);
                                                        @endphp
                                                        <p>{{$duration}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single_overview">
                                            <h4 class="font_22 f_w_700 mb_20">{{__('frontend.Course Description')}}</h4>
                                            <div class="theme_border"></div>
                                            <div class="">
                                                {!! $course->about !!}
                                            </div>
                                            <p class="mb_20">

                                            </p>

                                            <div class="social_btns">
                                                <a target="_blank"
                                                   href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
                                                   class="social_btn fb_bg"> <i class="fab fa-facebook-f"></i>
                                                    {{__('frontend.Facebook')}}</a>
                                                <a target="_blank"
                                                   href="https://twitter.com/intent/tweet?text={{$course->title}}&amp;url={{URL::current()}}"
                                                   class="social_btn Twitter_bg"> <i
                                                        class="fab fa-twitter"></i> {{__('frontend.Twitter')}}</a>
                                                <a target="_blank"
                                                   href="https://pinterest.com/pin/create/link/?url={{URL::current()}}&amp;description={{$course->title}}"
                                                   class="social_btn Pinterest_bg"> <i
                                                        class="fab fa-pinterest-p"></i> {{__('frontend.Pinterest')}}</a>
                                                <a target="_blank"
                                                   href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}&amp;title={{$course->title}}&amp;summary={{$course->title}}"
                                                   class="social_btn Linkedin_bg"> <i
                                                        class="fab fa-linkedin-in"></i> {{__('frontend.Linkedin')}}</a>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/ content  -->
                                </div>
                                <div class="tab-pane fade " id="Curriculum" role="tabpanel"
                                     aria-labelledby="Curriculum-tab">
                                    <!-- content  -->
                                    <h4 class="font_22 f_w_700 mb_20">{{__('frontend.Course Schedule')}}</h4>

                                    <div class="single_description mb_25">


                                        @if($course->class->host=="BBB")
                                            @foreach($course->class->bbbMeetings as $key=>$meeting)
                                                <div class="row justify-content-between text-center p-3 m-2"
                                                     style="border:1px solid #E1E2E6">
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto "
                                                         style="border-right: 1px solid #E1E2E6;">
                                                        <span>
                                                      {{__('common.Start Date')}}
                                                    </span>

                                                        <h6 class="mb-0">{{date('d M Y',$meeting->datetime)}}  </h6>
                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="border-right: 1px solid #E1E2E6;">
                                                         <span>
                                                       {{__('common.Time')}} <br>
                                                             ({{__('common.Start')}} - {{__('common.End')}})
                                                    </span>
                                                        <h6 class="mb-0">{{date('g:i A',$meeting->datetime)}}
                                                            - @if($meeting->duration==0)
                                                                N/A @else {{date('g:i A',$meeting->datetime+($meeting->duration*60))}} @endif</h6>

                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="{{$allow?'border-right: 1px solid #E1E2E6;':''}}">
                                                        <span>
                                                       {{__('common.Duration')}}
                                                    </span>
                                                        @php

                                                            $str = $meeting->duration?? 0;
    $duration =preg_replace('/[^0-9]/', '', $str);
if ($duration==0){
    $duration='Unlimited';
}else{
$duration =secondsToHour($duration*60);
}
                                                        @endphp
                                                        <h6 class="mb-0">{{$duration}}</h6>
                                                    </div>


                                                    @if (Auth::check() &&  $isEnrolled)
                                                        <div class="col-sm-3 margin_auto">

                                                            @if(@$meeting->isRunning())
                                                                <a target="_blank"
                                                                   href="{{ url('bbb/meeting-start-attendee/' . $course->id . '/' . $meeting->meeting_id)}}"

                                                                   class="theme_btn small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('common.Watch Now')}}
                                                                </a>

                                                            @else
                                                                <span
                                                                    class="theme_btn small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('frontend.Closed')}}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif


                                                </div>
                                            @endforeach

                                        @elseif($course->class->host=="Jitsi")

                                            @foreach($course->class->jitsiMeetings as $key=>$meeting)
                                                <div class="row justify-content-between text-center p-3 m-2"
                                                     style="border:1px solid #E1E2E6">
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="border-right: 1px solid #E1E2E6;">
                                                        <span>
                                                        {{__('common.Start Date')}}
                                                    </span>

                                                        <h6 class="mb-0">{{date('d M Y',$meeting->datetime)}}  </h6>
                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="border-right: 1px solid #E1E2E6;">
                                                         <span>
                                                        {{__('common.Time')}} <br>
                                                             ({{__('common.Start')}} - {{__('common.End')}})
                                                    </span>
                                                        <h6 class="mb-0">{{date('g:i A',$meeting->datetime)}}
                                                            - @if($meeting->duration==0)
                                                                N/A @else {{date('g:i A',$meeting->datetime+($meeting->duration*60))}} @endif</h6>

                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="{{$allow?'border-right: 1px solid #E1E2E6;':''}}">
                                                        <span>
                                                       {{__('common.Duration')}}
                                                    </span>
                                                        @php
                                                            $str = $meeting->duration?? 0;
    $duration =preg_replace('/[^0-9]/', '', $str);
if ($duration==0){
    $duration='Unlimited';
}else{
$duration =secondsToHour($duration*60);
}
                                                        @endphp
                                                        <h6 class="mb-0">{{$duration}}</h6>
                                                    </div>


                                                    @if (Auth::check() &&  $isEnrolled)

                                                        <div class="col-sm-3 margin_auto">
                                                            @if(@$meeting->date==date('m/d/Y'))

                                                                <a target="_blank"
                                                                   href="{{ url('jitsi/meeting-start/' . $course->id . '/' . $meeting->meeting_id)}}"
                                                                   class="theme_btn small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('common.Watch Now')}}
                                                                </a>

                                                            @else
                                                                <span
                                                                    class="theme_line_btn  small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('frontend.Closed')}}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif


                                                </div>
                                            @endforeach

                                        @elseif($course->class->host=="Zoom")
                                            @foreach($course->class->zoomMeetings as $key=>$meeting)

                                                <div class="row justify-content-between text-center p-3 m-2"
                                                     style="border:1px solid #E1E2E6">
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="border-right: 1px solid #E1E2E6;">
                                                        <span>
                                                     {{__('common.Start Date')}}
                                                    </span>

                                                        <h6 class="mb-0">{{date('d M Y',strtotime($meeting->start_time))}}  </h6>
                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="border-right: 1px solid #E1E2E6;">
                                                         <span>
                                                       {{__('common.Time')}} <br>
                                                             ({{__('common.Start')}} - {{__('common.End')}})
                                                    </span>
                                                        <h6 class="mb-0">{{date('g:i A',strtotime($meeting->start_time))}}
                                                            -{{date('g:i A',strtotime($meeting->end_time))}}</h6>


                                                    </div>
                                                    <div class="{{$allow?'col-sm-3':'col-sm-4'}} margin_auto"
                                                         style="{{$allow?'border-right: 1px solid #E1E2E6;':''}}">
                                                        <span>
                                                       {{__('common.Duration')}}
                                                    </span>
                                                        @php

                                                            $str = $meeting->meeting_duration?? 0;
    $duration =preg_replace('/[^0-9]/', '', $str);

$duration =secondsToHour($meeting->meeting_duration*60);
                                                        @endphp
                                                        <h6 class="mb-0">{{$duration}}</h6>
                                                    </div>


                                                    @if (Auth::check() &&  $isEnrolled)
                                                        <div class="col-sm-3 margin_auto">
                                                            @if(@$meeting->currentStatus=="started")
                                                                <a target="_blank"
                                                                   href="{{route('zoom.meeting.join', $meeting->meeting_id)}}"
                                                                   class="theme_btn small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('common.Watch Now')}}
                                                                </a>
                                                            @elseif (@$meeting->currentStatus== 'waiting')
                                                                <a href="{{route('zoom.meeting.join', $meeting->meeting_id)}}"
                                                                   class="theme_line_btn  small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('frontend.Waiting')}}
                                                                </a>
                                                            @else
                                                                <span
                                                                    class="theme_line_btn  small_btn2 d-block text-center height_50   p-3 ">
                                                                    {{__('frontend.Closed')}}
                                                                </span>
                                                            @endif
                                                        </div>
                                                    @endif


                                                </div>


                                            @endforeach
                                        @endif
                                    </div>

                                </div>
                                <div class="tab-pane fade " id="Instructor" role="tabpanel"
                                     aria-labelledby="Instructor-tab">
                                    <div class="instractor_details_wrapper">
                                        <div class="instractor_title">
                                            <h4 class="font_22 f_w_700">{{__('frontend.Instructor')}}</h4>
                                            <p class="font_16 f_w_400">{{@$course->user->headline}}</p>
                                        </div>
                                        <div class="instractor_details_inner">
                                            <div class="thumb">
                                                <img class="w-100" src="{{getInstructorImage(@$course->user->image)}}"
                                                     alt="">
                                            </div>
                                            <div class="instractor_details_info">
                                                <a href="{{route('instructorDetails',[$course->user->id,$course->user->name])}}">
                                                    <h4 class="font_22 f_w_700">{{@$course->user->name}}</h4>
                                                </a>
                                                <h5>  {{@$course->user->headline}}</h5>
                                                <div class="ins_details">
                                                    <p>{!! @$course->user->short_details !!}</p>
                                                </div>
                                                <div class="intractor_qualification">
                                                    <div class="single_qualification">
                                                        <i class="ti-star"></i> {{@$course->user->totalRating()['rating']}}
                                                        {{__('frontend.Rating')}}
                                                    </div>
                                                    <div class="single_qualification">
                                                        <i class="ti-comments"></i> {{@$course->user->totalRating()['total']}}
                                                        {{__('frontend.Reviews')}}
                                                    </div>
                                                    <div class="single_qualification">
                                                        <i class="ti-user"></i> {{@$course->user->totalEnrolled()}}
                                                        {{__('frontend.Students')}}
                                                    </div>
                                                    <div class="single_qualification">
                                                        <i class="ti-layout-media-center-alt"></i> {{@$course->user->totalCourses()}}
                                                        {{__('frontend.Courses')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            {!! @$course->user->about !!}                                        </p>
                                    </div>
                                    <div class="author_courses">
                                        <div class="section__title mb_80">
                                            <h3>{{__('frontend.More Courses by Author')}}</h3>
                                        </div>
                                        <div class="row">
                                            @foreach(@$course->user->courses->take(2) as $c)
                                                <div class="col-xl-6">
                                                    <div class="couse_wizged mb_30">
                                                        <div class="thumb">
                                                            <a href="{{courseDetailsUrl(@$c->id,@$c->type,@$c->slug)}}">
                                                                <img class="w-100"
                                                                     src="{{ file_exists($c->thumbnail) ? asset($c->thumbnail) : asset('public/\uploads/course_sample.png') }}"
                                                                     alt="">
                                                                <span class="prise_tag">
                                                                                                                               @if (@$c->discount_price!=null)
                                                                        {{getPriceFormat($c->discount_price)}}
                                                                    @else
                                                                        {{getPriceFormat($c->price)}}
                                                                    @endif
                                                                                                                          </span>
                                                            </a>
                                                        </div>
                                                        <div class="course_content">
                                                            <a href="{{courseDetailsUrl(@$c->id,@$c->type,@$c->slug)}}">
                                                                <h4>{{@$c->title}}</h4>
                                                            </a>
                                                            <div class="rating_cart">
                                                                <div class="rateing">
                                                                    <span>{{$c->totalReview}}/5</span>
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                                @auth()
                                                                    @if(!$c->isLoginUserEnrolled && !$c->isLoginUserCart)
                                                                        <a href="#" class="cart_store"
                                                                           data-id="{{$c->id}}">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    @endif
                                                                @endauth
                                                                @guest()
                                                                    @if(!$c->isGuestUserCart)
                                                                        <a href="#" class="cart_store"
                                                                           data-id="{{$c->id}}">
                                                                            <i class="fas fa-shopping-cart"></i>
                                                                        </a>
                                                                    @endif
                                                                @endguest
                                                            </div>
                                                            <div class="course_less_students">
                                                                <a href="#"> <i
                                                                        class="ti-agenda"></i> {{count($c->lessons)}}
                                                                    {{__('frontend.Lessons')}}</a>
                                                                <a href="#"> <i
                                                                        class="ti-user"></i> {{$c->total_enrolled}}
                                                                    {{__('frontend.Students')}} </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
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
                                                                                               class="theme_color2">Sign
                                                                    In</a>
                                                                or <a
                                                                    class="theme_color2" href="{{url('register')}}">Sign
                                                                    Up</a>
                                                                as student to post a review</p>
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
                                               class="theme_button mr_10 sm_mb_10">{{__('frontend.Already Bookmarked')}}
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
                                                                <textarea class="lms_summernote" name="review" name=""
                                                                          id=""
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
    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/videopopup.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/video.popup.js')}}"></script>
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
