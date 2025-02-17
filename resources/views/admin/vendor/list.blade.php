@extends('admin.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Vendor List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Vendor</li>
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
                            <a href="{{ url('admin/vendor/add') }}" class="btn btn-primary">Add New Vendor</a>
                        </h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Profile</th>
                                    <th>Vendor Type Name</th>
                                    <th>Company Name</th>
                                    <th>Employee ID</th>
                                    <th>Category Name</th>
                                    <th>Always Assign</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($getrecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->mobile }}</td>
                                    <td>
                                        @if(!empty($value->profile))
                                            @if(file_exists('uploads/profile/'.$value->profile))
                                                <img src="{{ url('uploads/profile/'.$value->profile) }}" style="height: 50px; width: 50px;">
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ !empty($value->vendor_type_name) ? $value->vendor_type_name : '' }}</td>
                                    <td>{{ $value->company_name }}</td>
                                    <td>{{ $value->employee_id }}</td>
                                    <td>{{ !empty($value->category_name) ? $value->category_name : '' }}</td>
                                    <td>
                                        @if($value->always_assign == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>
                                        @if($value->status == 1)
                                            InActive
                                        @else
                                            Active
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/vendor/edit/'. $value->id) }}" class="btn btn-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/vendor/delete/'.$value->id) }}" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-danger text-center" colspan="100%">Record not fount.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $getrecord->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

