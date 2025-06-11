@extends('backend.layout.dashboard_master')
@section('panel',$panel)
@section('title','Create ' . $panel)
@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tag_id').select2();
        });
    </script>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('main-content')

    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Accordion-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">Create {{$panel}}
                    <a href="{{ route($base_route. 'index') }}" class="btn btn-success">List {{$panel}}</a>

                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                @include('backend.includes.flash_message')
                <form enctype="multipart/form-data" action="{{ route($base_route . 'store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id"
                               class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tag_id">Tag List</label>
                        <select id="tag_id" name="tag_id[]"
                                class="form-control" multiple>
                            <option value="">Select Tag</option>
                            @foreach($tags as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        @error('tag_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    @include('backend.includes.input_field',['name' => 'title','title' => 'Title'])
                    @include('backend.includes.input_field',['name' => 'slug','title' => 'Slug'])
                    @include('backend.includes.input_field',['name' => 'price','title' => 'Price'])
                    @include('backend.includes.input_field',['name' => 'discount','title' => 'Discount'])
                    @include('backend.includes.input_field',['name' => 'descrition','title' => 'Description'])
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" type="file" name="image_file"
                               class="form-control"/>
                        @error('image_file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input id="status" type="radio" name="status"
                               value="1"/>Active
                        <input id="status" type="radio" name="status"
                               value="0"/>In-Active
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <input type="submit" value="Save {{ $panel }}" name="submit"
                               class="btn btn-success"/>
                        <input type="reset" name="clear"
                               class="btn btn-danger" value="Clear"/>
                    </div>
                </form>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Accordion-->

    </div>

@endsection
