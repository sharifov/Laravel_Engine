@extends('layouts.front')
@section('content')

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="pagetitle">
                        {{ $member->company_name }}
                    </h1>

                    <ul class="pages">

                        <li>
                            <a href="{{ route('front.index') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.part') }}">
                                {{ $prev_title }}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <section class="team">
        <div class="container">
            @if($sliders)
                <div class="partshow-carousel">
                    <div class="owl-carousel owl-theme">
                        @foreach($sliders as $slider)
                            <div class="item">
                                <div class="carousel-img">
                                    {!!$slider!!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-6 col-xs-6 col-12">
                    <div class="section-heading">
                        {!! $member->details !!}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-6 col-12">
                    <div class="single-team single-part">
                        <div class="img">
                            <img src="{{asset('assets/images/member/'.$member->ceo)}}" alt="{{ $member->company_name }}">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                {{ $member->title }}
                            </h4>
                            <p class="designation">
                                {{ $member->subtitle }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection