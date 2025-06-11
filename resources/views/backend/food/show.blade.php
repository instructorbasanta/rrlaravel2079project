@extends('backend.layout.dashboard_master')
@section('panel',$panel)
@section('title','View ' . $panel)
@section('main-content')

    <!--begin::Col-->
              <div class="col-md-12">
                <!--begin::Accordion-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">View {{$panel}}
                    <a href="{{ route($base_route . 'create') }}" class="btn btn-primary">Create {{$panel}}</a>
                    <a href="{{ route($base_route . 'index') }}" class="btn btn-success">List {{$panel}}</a>

                </div></div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body">
                    @include('backend.includes.flash_message')
                    <table class="table table-bordered">
                        <tr>
                            <th>Category</th>
                            <td>{{$record->category->title}}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{$record->title}}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>{{$record->price}}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{$record->slug}}</td>
                        </tr>
                        <tr>
                            <th>Created by</th>
                            <td>{{$record->createdBy->name}}</td>
                        </tr>
                        <tr>
                            <th>Updated by</th>
                            <td>{{$record->updatedBy->name}}</td>
                        </tr>
                        <tr>
                            <th>Tags</th>
                            <td>
                                <ul>
                                    @foreach($record->tags as $tag)
                                        <li>{{$tag->title}}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    </table>
                  </div>
                  <!--end::Body-->
                </div>
                <!--end::Accordion-->

              </div>

@endsection
