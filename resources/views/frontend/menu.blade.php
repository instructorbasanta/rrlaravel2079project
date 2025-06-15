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
                    <div class="col-lg-12 d-none d-lg-block mt-5">
                        <h2>Add to Cart</h2>
                        @include('backend.includes.flash_message')
                        <form action="{{route('frontend.add_to_cart')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="food_id">Food Name</label>
                                <select name="food_id" id="food_id" class="form-control">
                                    <option value="">Select Food</option>
                                    @foreach($data['foods'] as $key => $food)
                                        <option value="{{$key}}">{{$food}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="food_id">Quantity</label>
                                <input class="form-control" id="quantity" name="quantity" min="0" max="100" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Add to Cart"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu End -->

@endsection
