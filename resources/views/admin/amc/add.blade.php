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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add AMC</h5>

                        <form action="{{ url('admin/amc/add') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Name <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Amount <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="amount" class="form-control" required value="{{ old('amount') }}"
                                           oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                           maxlength="10">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Business Category <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="business_category">
                                        <option {{ old('business_category') == '0' ? 'selected' : "" }} value="0">Business</option>
                                        <option {{ old('business_category') == '1' ? 'selected' : "" }} value="1">Non-Business</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Series <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="series" class="form-control" required value="{{ old('series') }}"
                                           oninput="javascript: this.value = this.value.replace(/[^0-9]/g, ''); if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                           maxlength="10">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

