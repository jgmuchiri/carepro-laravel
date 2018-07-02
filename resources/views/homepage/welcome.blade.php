@extends('layouts.logged-out')

@section('content')
	<div class="wrapper">
		<div class="page-header">
			<div class="filter"></div>
			<div class="content-center">
				<div class="container">
					<div class="row">
						<div class="col-md-7 ml-auto text-center">
							<h2 class="title">{{config('app.description')}}</h2>
							<h4>A SAAS solution for Parents And Daycare Owners</h4>
							<h5>billing, child activity reports, photo albums and more...</h5>
							<br/>
							<div class="buttons">
								{{--<a href="#" class="btn btn-neutral btn-link btn-lg">--}}
								{{--<i class="fa fa-share-alt"></i> Share Offer--}}
								{{--</a>--}}
								<a href="#features" class="btn btn-success btn-round btn-lg">
									Learn more <i class="fa fa-chevron-down"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="features-1" id="features">
			<div class="container">
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto text-center">
						<h2 class="title">Daycare management simplified</h2>
						<h5 class="description">
							TykCare aims to make daycare management intuitive and simplified.
							Hassle free sign up gets you started in 5 minutes.
						</h5>
					</div>
				</div>
				<div class="row">

					<div class="col-md-3">
						<div class="info">
							<div class="icon icon-danger">
								<i class="fa fa-globe"></i>
							</div>
							<div class="description">
								<h4 class="info-title">Access data anywhere</h4>
								<p>
									You can easily manage your daycare remotely and access your data on the go.
									We provide high level encryption to ensure your data is always safe.
								</p>
								<a href="#" class="btn btn-link btn-danger">See more</a>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="info">
							<div class="icon icon-danger">
								<i class="fa fa-square-o"></i>
							</div>
							<div class="description">
								<h4 class="info-title">Clutter free</h4>
								<p>
									All the heavy lifting is done in the background so that you have a simplified
									interface and easy on eyes
								</p>
								<a href="#" class="btn btn-link btn-danger">See more</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<div class="icon icon-danger">
								<i class="fa fa-database"></i>
							</div>
							<div class="description">
								<h4 class="info-title">Continuous backups</h4>
								<p>
									We realize the importance of the data that you store in our servers and hence,
									we have implemented a smart backup technology that backups your account several
									times a day and when you data changes by a certain percentage.
								</p>
								<a href="#" class="btn btn-link btn-danger">See more</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="info">
							<div class="icon icon-danger">
								<i class="fa fa-users"></i>
							</div>
							<div class="description">
								<h4 class="info-title">@lang("Parent's portal")</h4>
								<p>
									Easily register you children, view child's activities, schedules, make bill
									payments and more.
								</p>
								<a href="#" class="btn btn-link btn-danger">See more</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="pricing-4 section section-gray" id="pricing">
			<div class="container">
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto text-center">
						<h2 class="title">Pick the best plan for you</h2>
						<h5 class="description">You have Continuous Updates and Premium Support on each
							package.</h5>
					</div>
				</div>
				<div class="space-top"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="card card-pricing">
							<div class="card-body">
								<h6 class="card-category text-primary">@lang('STANDARD')</h6>
								<small>14 @lang('days FREE trial')*</small>
								<h1 class="card-title">{{ currency(10.00, 'USD', true) }}
									<small>/@lang('mo')</small>
								</h1>
								<ul>
									<li>
										<b>
											{{ $plans->where('name', 'Standard')->first()->number_of_children_allowed }}
										</b>
										@lang('Children')
									</li>
									<li>
										<b>
											{{ $plans->where('name', 'Standard')->first()->number_of_staff_allowed }}
										</b>
										@lang('Staff Members')
									</li>
									<li>
										@if ($plans->where('name', 'Standard')->first()->has_invoice_due_alert_to_parents)
											@lang('Invoice due alerts to parents')
										@else
											<strike>@lang('Invoice due alerts to parents')</strike>
										@endif
									</li>
								</ul>
								<a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}"
								   class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-pricing" data-color="orange">
							<div class="card-body">
								<h6 class="card-category text-success">@lang('PROFESSIONAL')</h6>
								<small>14 @lang('days FREE trial')*</small>
								<h1 class="card-title">{{ currency(20.00, 'USD', true) }}
									<small>/@lang('mo')</small>
								</h1>
								<ul>
									<li>
										<b>
											{{ $plans->where('name', 'Professional')->first()->number_of_children_allowed }}
										</b>
										@lang('Children')
									</li>
									<li>
										<b>
											{{ $plans->where('name', 'Professional')->first()->number_of_staff_allowed }}
										</b>
										@lang('Staff Members')
									</li>
									<li>
										@if ($plans->where('name', 'Professional')->first()->has_invoice_due_alert_to_parents)
											@lang('Invoice due alerts to parents')
										@else
											<strike>@lang('Invoice due alerts to parents')</strike>
										@endif
									</li>
								</ul>
								<a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}"
								   class="btn btn-neutral btn-round">@lang('START YOUR FREE TRIAL')</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card card-pricing">
							<div class="card-body">
								<h6 class="card-category text-primary">@lang('PREMIUM')</h6>
								<small>14 @lang('days FREE trial')*</small>
								<h1 class="card-title">{{ currency(35.00, 'USD', true) }}
									<small>/@lang('mo')</small>
								</h1>
								<ul>
									<li>
										<b>
											{{ $plans->where('name', 'Premium')->first()->number_of_children_allowed }}
										</b>
										@lang('Children')
									</li>
									<li>
										<b>
											{{ $plans->where('name', 'Premium')->first()->number_of_staff_allowed }}
										</b>
										@lang('Staff Members')
									</li>
									<li>
										@if ($plans->where('name', 'Premium')->first()->has_invoice_due_alert_to_parents)
											@lang('Invoice due alerts to parents')
										@else
											<strike>@lang('Invoice due alerts to parents')</strike>
										@endif
									</li>
								</ul>
								<a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}"
								   class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="section section-testimonials">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8 ml-auto mr-auto text-center">
						<h2 class="title">Why they trust us</h2>
						<h5 class="description">
							Here is what some our subscribers are saying. Let us know if you would like to be part
							of an application that is revolutionizing daycare management online.
						</h5>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2 ml-auto">
		                <div class="testimonials-people">
		                    <img class="left-first-person add-animation" src="website/img/128.jpg" alt="" />
		                    <img class="left-second-person add-animation" src="website/img/129.jpg" alt="" />
		                    <img class="left-third-person add-animation" src="website/img/130.jpg" alt="" />
		                    <img class="left-fourth-person add-animation" src="website/img/132.png" alt="" />
		                    <img class="left-fifth-person add-animation" src="website/img/133.jpg" alt="" />
		                    <img class="left-sixth-person add-animation" src="website/img/134.jpg" alt="" />
		                </div>
		            </div>

					<div class="col-md-6">
						<div class="page-carousel">
							<div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
									<li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
									<li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
								</ol>
								<div class="carousel-inner" role="listbox">

									<div class="carousel-item active">
										<div class="card card-testimonial card-plain">
											<div class="card-avatar">
												<img class="img" src="website/img/129.jpg" />
											</div>
											<div class="card-body">
												<h5 class="card-description">
													We were looking for a daycare management platform that is not
													bloated with features and this is a straight forward solution to
													what
													we needed.
												</h5>
												<div class="card-footer">
													<h4 class="card-title">Peter</h4>
													<h6 class="card-category">@lang("Daycare owner")</h6>
													<div class="card-stars">
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
														<i class="fa fa-star" aria-hidden="true"></i>
													</div>
												</div>
											</div>

										</div>
									</div>
									 <div class="carousel-item">
		                                <div class="card card-testimonial card-plain">
		                                    <div class="card-avatar">
		                                        <img class="img" src="website/img/134.jpg" />
		                                    </div>
		                                    <div class="card-body">
		                                        <h5 class="card-description">
		                                        "Love the shapes and color palette on this one! Perfect for one of my pet projects!"
		                                        </h5>
		                                        <div class="card-footer">
		                                            <h4 class="card-title">Robin Leysen</h4>
		                                            <h6 class="card-category">Web Developer</h6>
		                                            <div class="card-stars">
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                            </div>
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>

		                            <div class="carousel-item">
		                                <div class="card card-testimonial card-plain">
		                                    <div class="card-avatar">
		                                        <img class="img" src="website/img/129.jpg" />
		                                    </div>
		                                    <div class="card-body">
		                                        <h5 class="card-description">
		                                        "Love it. Use it for prototypes and along with Paper Dashboard."
		                                        </h5>
		                                        <div class="card-footer">
		                                            <h4 class="card-title">Cristi Jora</h4>
		                                            <h6 class="card-category">Web Developer</h6>
		                                            <div class="card-stars">
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                                <i class="fa fa-star" aria-hidden="true"></i>
		                                            </div>
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>

								</div>
								<a class="left carousel-control carousel-control-prev"
								   href="#carouselExampleIndicators2" role="button" data-slide="prev">
									<span class="fa fa-angle-left"></span>
									<span class="sr-only">@lang("Previous")</span>
								</a>
								<a class="right carousel-control carousel-control-next"
								   href="#carouselExampleIndicators2" role="button" data-slide="next">
									<span class="fa fa-angle-right"></span>
									<span class="sr-only">@lang("Next")</span>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-2 mr-auto">
		                <div class="testimonials-people">
		                    <img class="right-first-person add-animation" src="website/img/135.jpeg" alt="" />
		                    <img class="right-second-person add-animation" src="website/img/129.jpg" alt="" />
		                    <img class="right-third-person add-animation" src="website/img/132.png" alt="" />
		                    <img class="right-fourth-person add-animation" src="website/img/130.jpg" alt="" />
		                    <img class="right-fifth-person add-animation" src="website/img/133.jpg" alt="" />
		                    <img class="right-sixth-person add-animation" src="website/img/134.jpg" alt="" />
		                </div>
		            </div>
				</div>
			</div>
			<div class="our-clients">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-2 col-5">
							<img src="website/img/microsoft.jpg" alt=""/>
						</div>
						<div class="col-md-2 col-5">
							<img src="website/img/microsoft.jpg" alt=""/>
						</div>
						<div class="col-md-2 col-5">
							<img src="website/img/microsoft.jpg" alt=""/>
						</div>
						<div class="col-md-2 col-5">
							<img src="website/img/microsoft.jpg" alt=""/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
