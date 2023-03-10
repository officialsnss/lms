@extends('frontend.infixlmstheme.layouts.dashboard_master')
@section('title'){{Settings('site_title')  ? Settings('site_title')  : 'Infix LMS'}} | {{__('coupons.My Cart')}} @endsection
@section('css') @endsection


@section('mainContent')
    <div class="cart_wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="new_cart_wrapper">
                        <h4>{{__('coupons.My Cart')}}</h4>

                        @if(count($carts)==0)
                            <div class="col-lg-12">
                                <h3 class="text-center text-secondary"> {{__('common.No Item found')}} <i
                                        class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </h3>
                            </div>
                        @else

                            @php $totalSum=0; @endphp

                            @if(isset($carts))
                                @foreach ($carts as $key=>$cart)
                                    @php
                                        if ($cart->course->discount_price!=null) {
                                           $price = $cart->course->discount_price;
                                       } else {
                                           $price = $cart->course->price;
                                       }
                                         $totalSum =  $totalSum + @$price;

                                    @endphp

                                    <div class="single_cart">
                                        <div class="product_name d-flex align-items-center">
                                            <a href="{{route('removeItem',[$cart->id])}}">
                                                <div class="">

                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                         viewBox="0 0 16 16">
                                                        <path data-name="Path 174" d="M0,0H16V16H0Z" fill="none"/>
                                                        <path data-name="Path 175"
                                                              d="M14.95,6l-1-1L9.975,8.973,6,5,5,6,8.973,9.975,5,13.948l1,1,3.973-3.973,3.973,3.973,1-1L10.977,9.975Z"
                                                              transform="translate(-1.975 -1.975)" fill="#fb1159"/>
                                                    </svg>
                                                </div>
                                            </a>
                                            <div class="thumb">
                                                <img src="{{asset($cart->course->thumbnail)}}" alt="">
                                            </div>
                                            <span>
                                            <a href="{{route('courseDetailsView',[@$cart->id,@$cart->course->slug])}}">
                                            <h5>{{@$cart->course->title}}</h5></a>
                                        </span>
                                        </div>

                                        <div class="f_w_400">{{getPriceFormat($price)}}</div>

                                    </div>
                                @endforeach
                            @endif



                        @endif
                    </div>
                    <div class="cart_table_wrapper mb-0">
                        @if(count($carts)!=0)
                            <div class="row mt_30">
                                <div class="col-12 text-right">
                                    <a href="{{route('CheckOut')}}"
                                       class="theme_btn">{{__('student.Proceed to checkout')}}</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- category::end  -->
@endsection

