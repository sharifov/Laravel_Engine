@extends('layouts.front') 

@section('content')

	<!-- Hero Area Start -->
	<section class="hero-area" style="background: url({{ $gs->banner ? asset('assets/images/'.$gs->banner):asset('assets/images/noimage.png') }});">
		@if($ps->slider == 1)
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 col-lg-8 col-md-10">

					@if(count($sliders) > 0)

					@include('includes.slider-style')

					<div class="hero-area-slider">

						@foreach($sliders as $slider)

						<div class="item">
							<div class="content left">
								<h1 class="title{{ $slider->id }}" style="font-size: {{ $slider->title_size }}px; color: {{ $slider->title_color }}">
									{{ $slider->title_text }}
								</h1>
								<div class="links">
									<a href="{{ $slider->link }}" target="_blank" class="link left">{{ $langg->lang8 }}</a>
								</div>
							</div>
						</div>

						@endforeach

					</div>

					@endif
				</div>
			</div>
		</div>
		@endif
	</section>
	<!-- Hero Area End -->

	@if($ps->service == 1)
	<!-- Features Area Start-->
	<section class="features">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="feature-area">
						<div class="row">

						@foreach($services as $service)	
							<div class="col-lg-3 col-md-6 padding-zero br-r">
								<div class="single-feature">
									<div class="icon">
										<img src="{{ asset('assets/images/services/'.$service->photo) }}" alt="">
									</div>
									<h4 class="title">
										{{ $service->title }}
									</h4>
								</div>
							</div>
						@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features Area End-->
	@endif

	@if($ps->featured == 1)

	<!-- About Area Start-->
	<section class="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex align-self-center">
					<div class="section-heading">
						<h5 class="sub-title">
							{!! $gs->service_subtitle !!}
						</h5>
						<h2 class="title extra-padding">
							{!! $gs->service_title !!}
						</h2>
						<p class="text">
							{!! $gs->service_text !!}
						</p>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="about-img">
						<img src="{{ asset('assets/images/'.$gs->service_image) }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features Area End-->
	@endif

	@if($ps->small_banner == 1)

	<!-- Video Area Start -->
	<section class="video" style="background: url({{ asset('assets/images/'.$ps->video_background) }});">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading color-white">
						<h5 class="sub-title">
							{{ $ps->video_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->video_title }}
						</h2>
						<p class="text">
								{{ $ps->video_text }}
						</p>
					</div>
				</div>
			</div>
			 <div class="row justify-content-center">
				 <div class="col-md-10">
					 <div class="video-box" style="background: url({{ asset('assets/images/'.$ps->video_image) }});">
							<a href="{{ $ps->video_link }}" class="video-play-btn mfp-iframe">
								<i class="fas fa-play"></i>
							</a>
					 </div>
				 </div>
			 </div>
		</div>
	</section>
	<!-- Video Area End -->

	@endif

	@if($ps->best == 1)

	<!-- Service Area Start -->
	<section class="service">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h5 class="sub-title">
								{{ $ps->service_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->service_title }}
						</h2>
						<p class="text">
								{{ $ps->service_text }} 
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($features as $data)
				<div class="col-lg-4 col-md-6">
					<div class="single-service">
						<div class="icon">
							<img src="{{ asset('assets/images/features/'.$data->photo) }}" alt="">
						</div>
						<div class="content">
							<h4 class="title">
									{{ $data->title }}
							</h4>
							<p>
									{!! $data->details !!}
							</p>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Service Area End -->

	@endif

	@if($ps->top_rated == 1)

	<!-- Portfolio Area Start -->
	<section class="portfolio">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading color-white">
						<h5 class="sub-title">
								{{ $ps->portfolio_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->portfolio_title }}
						</h2>
						<p class="text">
								{{ $ps->portfolio_text }} 
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($portfolios as $data)
				<div class="col-lg-4 col-md-6">
					<div class="single-portfolio">
						<img src="{{ asset('assets/images/portfolio/'.$data->photo) }}" alt="">
						<div class="content-wrapper">
							<div class="content">
								<h4 class="title">
									{{ $data->title }}
								</h4>
								<div class="links">
									<a href="{{ asset('assets/images/portfolio/'.$data->photo) }}" class="link img-popup">
										<i class="far fa-eye"></i>
									</a>
									<a href="{{ $data->link }}" class="link">
										<i class="fas fa-link"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Portfolio Area End -->

	@endif


@if($ps->pricing_plan)

<section class="pricing">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h5 class="sub-title">
							{{ $gs->price_subtitle }}
						</h5>
						<h2 class="title">
							{{ $gs->price_title }}
						</h2>
						<p class="text">
							{{ $gs->price_text }}
						</p>
					</div>
				</div>
			</div>



@php 

$is_second = false;

@endphp

