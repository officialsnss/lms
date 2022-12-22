@extends('frontend.infixlmstheme.layouts.full_screen_master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{ $course->title}} @endsection
@section('css')
    <link href="{{asset('public/frontend/infixlmstheme/css/full_screen.css')}}" rel="stylesheet"/>
    <link href="{{asset('public/frontend/infixlmstheme/css/class_details.css')}}" rel="stylesheet"/>
    <style>
        .default-font {
            font-family: "Jost", sans-serif;
            font-weight: normal;
            font-style: normal;
            font-weight: 400;
        }

        .primary_checkbox {
            z-index: 99;
        }
    </style>
@endsection

@section('mainContent')


    <header>
        <div id="sticky-header" class="header_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="header__wrapper">
                            <!-- header__left__start  -->
                            <div class="header__left d-flex align-items-center">
                                <div class="logo_img">
                                    <a href="{{url('/')}}">
                                        <img class="p-2" style="width: 108px"
                                             src="{{getCourseImage(Settings('logo') )}}"
                                             alt="{{ Settings('site_name')  }}">
                                    </a>
                                </div>

                                <div class="category_search d-flex category_box_iner">

                                    <div class="input-group-prepend2 pl-3 ">
                                        <a class="headerTitle"
                                           href="{{courseDetailsUrl($course->id,$course->type,$course->slug)}}"
                                           style="padding-top: 3px;">
                                            <h4 class="headerTitle">{{$course->title}}</h4>
                                        </a>


                                    </div>

                                </div>
                            </div>

                            <div class="header__right">
                                <div class="contact_wrap d-flex align-items-center">
                                    <div class="contact_btn d-flex align-items-center">

                                        @if (Auth::check())
                                            @if(Auth::user()->role_id==3)
                                                @if (!in_array(Auth::user()->id,$reviewer_user_ids))

                                                    <a href="" data-toggle="modal"
                                                       data-target="#courseRating"
                                                       class="  headerSub p-2 mr-3">
                                                        <i class="fa fa-star pr-2"></i>
                                                        {{__('frontend.Leave a rating')}}

                                                    </a>


                                                @endif
                                            @endif
                                        @endif


                                        <a href="" class="mr-3">
                                            <div class="progress p-2" data-percentage="{{$percentage}}">
		<span class="progress-left">
			<span class="progress-bar"></span>
		</span>
                                                <span class="progress-right">
			<span class="progress-bar"></span>
		</span>
                                                <div class="progress-value">
                                                    <div class="headerSubProcess">
                                                        {{$percentage}}%
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="#" data-toggle="modal"
                                           data-target="#ShareLink"
                                           class="theme_btn small_btn2 p-2 m-1">
                                            <i class="fa fa-share"></i>
                                            Share
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- header__right_end  -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <div class="mobile_display_content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="mobile_text">
                        {{$course->title}}
                    </h4>
                </div>
                <div class="col-12">
                    <div class="next_prev_button">
                        <a href="{{courseDetailsUrl(@$course->id,@$course->type,@$course->slug)}}"
                           class="theme_btn d-inline-flex align-items-center">
                            <i class="ti-angle-left mr-1"></i>
                            {{__('frontend.Course Details')}}
                        </a>
                        <a href="{{route('myCourses')}}" class="theme_btn d-inline-flex align-items-center">
                            {{__('frontend.My Course')}}
                            <i class="ti-angle-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="course_fullview_wrapper">

        @if ($lesson->is_quiz==1)
            @if($result)
                <div class="quiz_score_wrapper w-100 mt_70">
                @if(!isset($_GET['done']))
                    <!-- quiz_test_header  -->
                        <div class="quiz_test_header">
                            <h3>{{__('student.Your Exam Score')}}</h3>
                        </div>
                        <!-- quiz_test_body  -->
                        <div class="quiz_test_body">

                            <h3>{{__('student.Congratulations! You’ve completed')}} {{$lesson->lessonQuiz->title}}</h3>

                            <div class="">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6">
                                        <div class="score_view_wrapper">
                                            <div class="single_score_view">
                                                <p>{{__('student.Exam Score')}}:</p>
                                                <ul>
                                                    <li class="mb_15">
                                                        <label class="primary_checkbox2 d-flex">
                                                            <input checked="" type="checkbox" disabled>
                                                            <span class="checkmark mr_10"></span>
                                                            <span
                                                                class="label_name">{{$result['totalCorrect']}} {{__('student.Correct Answer')}}</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="primary_checkbox2 error_ans d-flex">
                                                            <input checked="" name="qus" type="checkbox"
                                                                   disabled>
                                                            <span class="checkmark mr_10"></span>
                                                            <span
                                                                class="label_name">{{$result['totalWrong']}} {{__('student.Wrong Answer')}}</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="single_score_view">
                                                <p>{{__('student.Rating')}}:</p>
                                                <h4 class="f_w_700 theme_text">{{$result['status']}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sumit_skip_btns d-flex align-items-center">

                                <form action="{{route('lesson.complete')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$course->id}}" name="course_id">
                                    <input type="hidden" value="{{$lesson->id}}" name="lesson_id">
                                    <input type="hidden" value="1" name="status">
                                    <button type="submit"
                                            class="theme_btn small_btn  mr_20">{{__('student.Done')}}</button>
                                </form>


                                @if($quizSetup->show_result_each_submit==1)
                                    <a target="_blank" href="{{route('quizResultPreview',$lesson->lessonQuiz->id)}}"
                                       class=" font_1 font_16 f_w_600 theme_text3 submit_q_btn">{{__('student.See Answer Sheet')}}</a>
                                @endif


                            </div>

                        </div>
                    @else
                        <h3 class="text-center">{{__('student.Congratulations! You’ve completed')}} {{$lesson->lessonQuiz->title}}</h3>

                    @endif
                </div>
            @else
                <div class="quiz_questions_wrapper w-100 mt_70">
                    <!-- quiz_test_header  -->
                    <div class="quiz_test_header d-flex justify-content-between align-items-center">
                        <div class="quiz_header_left">
                            <h3>{{$lesson->lessonQuiz->title}}</h3>
                        </div>
                        <div class="quiz_header_right">

                                            <span class="question_time">
                                @php
                                    $timer =0;
                                        if(!empty($quizSetup->time_total_question)){
                                            $timer=$quizSetup->time_total_question;
                                        }else{
                                           $timer= $quizSetup->time_per_question*count($lesson->lessonQuiz->assign);
                                        }
                                @endphp

                                <span id="timer">{{$timer}}:00</span> min</span>
                            <p>{{__('student.Left of this Section')}}</p>
                        </div>
                    </div>
                    <!-- quiz_test_body  -->
                    <form action="{{route('quizSubmit')}}" method="POST">
                        <input type='hidden' name="from" value="course">
                        <input type="hidden" name="courseId" value="{{$course->id}}">
                        <input type="hidden" name="quizId" value="{{$lesson->lessonQuiz->id}}">
                        @csrf

                        <div class="quiz_test_body">
                            <div class="tabControl">
                                <!-- nav-pills  -->
                                <ul class="nav nav-pills nav-fill d-none" id="pills-tab" role="tablist">
                                    @if(isset($lesson->lessonQuiz->assign))
                                        @foreach($lesson->lessonQuiz->assign as $key=>$itemAssign)
                                            <li class="nav-item">
                                                <a class="nav-link {{$key==0?'active':''}}"
                                                   id="pills-home-tab{{$itemAssign->id}}" data-toggle="pill"
                                                   href="#pills-{{$itemAssign->id}}" role="tab">Tab1</a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                                <!-- tab-content  -->
                                <div class="tab-content" id="pills-tabContent">
                                    @php
                                        $count =1;
                                    @endphp
                                    @if(isset($lesson->lessonQuiz->assign))
                                        @foreach($lesson->lessonQuiz->assign as $key=>$assign)
                                            <div class="tab-pane fade  {{$key==0?'active show':''}}"
                                                 id="pills-{{$assign->id}}" role="tabpanel"
                                                 aria-labelledby="pills-home-tab{{$assign->id}}">
                                                <!-- content  -->
                                                <div class="question_list_header">
                                                    <div class="question_list_top">
                                                        <p>Question {{$count}} out
                                                            of {{count($lesson->lessonQuiz->assign)}}</p>
                                                        <div class="arrow_controller">
                                                            @if($quizSetup->question_review==1)
                                                                <span class="btnPrevious"> <i
                                                                        class="ti-angle-left"></i> </span>
                                                                <span class="next"> <i
                                                                        class="ti-angle-right"></i> </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="question_list_counters">
                                                        @foreach($lesson->lessonQuiz->assign as $key2=>$a)
                                                            @php
                                                                $value =$key2+1;
                                                            @endphp
                                                            <span
                                                                class=" @if($value==$count) skip_qus @endif">{{$value}}</span>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="multypol_qustion mb_30">
                                                    <h4 class="font_18 f_w_700 mb-0"> {{@$assign->questionBank->question}}</h4>
                                                </div>
                                                <ul class="quiz_select">
                                                    @if(isset($assign->questionBank->questionMu))
                                                        @foreach(@$assign->questionBank->questionMu as $option)

                                                            {{--                                                            $user_previous->question_id . '|' . $option->id--}}
                                                            <li>
                                                                <label
                                                                    class="primary_bulet_checkbox d-flex">
                                                                    <input class="quizAns"
                                                                           name="ans[{{$option->question_bank_id}}]"
                                                                           type="radio"
                                                                           value="{{$option->question_bank_id}}|{{$option->id}}">

                                                                    <span class="checkmark mr_10"></span>
                                                                    <span
                                                                        class="label_name">{{$option->title}} </span>
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <div class="sumit_skip_btns d-flex align-items-center">
                                                    @if(count($lesson->lessonQuiz->assign)!=$count)
                                                        <span
                                                            class="theme_btn small_btn  mr_20 next"
                                                            id="next">{{__('student.Continue')}}</span>
                                                        <span
                                                            class=" font_1 font_16 f_w_600 theme_text3 submit_q_btn skip"
                                                            id="skip">{{__('student.Skip')}}
                                                            {{__('frontend.Question')}}</span>
                                                    @else
                                                        <button type="submit"
                                                                class="submitBtn theme_btn small_btn  mr_20">
                                                            {{__('student.Submit')}}
                                                        </button>
                                                    @endif
                                                </div>
                                                <!-- content::end  -->
                                            </div>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @else

            @if ($lesson->host=='Youtube')
                @php
                    if (Str::contains( $lesson->video_url, '&')) {
                        $video_id = explode("=", $lesson->video_url);
                        $youtube_url= youtubeVideo($video_id[1]);
                    } else {
                       $youtube_url=getVideoId(showPicName(@$lesson->video_url));

                    }
                @endphp
                <iframe id="video-id" class="video_iframe"
                        src="https://www.youtube.com/embed/{{$youtube_url}}?autoplay=1"
                        frameborder="0"></iframe>
            @endif

            @if ($lesson->host=='Vimeo')

                <iframe class="video_iframe" id="video-id"
                        src="https://player.vimeo.com/video/{{getVideoId(showPicName(@$lesson->video_url))}}?autoplay=1"
                        frameborder="0"></iframe>
            @endif

            @if ($lesson->host=='Self')

                <video class="" id="video-id" controls>
                    <source src="{{asset($lesson->video_url)}}" type="video/mp4"/>
                    <source src="{{asset($lesson->video_url)}}" type="video/ogg">
                </video>
            @endif


            @if ($lesson->host=='URL')
                <video class="" id="video-id" controls autoplay>
                    <source src="{{$lesson->video_url}}" type="video/mp4">
                    <source src="{{$lesson->video_url}}" type="video/ogg">
                    Your browser does not support the video.
                </video>
            @endif
            @if ($lesson->host=='AmazonS3')
                <video class=" " id="video-id" controls>
                    <source src="{{$lesson->video_url}}" type="video/mp4"/>

                </video>

            @endif

            @if ($lesson->host=='SCORM')

                <iframe class="video_iframe" id="video-id"
                        src="{{asset($lesson->video_url)}}"
                ></iframe>
            @endif

            @if ($lesson->host=='SCORM-AwsS3')

                <iframe class="video_iframe" id="video-id"
                        src="{{$lesson->video_url}}"
                ></iframe>
            @endif

            @if ($lesson->host=='Iframe')
                @if(!empty($lesson->video_url))
                    <iframe class="video_iframe" id="video-id"
                            src="{{asset($lesson->video_url)}}"
                    ></iframe>
                @endif
            @endif


            @if ($lesson->host=='Image')
                <img src="{{asset($lesson->video_url)}}" alt="" class="w-100  h-100">
            @endif

            @if ($lesson->host=='PDF')


                <div id="pdfShow" class="w-100  h-100"></div>
                <script src="{{asset('public/js/pdfobject.js')}}"></script>
                <script>PDFObject.embed("{{asset($lesson->video_url)}}", "#pdfShow");</script>

            @endif
            @if ($lesson->host=='Word' || $lesson->host=='Excel' || $lesson->host=='PowerPoint' )

                <iframe class="w-100  h-100"
                        src="https://view.officeapps.live.com/op/view.aspx?src={{asset($lesson->video_url)}}"></iframe>


                {{--                <iframe class="w-100  h-100" src="https://view.officeapps.live.com/op/view.aspx?src=https://filesamples.com/samples/document/doc/sample2.doc"></iframe>--}}


            @endif

            @if ($lesson->host=='Text')
                <div class="w-100  h-100 textViewer">

                </div>
                <script>
                    $(".textViewer").load("{{asset($lesson->video_url)}}");

                </script>
            @endif

            @if ($lesson->host=='Zip')
                <style>
                    .parent {
                        position: fixed;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .child {
                        position: relative;
                        font-size: 10vw;
                    }
                </style>
                <div class="w-100 parent  h-100 ">
                    <div class="">
                        <div class="row">
                            <div class="col  text-center">
                                <div class="child">
                                    <a class="theme_btn " href="{{asset($lesson->video_url)}}" download="">Download
                                        File</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif


        @endif


        <input type="hidden" id="url" value="{{url('/')}}">
        <div class="course__play_warp courseListPlayer ">
            <div class="play_toggle_btn">
                <i class="ti-menu-alt"></i>
            </div>

            <div class="play_warp_header d-flex justify-content-between">
                <h3 class="font_16  mb-0 lesson_count default-font">
                    <a href="{{courseDetailsUrl(@$course->id,@$course->type,@$course->slug)}}" class="theme_btn_mini">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    {{@$total}} {{__('common.Lessons')}}</h3>
                <p class="font_14  duration_time default-font"> {{@$course->duration}} </p>
            </div>
            <div class="course__play_list">
                @php
                    $i=1;
                @endphp
                @foreach($chapters as $chapter)
                    <span class="pl-2">   {{$chapter->name}}</span>
                    @if(isset($lessons))
                        @foreach ($lessons as $key=> $singleLesson)
                            @if($singleLesson->chapter_id==$chapter->id)
                                <div class="single_play_list">
                                    <a class="@if(showPicName(Request::url())==$singleLesson->id) active @endif"
                                       href="#">

                                        @if ($singleLesson->is_quiz==1)
                                            <div class="course_play_name">

                                                <label class="primary_checkbox d-flex mb-0">
                                                    <input type="checkbox" data-lesson="{{$singleLesson->id}}"
                                                           data-course="{{$course->id}}" class="course_name"
                                                           {{$singleLesson->completed && $singleLesson->completed->status == 1 ? 'checked' : ''}}  name="billing_address"
                                                           value="1">
                                                    <span class="checkmark mr_15"></span>

                                                    <i class="ti-check-box"></i>
                                                </label>
                                                @foreach ($singleLesson->quiz as $quiz)

                                                    <span class="quizLink"
                                                          onclick="goFullScreen({{$course->id}},{{$singleLesson->id}})">
                                                     <span class="quiz_name">{{$i}}. {{@$quiz->title}}</span>
                                                                </span>
                                            </div>
                                            @endforeach
                                        @else

                                            <div class="course_play_name">
                                                @if(request()->route('lesson_id') == $singleLesson->id)
                                                    <div class="remember_forgot_pass d-flex justify-content-between">
                                                        <label class="primary_checkbox d-flex mb-0">

                                                            @if($isEnrolled)
                                                                <input type="checkbox"
                                                                       data-lesson="{{$singleLesson->id}}"
                                                                       data-course="{{$course->id}}" class="course_name"
                                                                       {{$singleLesson->completed && $singleLesson->completed->status == 1 ? 'checked' : ''}}  name="billing_address"
                                                                       value="1">
                                                                <span class="checkmark mr_15"></span>
                                                                <i class="ti-control-play"></i>
                                                            @else
                                                                <i class="ti-control-play"></i>
                                                            @endif
                                                        </label>
                                                    </div>
                                                @else
                                                    <label class="primary_checkbox d-flex mb-0">
                                                        <input type="checkbox" data-lesson="{{$singleLesson->id}}"
                                                               data-course="{{$course->id}}" class="course_name"
                                                               {{$singleLesson->completed && $singleLesson->completed->status == 1 ? 'checked' : ''}}  name="billing_address"
                                                               value="1">
                                                        <span class="checkmark mr_15"></span>

                                                        <i class="ti-control-play"></i>
                                                    </label>
                                                @endif

                                                <span
                                                    onclick="goFullScreen({{$course->id}},{{$singleLesson->id}})">{{$i}}. {{$singleLesson->name}} </span>
                                            </div>
                                            <span class="course_play_duration">{{$singleLesson->duration}}</span>
                                        @endif
                                    </a>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endif
                        @endforeach


                    @endif
                @endforeach
                <div class="row justify-content-center text-center">
                    @if($certificate)
                        @auth()
                            @if(count($course->lessons) == count($course->completeLessons->where('status',1)->where('user_id',\Illuminate\Support\Facades\Auth::user()->id)))
                                <a href="{{route('getCertificate',[$course->id,$course->title])}}"
                                   class="theme_btn certificate_btn mt-5">
                                    {{__('frontend.Get Certificate')}}
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                <div class="pb-5 mb-5"></div>
            </div>
        </div>

    </div>



    <div class="modal fade " id="ShareLink"
         tabindex="-1" role="dialog"
         aria-labelledby=" "
         aria-hidden="true">
        <div class="modal-dialog modal-lg "
             role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Share this course

                    </h5>
                </div>

                <div class="modal-body">


                    <div class="row mb-20">
                        <div class="col-md-12">
                            <input type="text"
                                   required
                                   class="primary_input4 mb_20"
                                   name=""
                                   value="{{URL::current()}}">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="social_btns ">
                                <a target="_blank"
                                   href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
                                   class="social_btn fb_bg"> <i class="fab fa-facebook-f"></i>
                                </a>
                                <a target="_blank"
                                   href="https://twitter.com/intent/tweet?text={{$course->title}}&amp;url={{URL::current()}}"
                                   class="social_btn Twitter_bg"> <i
                                        class="fab fa-twitter"></i> </a>
                                <a target="_blank"
                                   href="https://pinterest.com/pin/create/link/?url={{URL::current()}}&amp;description={{$course->title}}"
                                   class="social_btn Pinterest_bg"> <i
                                        class="fab fa-pinterest-p"></i> </a>
                                <a target="_blank"
                                   href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}&amp;title={{$course->title}}&amp;summary={{$course->title}}"
                                   class="social_btn Linkedin_bg"> <i
                                        class="fab fa-linkedin-in"></i> </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade " id="courseRating"
         tabindex="-1" role="dialog"
         aria-labelledby=" "
         aria-hidden="true">
        <div class="modal-dialog modal-lg "
             role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Rate this course

                    </h5>
                </div>
                <div class="modal-body">


                    <div class="row mb-20">
                        <div class="col-md-12">
                            <div class="rating_star text-right">

                                @php
                                    $PickId=$course->id;
                                @endphp
                                @if (Auth::check())
                                    @if(Auth::user()->role_id==3)
                                        @if (!in_array(Auth::user()->id,$reviewer_user_ids))


                                            <div
                                                class="star_icon d-flex align-items-center justify-content-between">
                                                <a class="rating">
                                                    <input type="radio" id="star5" name="rating"
                                                           value="5"
                                                           class="rating"/><label
                                                        class="full" for="star5" id="star5"
                                                        title="Awesome - 5 stars"
                                                        onclick="Rates(5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star4half"
                                                           name="rating"
                                                           value="4.5"
                                                           class="rating"/><label class="half"
                                                                                  for="star4half"
                                                                                  title="Pretty good - 4.5 stars"
                                                                                  onclick="Rates(4.5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star4" name="rating"
                                                           value="4"
                                                           class="rating"/><label
                                                        class="full" for="star4"
                                                        title="Pretty good - 4 stars"
                                                        onclick="Rates(4, {{@$PickId }})"></label>
                                                    <input type="radio" id="star3half"
                                                           name="rating"
                                                           value="3.5"
                                                           class="rating"/><label class="half"
                                                                                  for="star3half"
                                                                                  title="Meh - 3.5 stars"
                                                                                  onclick="Rates(3.5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star3" name="rating"
                                                           value="3"
                                                           class="rating"/><label
                                                        class="full" for="star3"
                                                        title="Meh - 3 stars"
                                                        onclick="Rates(3, {{@$PickId }})"></label>
                                                    <input type="radio" id="star2half"
                                                           name="rating"
                                                           value="2.5"
                                                           class="rating"/><label class="half"
                                                                                  for="star2half"
                                                                                  title="Kinda bad - 2.5 stars"
                                                                                  onclick="Rates(2.5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star2" name="rating"
                                                           value="2"
                                                           class="rating"/><label
                                                        class="full" for="star2"
                                                        title="Kinda bad - 2 stars"
                                                        onclick="Rates(2, {{@$PickId }})"></label>
                                                    <input type="radio" id="star1half"
                                                           name="rating"
                                                           value="1.5"
                                                           class="rating"/><label class="half"
                                                                                  for="star1half"
                                                                                  title="Meh - 1.5 stars"
                                                                                  onclick="Rates(1.5, {{@$PickId }})"></label>
                                                    <input type="radio" id="star1" name="rating"
                                                           value="1"
                                                           class="rating"/><label
                                                        class="full" for="star1"
                                                        title="Bad  - 1 star"
                                                        onclick="Rates(1,{{@$PickId }})"></label>
                                                    <input type="radio" id="starhalf"
                                                           name="rating"
                                                           value=".5"
                                                           class="rating"/><label class="half"
                                                                                  for="starhalf"
                                                                                  title="So bad  - 0.5 stars"
                                                                                  onclick="Rates(.5,{{@$PickId }})"></label>
                                                </a>
                                            </div>
                                        @endif
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
                        <div class="mt-40">
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
@endsection
@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            let course = '{{$course->id}}';
            let lesson = '{{$lesson->id}}';

            $("iframe").each(function () {
                //Using closures to capture each one
                var iframe = $(this);
                iframe.on("load", function () { //Make sure it is fully loaded
                    iframe.contents().click(function (event) {
                        iframe.trigger("click");
                    });

                });

                iframe.click(function () {
                    $.ajax({
                        type: 'POST',
                        "_token": "{{ csrf_token() }}",
                        url: '{{route('lesson.complete.ajax')}}',
                        data: {course_id: course, lesson_id: lesson},
                        success: function (data) {

                        }
                    });
                });
            });

            if (window.outerWidth < 425) {
                $('.courseListPlayer').toggleClass("active");
                $('.course_fullview_wrapper').toggleClass("active");
            }
        });


    </script>

    @if ($lesson->host=='Self'|| $lesson->host=='AmazonS3')

        <script>


            let myFP = fluidPlayer(
                'video-id', {
                    "layoutControls": {
                        "primaryColor": "{{$color->primary_color??'#FB1159' }}",
                        "controlBar": {
                            "autoHideTimeout": 3,
                            "animated": true,
                            "autoHide": true
                        },
                        "htmlOnPauseBlock": {
                            "html": null,
                            "height": null,
                            "width": null
                        },
                        "autoPlay": true,
                        "mute": false,
                        "hideWithControls": false,
                        "allowTheatre": true,
                        "playPauseAnimation": true,
                        "playbackRateEnabled": false,
                        "allowDownload": false,
                        "playButtonShowing": true,
                        "fillToContainer": true,
                        "posterImage": ""
                    },
                    "vastOptions": {
                        "adList": [],
                        "adCTAText": false,
                        "adCTATextPosition": ""
                    }
                });

        </script>
    @endif

    <script src="{{asset('public/frontend/infixlmstheme/js/class_details.js')}}"></script>
    <script src="{{asset('public/frontend/infixlmstheme/js/full_screen_video.js')}}"></script>
    @if ($lesson->is_quiz==1)
        @if(!$result)
            <script src="{{ asset('public/frontend/infixlmstheme/js/quiz_start.js') }}"></script>
        @endif
    @endif


@endpush

