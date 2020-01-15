@extends('layouts.front')
@section('content')

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
{{--                    <h1 class="pagetitle">--}}
{{--                        {{ $page->title }}--}}
{{--                    </h1>--}}
                    <h1 class="pagetitle">
                       Haqqımızda
                    </h1>

                    <ul class="pages">

                        <li>
{{--                            <a href="{{ route('front.index') }}">--}}
{{--                                Home--}}
{{--                            </a>--}}
                        </li>
                        <li>
{{--                            <a href="{{ route('front.page',$page->slug) }}">--}}
{{--                                {{ $page->title }}--}}
{{--                            </a>--}}
                            <a href="#">
                               {{$page->title}}
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <section class="about">
        <div class="container">
            @if($sliders)
            <div class="about-carousel">
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
                <div class="col-lg-12">
                    <div class="about-info">
{{--                        <h4 class="title">--}}
{{--                            {{ $page->title }}--}}
{{--                        </h4>--}}
{{--                        <p>--}}
{{--                            {!! $page->details !!}--}}
{{--                        </p>--}}
                        <h4 class="title">
                            {{$page->title}}
                        </h4>
                        <!-- <div class="video-iframe"><iframe width="100%" height="450" src="https://www.youtube.com/embed/n9Vk1EnwkYQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div> -->
                        
                        {!!$page->details!!}

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection