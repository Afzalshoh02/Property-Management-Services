@extends('user.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Book Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Book Service List</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                @include('_message')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ url('user/book_service/add') }}" class="btn btn-primary">Add New Book
                                Service</a>
                        </h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Service ID</th>
                                    <th>Date of Service Request</th>
                                    <th>Type of Service</th>
                                    <th>Service Category</th>
                                    <th>Service Assigned To</th>
                                    <th>AMC Free Service</th>
                                    <th>Service Completion Date</th>
                                    <th>Expert Comments</th>
                                    <th>Payment Details</th>
                                    <th>Customer Feedback</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($getrecord as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->available_date)) }}</td>
                                        <td>{{ $value->get_service_type_name->name ?? '' }}</td>
                                        <td>{{ $value->get_category_name->name ?? '' }}</td>
                                        <td>{{ $value->get_sub_category_name->name ?? '' }}</td>
                                        <td>{{ $value->get_amc_free_service->name ?? '' }}</td>
                                        <td>{{ $value->expert_comments }}</td>
                                        <td>
                                            @if($value->status == 1)
                                                Waiting
                                            @elseif($value->status == 0)
                                                Pending
                                            @elseif($value->status == 2)
                                                Confirm
                                            @elseif($value->status == 3)
                                                Reject
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
{{--                                        <td>--}}
{{--                                            <a href="{{ url('user//edit/'. $value->id) }}"--}}
{{--                                               class="btn btn-success">--}}
{{--                                                <i class="bi bi-pencil-square"></i>--}}
{{--                                            </a>--}}
{{--                                            <a onclick="return confirm('Are you sure you want to delete?')"--}}
{{--                                               href="{{ url('admin/category/delete/'.$value->id) }}"--}}
{{--                                               class="btn btn-danger">--}}
{{--                                                <i class="bi bi-trash"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger text-center" colspan="100%">Record not fount.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $getrecord->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

@endsection
