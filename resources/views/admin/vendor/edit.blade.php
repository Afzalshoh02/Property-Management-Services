@extends('admin.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Edit Vendor</h1>
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Vendor</h5>

                        <form action="{{ url('admin/vendor/edit/'.$getrecord->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor First Name <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required value="{{ $getrecord->name }}">
                                    <span style="color: red">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor Last Name <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" class="form-control" value="{{ $getrecord->last_name }}">
                                    <span style="color: red">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor Email <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" required value="{{ $getrecord->email }}">
                                    <span style="color: red">{{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor Mobile <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="mobile" class="form-control" value="{{ $getrecord->mobile }}">
                                    <span style="color: red">{{ $errors->first('mobile') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor Profile <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="file" name="profile" class="form-control">
                                    <span style="color: red">{{ $errors->first('profile') }}</span>
                                    @if(!empty($getrecord->profile))
                                        @if(file_exists('uploads/profile/'.$getrecord->profile))
                                            <img src="{{ url('uploads/profile/'.$getrecord->profile) }}" style="height: 50px; width: 50px;">
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Vendor Type <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="vendor_type_id" required id="SelectCompanyHideShow">
                                        <option value="">Select Vendor Type</option>
                                        @foreach($getVendorType  as $value)
                                            <option {{ ($value->id == $getrecord->vendor_type_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3" id="showDiv"
                                 style="@if($getrecord->vendor_type_id == 2 || $getrecord->vendor_type_id == 3) display: none @endif">
                                <label class="col-sm-2 col-form-label">Company Name <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="company_name" class="form-control" value="{{ $getrecord->company_name }}">
                                    <span style="color: red">{{ $errors->first('company_name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3" id="showDivEmployee"
                                 style="@if($getrecord->vendor_type_id == 2 || $getrecord->vendor_type_id == 1) display: none @endif">
                                <label class="col-sm-2 col-form-label">Employee Id <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="employee_id" class="form-control" value="{{ $getrecord->employee_id }}">
                                    <span style="color: red">{{ $errors->first('employee_id') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id" required>
                                        <option value="">Select Category Name</option>
                                        @foreach($getCategory as $value_category)
                                            <option {{ ($value_category->id == $getrecord->category_id) ? 'selected' : '' }} value="{{ $value_category->id }}">{{ $value_category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option {{ ($getrecord->status) == 0 ? 'selected' : '' }} value="0">Active</option>
                                        <option {{ ($getrecord->status) == 1 ? 'selected' : '' }} value="1">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Always Assign <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="always_assign" required>
                                        <option value="">Select Always Assign</option>
                                        <option {{ ($getrecord->always_assign) == 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ ($getrecord->always_assign) == 1 ? 'selected' : '' }} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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

@section('script')
    <script type="text/javascript">
        $('#SelectCompanyHideShow').on('change', function () {
            if (this.value == 1) {
                $('#showDiv').show().find(':input').attr('required', true);
                $('#showDivEmployee').hide().find(':input').attr('required', false);
            } else if(this.value == 2){
                $('#showDivEmployee').hide().find(':input').attr('required', true);
                $('#showDiv').show().find(':input').attr('required', false);
            } else {
                $('#showDivEmployee').hide().find(':input').attr('required', false);
                $('#showDiv').show().find(':input').attr('required', false);
            }
        })
    </script>
@endsection
