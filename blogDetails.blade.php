@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{$blog->title??''}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')
    <!-- blog_details_area::start  -->
    <div class="blog_details_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ">
                    <!-- single_blog_details  -->
                    <div class="single_blog_details">
                        <div class="row">
                            <div class="col-xl-8 offset-lg-1">
                                <div class="blog_title">
                                    <span>{{$blog->user->name}} .  {{ showDate(@$blog->authored_date ) }}</span>
                                    <h3 class="mb-0">{{$blog->title}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="blog_details_banner">
                            <img class="w-100" src="{{getBlogImage($blog->image)}}" alt="">
                        </div>
                        <div class="row">
                            <div class="col-xl-9 offset-lg-1">
                                <p class="mb_25">

                                    {!! $blog->description !!}
                                </p>
                                <br>
                                <div class="social_btns">
                                    <a target="_blank"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
                                       class="social_btn fb_bg"> <i class="fab fa-facebook-f"></i>
                                        Facebook</a>
                                    <a target="_blank"
                                       href="https://twitter.com/intent/tweet?text={{$blog->title}}&amp;url={{URL::current()}}"
                                       class="social_btn Twitter_bg"> <i
                                            class="fab fa-twitter"></i> {{__('frontend.Twitter')}}</a>
                                    <a target="_blank"
                                       href="https://pinterest.com/pin/create/link/?url={{URL::current()}}&amp;description={{$blog->title}}"
                                       class="social_btn Pinterest_bg"> <i
                                            class="fab fa-pinterest-p"></i> {{__('frontend.Pinterest')}}</a>
                                    <a target="_blank"
                                       href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::current()}}&amp;title={{$blog->title}}&amp;summary={{$blog->title}}"
                                       class="social_btn Linkedin_bg"> <i
                                            class="fab fa-linkedin-in"></i> {{__('frontend.Linkedin')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog_details_area::end  -->


@endsection