@foreach($products->chunk(3) as $chunk)

			<div class="row {{ $is_second ? 'pt-3' : '' }}">

			@foreach($chunk as $prod)

				<div class="col-lg-4">
					<div class="single-plan">
						<div class="header">
							<h4 class="title">
								{{ $prod->title }}
							</h4>
							<p class="sub-title">
								{{ $prod->subtitle }}
							</p>
						</div>
						<div class="price">
							<p class="num">
								{!! $prod->showPrice() !!}
							</p>
							<span class="time">/ {{ $prod->type }}</span>
						</div>
						<div class="content-text">
							{!! $prod->details !!}
						</div>
						<a href="{{ route('front.checkout',$prod->id) }}" class="mybtn1">
							{{ $langg->lang10 }}
						</a>
					</div>
				</div>

			@endforeach

@php 

$is_second = true;

@endphp

			</div>

			@endforeach


		</div>

	</section>

@endif


	@if($ps->large_banner == 1)

	<!-- Statistics Area Start -->
	<section class="statistics">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading color-white">
						<h5 class="sub-title">
								{{ $ps->p_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->p_title }}
						</h2>
						<p class="text">
								{{ $ps->p_text }} 
						</p>
					</div>
				</div>
			</div>
			<div class="row">


				@foreach($present as $data)
				<div class="col-lg-3 col-md-6">
					<div class="single-statistics">
						<div class="icon">
							<img src="{{ asset('assets/images/vpresentation/'.$data->photo) }}" alt="">
						</div>
						<p class="title">
							{{ $data->title }}
						</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Statistics Area End -->

	@endif




	@if($ps->big == 1)

	<!-- Team Area Start -->
	<section class="team">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h5 class="sub-title">
								{{ $ps->team_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->team_title }}
						</h2>
						<p class="text">
								{{ $ps->team_text }} 
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				@foreach($members as $data)
				<div class="col-lg-3 col-md-6">
					<div class="single-team">
						<div class="img">
							<img src="{{ asset('assets/images/member/'.$data->photo) }}" alt="">
						</div>
						<div class="content">
							<h4 class="title">
								{{ $data->title }}
							</h4>
							<p class="designation">
								{{ $data->subtitle }}
							</p>
							<ul class="social-links">
								@if($data->facebook != null)
								<li>
									<a href="{{ $data->facebook }}">
										<i class="fab fa-facebook-f"></i>
									</a>
								</li>
								@endif
								@if($data->twitter != null)
								<li>
									<a href="{{ $data->twitter }}">
										<i class="fab fa-twitter"></i>
									</a>
								</li>
								@endif
								@if($data->linkedin != null)
								<li>
									<a href="{{ $data->linkedin }}">
										<i class="fab fa-linkedin-in"></i>
									</a>
								</li>
								@endif
							</ul>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- Team Area End -->

	@endif

	@if($ps->hot_sale == 1)

<!-- Testimonial Area Start -->
<section class="testimonial">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="section-heading color-white">
						<h5 class="sub-title">
								{{ $ps->review_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->review_title }}
						</h2>
						<p class="text">
								{{ $ps->review_text }} 
						</p>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-10">
				<div class="testimonial-slider">

					@foreach($reviews as $review)

					<div class="single-testimonial">
							<div class="review-text">
								<p>{{ $review->details }}</p>
							</div>
							<div class="people">
								<div class="img">
										<img src="{{ asset('assets/images/reviews/'.$review->photo) }}" alt="">
								</div>
								<h4 class="title">{{ $review->title }}</h4>
								<p class="designation">{{  $review->subtitle }}</p>
							</div>
					</div>

					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>
<!-- Testimonial Area End -->

	@endif

	@if($ps->review_blog == 1)


<!-- Blog Area Start -->
<section class="blog">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="section-heading">
						<h5 class="sub-title">
								{{ $ps->blog_subtitle }}
						</h5>
						<h2 class="title">
								{{ $ps->blog_title }}
						</h2>
						<p class="text">
								{{ $ps->blog_text }} 
						</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="blog-slider">

					@foreach($lblogs as $blog)

					<div class="single-blog">
						<div class="img">
							<img src="{{ asset('assets/images/blogs/'.$blog->photo) }}" alt="">
						</div>
						<div class="content">
							<h4 class="title">
								{{ $blog->title }}
							</h4>
							<ul class="top-meta">
								<li>
									<a href="{{ route('front.blogshow',$blog->id) }}">
											<i class="far fa-calendar"></i> {{  date('d M, Y',strtotime($blog->created_at)) }}
									</a>
								</li>
								<li>
									<a href="#">
											<i class="far fa-eye"></i> {{ $blog->views }}
									</a>
								</li>
							</ul>
							<div class="text">
								<p>
									{{substr(strip_tags($blog->details),0,120)}}
								</p>
							</div>
							<a href="{{ route('front.blogshow',$blog->id) }}" class="link">{{ $langg->lang9 }} <i class="fas fa-chevron-right"></i></a>
						</div>
					</div>

					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Blog Area End -->

	@endif

@endsection
