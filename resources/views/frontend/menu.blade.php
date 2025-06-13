@extends('frontend.layouts.master')
@section('main-content')

    <!-- Menu Start -->
    <div class="menu">
        <div class="container">
            <div class="section-header text-center">
                <p>Food Menu</p>
                <h2>Delicious Food Menu</h2>
            </div>
            <div class="menu-tab">
                <ul class="nav nav-pills justify-content-center">
                    @foreach($food_categories as $key => $category)
                        <li class="nav-item">
                            <a class="nav-link @if($key == 0) active @endif" data-toggle="pill" href="#{{$category->slug}}">{{$category->title}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    @foreach($food_categories as $key => $category)
                        <div id="{{$category->slug}}" class="container tab-pane @if($key == 0) active @endif">
                            <div class="row">
                                <div class="col-lg-7 col-md-12">
                                    @foreach($category->foods as $food)
                                        <div class="menu-item">
                                            <div class="menu-img">
                                                <img src="{{asset('assets/frontend/img/menu-burger.jpg')}}" alt="Image">
                                            </div>
                                            <div class="menu-text">
                                                <h3><span>{{$food->title}}</span> <strong>{{$food->price}}</strong></h3>
                                                <p>{{$food->description}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-5 d-none d-lg-block">
                                    <img src="{{asset('assets/backend/images/category/' . $category->image)}}" alt="Image">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div id="snacks" class="container tab-pane fade">
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-snack.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Corn Tikki - Spicy fried Aloo</span> <strong>$15.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-snack.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Bread besan Toast</span> <strong>$35.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-snack.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Healthy soya nugget snacks</span> <strong>$20.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-snack.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Tandoori Soya Chunks</span> <strong>$30.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 d-none d-lg-block">
                                <img src="{{asset('assets/frontend/img/menu-snack-img.jpg')}}" alt="Image">
                            </div>
                        </div>
                    </div>
                    <div id="beverages" class="container tab-pane fade">
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-beverage.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Single Cup Brew</span> <strong>$7.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="{{asset('assets/frontend/img/menu-beverage.jpg')}}" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Caffe Americano</span> <strong>$9.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="img/menu-beverage.jpg" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Caramel Macchiato</span> <strong>$15.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="img/menu-beverage.jpg" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Standard black coffee</span> <strong>$8.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                                <div class="menu-item">
                                    <div class="menu-img">
                                        <img src="img/menu-beverage.jpg" alt="Image">
                                    </div>
                                    <div class="menu-text">
                                        <h3><span>Standard black coffee</span> <strong>$12.00</strong></h3>
                                        <p>Lorem ipsum dolor sit amet elit. Phasel nec preti facil</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 d-none d-lg-block">
                                <img src="img/menu-beverage-img.jpg" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu End -->

@endsection
