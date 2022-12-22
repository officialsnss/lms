@extends('frontend.infixlmstheme.layouts.master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('frontendmanage.Privacy Policy')}} @endsection
@section('css') @endsection
@section('js')
    <script src="{{asset('public/frontend/infixlmstheme/js/scrollIt.js')}}"></script>
@endsection

@section('mainContent')

    <!-- bradcam::start  -->
    @if($privacy_policy->page_banner_status==1)
        <div class="breadcrumb_area bradcam_bg_10"
             @if(!empty($privacy_policy->page_banner)) style="background-image: url('{{asset($privacy_policy->page_banner)}}')" @endif >
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 offset-lg-1">
                        <div class="breadcam_wrap ">
                            <span>{{$privacy_policy->page_banner_title}}</span>
                            <h3>{{$privacy_policy->page_banner_sub_title}}</h3>
                        </div>
                    </div>
                </div>
                <!-- CONTACT::START  -->
            </div>
        </div>
    @endif
    <!-- bradcam::end  -->

    <div class="contact_section ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="contact_address">
                        <div class="row justify-content-center">
                            <div class="col-xl-12">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12 p-5">

                                        <div class="address_lines py-3">
                                            {!! $privacy_policy->details !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
