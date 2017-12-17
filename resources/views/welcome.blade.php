@extends('layouts.logged-out')

@section('content')

<div class="wrapper">
    <div class="page-header" style="background-image: url('website/img/cover.jpg')">
        <div class="filter"></div>
        <div class="content-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 ml-auto text-center">
                        <h2 class="title">Day Care Management System</h2>
                        <h4>For Parents And Daycare Owners</h4>
                        <h5>child activity reports, billing, photo albums and more...</h5>
                        <br />
                        <div class="buttons">

                            <a href="#pablo" class="btn btn-neutral btn-link btn-lg">
                                <i class="fa fa-share-alt"></i> Share Offer
                            </a>
                            <a href="#pablo" class="btn btn-success btn-round btn-lg">
                                <i class="fa fa-shopping-cart"></i> Shop Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="features-1">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <h2 class="title">Why our product is the best</h2>
                    <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here.</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-palette"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Beautiful Gallery</h4>
                            <p class="description">Spend your time generating new ideas. You don't have to think of implementing.</p>
                            <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-bulb-63"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">New Ideas</h4>
                            <p>Larger, yet dramatically thinner. More powerful, but remarkably power efficient.</p>
                            <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-chart-bar-32"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Statistics</h4>
                            <p>Choose from a veriety of many colors resembling sugar paper pastels.</p>
                            <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info">
                        <div class="icon icon-danger">
                            <i class="nc-icon nc-sun-fog-29"></i>
                        </div>
                        <div class="description">
                            <h4 class="info-title">Delightful design</h4>
                            <p>Find unique and handmade delightful designs related items directly from our sellers.</p>
                            <a href="#pkp" class="btn btn-link btn-danger">See more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pricing-4 section section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="title">Pick the best plan for you</h2>
                    <h5 class="description">You have Free Unlimited Updates and Premium Support on each package.</h5>
                </div>
            </div>
            <div class="space-top"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-pricing">
                        <div class="card-body">
                            <h6 class="card-category text-primary">@lang('STANDARD')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(10.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}" class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing" data-color="orange">
                        <div class="card-body">
                            <h6 class="card-category text-success">@lang('PROFESSIONAL')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(20.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}" class="btn btn-neutral btn-round">@lang('START YOUR FREE TRIAL')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing">
                        <div class="card-body">
                            <h6 class="card-category text-primary">@lang('PREMIUM')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(35.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}" class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
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
                <h2 class="title">Trusted by 232,000+ People</h2>
                <h5 class="description">The UI Kits, Templates and Dashboards that we've created are used by <b>232,000+ web developers</b> in over <b>400,000 Web Projects</b>. This is what some of them think:</h5>
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
                                        <img class="img" src="website/img/128.jpg" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-description">
                                        "I'm newer to the front-end... With my creative side lacking in experience this really put me in the right spot to speed through the fast lane. I love this Design kit so much!"
                                        </h5>
                                        <div class="card-footer">
                                            <h4 class="card-title">Chase Jackson</h4>
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
                        <a class="left carousel-control carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                            <span class="sr-only">Next</span>
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
                    <img src="website/img/demo/vodafone.jpg" alt="" />
                </div>
                <div class="col-md-2 col-5">
                    <img src="website/img/demo/microsoft.jpg" alt="" />
                </div>
                <div class="col-md-2 col-5">
                    <img src="website/img/demo/harvard.jpg" alt="" />
                </div>
                <div class="col-md-2 col-5">
                    <img src="website/img/demo/stanford.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>


</div>


