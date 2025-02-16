@extends('admin.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Annual Maintenance Contract (AMC)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">AMC </li>
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
                            <a href="{{ url('admin/amc/add') }}" class="btn btn-primary">Add New AMC</a>
                        </h5>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Business Category</th>
                                    <th>Series</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($getrecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ number_format($value->amount, 2) }}</td>
                                    <td>{{ !empty($value->business_category) ? 'Non-Business' : 'Business' }}</td>
                                    <td>{{ $value->series }}</td>
                                    <td>
                                        <a href="{{ url('admin/amc/add_ons/'. $value->id) }}" class="btn btn-warning">
                                            Add-ons
                                        </a>
                                        <a href="{{ url('admin/amc/free_service/'. $value->id) }}" class="btn btn-info">
                                            Free Service
                                        </a>
                                        <a href="{{ url('admin/amc/edit/'. $value->id) }}" class="btn btn-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete?')" href="{{ url('admin/amc/delete/'.$value->id) }}" class="btn btn-danger">
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

