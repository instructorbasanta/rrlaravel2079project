@extends('backend.layout.dashboard_master')
@section('panel',$panel)
@section('title','List ' . $panel)
@section('main-content')
    <!--begin::Col-->
    <div class="col-md-12">
        <!--begin::Accordion-->
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">List {{$panel}}
                    <a href="{{ route('backend.category.create') }}" class="btn btn-primary">Create {{$panel}}</a>
                    <a href="{{ route('backend.category.trash') }}" class="btn btn-danger">{{$panel}} Trash</a>

                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                @include('backend.includes.flash_message')
                <table class="table table-bordered">
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Rank</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($records as $key => $record)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $record->title }}</td>
                            <td>{{ $record->rank }}</td>
                            <td>
                                @include('backend.includes.print_status',['status' => $record->status])
                            </td>
                            <td>
                                <a href="{{ route('backend.category.show',$record->id) }}" class="btn btn-info">View
                                    Details</a>
                                <a href="{{ route('backend.category.edit',$record->id) }}"
                                   class="btn btn-warning">Edit</a>
                                <form style="display: inline-block"
                                      action="{{route('backend.category.destroy',$record->id)}}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                    <input type="submit" value="Trash" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Accordion-->

    </div>

@endsection
