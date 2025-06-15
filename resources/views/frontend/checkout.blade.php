@extends('frontend.layouts.master')
@section('main-content')

    <div class="col-lg-12 d-none d-lg-block mt-5">
        <h2>Checkout Page</h2>
        @include('backend.includes.flash_message')
        <h3>List of Items into Cart</h3>
        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>quantity</th>
                <th>Action</th>
            </tr>
            @foreach($cart_items as $item)
                <tr>
                    <td>{{\App\Models\Food::find($item->itemable_id)->title}}</td>
                    <td>{{\App\Models\Food::find($item->itemable_id)->price}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>Action</td>
                </tr>
            @endforeach
        </table>
        <a href="{{route('frontend.checkout')}}" class="btn btn-primary">Checkout</a>
    </div>

@endsection
