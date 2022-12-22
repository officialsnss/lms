@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontend.Blogs')}} @endsection
@section('css') @endsection
@section('js') @endsection

@section('mainContent')

    <!-- bradcam::start  -->
    <div class="breadcrumb_area bradcam_bg_10"
         @if(!empty($frontendContent->blog_page_banner)) style="background-image: url('{{asset($frontendContent->blog_page_banner)}}')" @endif >
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-1">
                    <div class="breadcam_wrap ">
                        <span>{{$frontendContent->blog_page_title}}</span>
                        <h3>{{$frontendContent->blog_page_sub_title}}</h3>
                    </div>
                </div>
            </div>
            <!-- CONTACT::START  -->
        </div>
    </div>
    <!-- bradcam::end  -->
    <!-- bradcam::end  -->

    <!-- blog_page_wrapper ::start  -->
    <div class="blog_page_wrapper">
        <div class="container">
            <div class="row">
                @if(isset($blogs))
                    @foreach($blogs as $blog)
                        <div class="col-lg-6">
{{--                                                        <div class="single_blog">--}}
{{--                                                            <a href="{{route('blogDetails',[$blog->slug])}}" class="thumb">--}}
{{--                                                                <img src="{{getBlogImage($blog->thumbnail)}}" alt="" class="w-100">--}}
{{--                                                            </a>--}}
{{--                                                            <div class="blog_meta">--}}
{{--                                                                <span>{{$blog->user->name}} . {{ showDate(@$blog->authored_date) }}</span>--}}

{{--                                                                <a href="{{route('blogDetails',[$blog->slug])}}">--}}
{{--                                                                    <h4>{{$blog->title}}</h4>--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}


                         <div class="single_blog">
                                <a href="{{route('blogDetails',[$blog->slug])}}">
                                    <div class="thumb">

                                        <div class="thumb_inner lazy"
                                             data-src="{{getBlogImage($blog->thumbnail)}}">
                                        </div>
                                    </div>
                                </a>
                                <div class="blog_meta">
                                    <span>{{$blog->user->name}} . {{ showDate(@$blog->authored_date ) }}</span>

                                    <a href="{{route('blogDetails',[$blog->slug])}}">
                                        <h4>{{$blog->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            {{ $blogs->appends(Request::all())->links() }}
        </div>
    </div>
    <!-- blog_page_wrapper ::end  -->


@endsection
