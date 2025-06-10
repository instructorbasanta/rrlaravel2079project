@extends('backend.layout.dashboard_master')
@section('panel',$panel)
@section('title','Edit ' . $panel)
@section('main-content')

    <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Accordion-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Edit {{$panel}}
                    <a href="{{ route($base_route . 'index') }}" class="btn btn-success">List {{$panel}}</a>

                </div></div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body">
                    @include('backend.includes.flash_message')
                    <form enctype="multipart/form-data" action="{{ route($base_route . 'update',$record->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select id="category_id" name="category_id"
                                    class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{$key}}" @if($key== $record->category_id) selected @endif > {{$value}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        @include('backend.includes.input_field',['name' => 'title','title' => 'Title','data'  => $record->title])
                        @include('backend.includes.input_field',['name' => 'slug','title' => 'Slug','data'  => $record->slug])
                        @include('backend.includes.input_field',['name' => 'price','title' => 'Price','data'  => $record->price])
                        @include('backend.includes.input_field',['name' => 'price','title' => 'Discount','data'  => $record->discount])
                        @include('backend.includes.input_field',['name' => 'descrition','title' => 'Description','data'  => $record->description])
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="image" type="file" name="image_file"
                                class="form-control"  />
                            @error('image_file')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="status">Status</label>
                             @if($record->status == 1)
                                <input id="status" type="radio" name="status"
                               value="1" checked />Active
                               <input id="status" type="radio" name="status"
                               value="0"  />In-Active
                             @else
                                 <input id="status" type="radio" name="status"
                                        value="1"  />Active
                                 <input id="status" type="radio" name="status"
                                        value="0" checked />In-Active
                             @endif

                            @error('status')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Feature Food Key</label>
                            @if($record->feature_foood == 1)
                                <input id="feature_foood" type="radio" name="feature_foood"
                                       value="1" checked />Active
                                <input id="feature_foood" type="radio" name="feature_foood"
                                       value="0"  />In-Active
                            @else
                                <input id="feature_foood" type="radio" name="feature_foood"
                                       value="1"  />Active
                                <input id="feature_foood" type="radio" name="feature_foood"
                                       value="0" checked />In-Active
                            @endif

                            @error('feature_foood')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <input type="submit" value="Update {{ $panel }}" name="submit"
                                class="btn btn-success" />
                                 <input type="reset" name="clear"
                                class="btn btn-danger"  value="Clear"/>
                        </div>
                    </form>
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Accordion-->

              </div>

@endsection
