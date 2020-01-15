@extends('layouts.front')





@section('content')



  <!-- Breadcrumb Area Start -->

  <div class="breadcrumb-area position-relative" style="background: url({{ $gs->breadcumb_banner ? asset('assets/images/'.$gs->breadcumb_banner):asset('assets/images/noimage.png') }});">

    <div class="container">

      <div class="row">

        <div class="col-lg-12">

          <h1 class="pagetitle">

            {{ $langg->lang7 }}

          </h1>

          <ul class="pages">

              <li>

                <a href="{{ route('front.index') }}">

                  {{ $langg->lang2 }}

                </a>

              </li>

              <li>

                <a href="{{ route('front.contact') }}">

                  {{ $langg->lang7 }}

                </a>

              </li>



          </ul>

        </div>

      </div>

    </div>

  </div>

  <!-- Breadcrumb Area End -->



    <!-- Contact Us Area Start -->

    <section class="contact-us">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="contact-section-title">

                            {!! $ps->contact_title !!}

                            <!-- {!! $ps->contact_text !!} -->

                    </div>

                </div>

            </div>

            <div class="row justify-content-between ">

                <div class="col-xl-9 col-lg-9 col-md-8 contact-row">

                    <div class="left-area">

                        <div class="contact-form">

                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>

                            <form id="contactform" action="{{route('front.contact.submit')}}" method="POST">

                                {{csrf_field()}}

                                    @include('includes.admin.form-both')  

                                    <ul>

                                        <li>

                                            <input type="text" name="name" class="input-field" placeholder="{{ $langg->lang23 }}" required="">

                                        </li>

                                        <li>

                                            <input type="text" name="surname" class="input-field" placeholder="{{ $langg->contact_surname }}" required="">

                                        </li>

                                        <li>

                                            <input type="text" name="company_name" class="input-field" placeholder="{{ $langg->contact_company }}" required="">

                                        </li>

                                        <li>

                                            <input type="text" name="position" class="input-field" placeholder="{{ $langg->contact_position }}" required="">

                                        </li>

                                        <li>

                                            <input type="text" name="phone" class="input-field" placeholder="{{ $langg->lang24 }}">

                                        </li>

                                        <li>

                                            <input type="email" name="email" class="input-field" placeholder="{{ $langg->lang25 }}" required="">

                                        </li>

                                        <li>

                                            <input type="text" name="website" class="input-field" placeholder="{{ $langg->contact_website}}" required="">

                                        </li>

                                        <li>

                                        <li>

                                            <textarea name="text" class="input-field textarea" placeholder="{{ $langg->lang26 }}" required=""></textarea>

                                        </li>

                                    </ul>

{{--                                    <ul class="captcha-area">--}}

{{--                                        <li>--}}

{{--                                            <p><img id="codeimg" src="{{asset("assets/images/capcha_code.png")}}" alt=""> <i class="fas fa-sync-alt pointer refresh_code"></i></p>--}}

{{--                                        --}}

{{--                                        </li>--}}

{{--                                        <li>--}}

{{--                                                <input name="codes" type="text" class="input-field" placeholder="{{ $langg->lang27 }}" required="">--}}

{{--                                                --}}

{{--                                            </li>--}}

{{--                                    </ul>--}}

                                    <input type="hidden" name="to" value="{{ $ps->contact_email }}">

                                    <button class="submit-btn" type="submit">{{ $langg->lang28 }}</button>

                            </form>

                        </div>

                    </div>

                </div>

{{--                <div class="col-xl-4 col-lg-5 col-md-6">--}}

{{--                    <div class="right-area">--}}

{{--                        <div class="top-content">--}}

{{--                                <h4 class="title">{!! $ps->side_title !!}</h4>--}}

{{--                                <p class="text">{!! $ps->side_text !!}</p>--}}

{{--                        </div>--}}





{{--                        @if($ps->site != null || $ps->email != null )--}}

{{--                        <div class="contact-info ">--}}

{{--                            <div class="left ">--}}

{{--                                    <div class="icon">--}}

{{--                                            <i class="fas fa-envelope"></i>--}}

{{--                                    </div>--}}

{{--                            </div>--}}

{{--                            <div class="content d-flex align-self-center">--}}

{{--                                <div class="content">--}}

{{--                                        @if($ps->site != null && $ps->email != null) --}}

{{--                                        <a href="{{$ps->site}}" target="_blank">{{$ps->site}}</a>--}}

{{--                                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>--}}

{{--                                        @elseif($ps->site != null)--}}

{{--                                        <a href="{{$ps->site}}" target="_blank">{{$ps->site}}</a>--}}

