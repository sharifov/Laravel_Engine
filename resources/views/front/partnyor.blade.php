@extends('layouts.front')
@section('content')

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="pagetitle">
                        {{$title}}
                    </h1>

                    <ul class="pages">

                        <li>
                            <a href="{{ route('front.index') }}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('front.part') }}">
                                {{$title}}
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
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-10">
                    <div class="section-heading">
                        <h5 class="sub-title">
                            {{$ps->team_subtitle}}
                        </h5>
                        <h2 class="title">
                            {{$ps->team_title}}
                        </h2>
                        <p class="text">
                            {{$ps->team_text}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($members as $member)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-team">
                            <a href="{{route('front.partshow', $member->company_name)}}">
                                <div class="img">
                                    <img src="{{asset('assets/images/member/'.$member->photo)}}" alt="">
                                </div>
                            </a>
                            <div class="content">
                                <a href="{{route('front.partshow', $member->company_name)}}">
                                    <h4 class="title">
                                        {{$member->company_name}}
                                    </h4>
                                </a>
                                <!-- <p class="designation">
                                    CEO of Apple
                                </p> -->
                                <ul class="social-links">
                                    <li>
                                        <a href="{{$member->facebook}}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{$member->twitter}}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{$member->linkedin}}">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