{{--                                        @else--}}

{{--                                        <a href="mailto:{{$ps->email}}">{{$ps->email}}</a>--}}

{{--                                        @endif--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                        @endif--}}

{{--                        @if($ps->street != null) --}}

{{--                        <div class="contact-info">--}}

{{--                                <div class="left">--}}

{{--                                        <div class="icon">--}}

{{--                                                <i class="fas fa-map-marker"></i>--}}

{{--                                        </div>--}}

{{--                                </div>--}}

{{--                                <div class="content d-flex align-self-center">--}}

{{--                                    <div class="content">--}}

{{--                                            <p>--}}

{{--                                                @if($ps->street != null) --}}

{{--                                                    {!! $ps->street !!}--}}

{{--                                                @endif--}}

{{--                                            </p>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                        @endif--}}

{{--                        @if($ps->phone != null || $ps->fax != null ) --}}

{{--                            <div class="contact-info">--}}

{{--                                    <div class="left">--}}

{{--                                            <div class="icon">--}}

{{--                                                    <i class="fas fa-phone"></i>--}}

{{--                                            </div>--}}

{{--                                    </div>--}}

{{--                                    <div class="content d-flex align-self-center">--}}

{{--                                        <div class="content">--}}

{{--                                            @if($ps->phone != null && $ps->fax != null)--}}

{{--                                            <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>--}}

{{--                                            <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>--}}

{{--                                            @elseif($ps->phone != null)--}}

{{--                                            <a href="tel:{{$ps->phone}}">{{$ps->phone}}</a>--}}

{{--                                            @else--}}

{{--                                            <a href="tel:{{$ps->fax}}">{{$ps->fax}}</a>--}}

{{--                                            @endif--}}

{{--                                        </div>--}}

{{--                                    </div>--}}

{{--                                </div>--}}

{{--                        @endif--}}





{{--                                <div class="social-links">--}}

{{--                                    <h4 class="title">{{ $langg->lang29 }} :</h4>--}}

{{--                                    <ul>--}}



{{--                                     @if(App\Models\Socialsetting::find(1)->f_status == 1)--}}

{{--                                      <li>--}}

{{--                                        <a href="{{ App\Models\Socialsetting::find(1)->facebook }}" class="facebook" target="_blank">--}}

{{--                                            <i class="fab fa-facebook-f"></i>--}}

{{--                                        </a>--}}

{{--                                      </li>--}}

{{--                                      @endif--}}



{{--                                      @if(App\Models\Socialsetting::find(1)->g_status == 1)--}}

{{--                                      <li>--}}

{{--                                        <a href="{{ App\Models\Socialsetting::find(1)->gplus }}" class="google-plus" target="_blank">--}}

{{--                                            <i class="fab fa-google-plus-g"></i>--}}

{{--                                        </a>--}}

{{--                                      </li>--}}

{{--                                      @endif--}}



{{--                                      @if(App\Models\Socialsetting::find(1)->t_status == 1)--}}

{{--                                      <li>--}}

{{--                                        <a href="{{ App\Models\Socialsetting::find(1)->twitter }}" class="twitter" target="_blank">--}}

{{--                                            <i class="fab fa-twitter"></i>--}}

{{--                                        </a>--}}

{{--                                      </li>--}}

{{--                                      @endif--}}



{{--                                      @if(App\Models\Socialsetting::find(1)->l_status == 1)--}}

{{--                                      <li>--}}

{{--                                        <a href="{{ App\Models\Socialsetting::find(1)->linkedin }}" class="linkedin" target="_blank">--}}

{{--                                            <i class="fab fa-linkedin-in"></i>--}}

{{--                                        </a>--}}

{{--                                      </li>--}}

{{--                                      @endif--}}



{{--                                      @if(App\Models\Socialsetting::find(1)->d_status == 1)--}}

{{--                                      <li>--}}

{{--                                        <a href="{{ App\Models\Socialsetting::find(1)->dribble }}" class="dribbble" target="_blank">--}}

{{--                                            <i class="fab fa-dribbble"></i>--}}

{{--                                        </a>--}}

{{--                                      </li>--}}

{{--                                      @endif--}}



{{--                                        </ul>--}}

{{--                                </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

            </div>

        </div>

    </section>

    <!-- Contact Us Area End-->







@endsection



@section('scripts')

    <script>

        $('.refresh_code').on( "click", function() {

            $.get('{{url('contact/refresh_code')}}', function(data, status){

                $('#codeimg').attr("src","{{url('assets/images')}}/capcha_code.png?time="+ Math.random());

            });

        })



    </script>

@stop