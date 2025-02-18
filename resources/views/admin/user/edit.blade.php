@extends('admin.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Edit User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>

                        <form action="{{ url('admin/user/edit/'.$getrecord->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User First Name <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" required value="{{ $getrecord->name }}">
                                    <span style="color: red">{{ $errors->first('name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User Last Name <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" class="form-control" value="{{ $getrecord->last_name }}">
                                    <span style="color: red">{{ $errors->first('last_name') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User Email <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" required value="{{ $getrecord->email }}">
                                    <span style="color: red">{{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User Mobile <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="mobile" class="form-control" value="{{ $getrecord->mobile }}">
                                    <span style="color: red">{{ $errors->first('mobile') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User Profile <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="file" name="profile" class="form-control">
                                    @if(!empty($getrecord->profile))
                                        <img src="{{ $getrecord->getImage() }}" style="height: 50px; width: 50px;">
                                    @endif
                                    <span style="color: red">{{ $errors->first('profile') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">User Address <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input type="email" name="address" class="form-control" value="{{ $getrecord->address }}">
                                    <span style="color: red">{{ $errors->first('address') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">AMC Name <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="amc_id" id="SelectAMCBusinessCategory" readonly="">
                                        <option value="">Select AMC Name</option>
                                        @foreach($getAMC as $value_amc)
                                            <option {{ ($value_amc->id == $getrecord->amc_id) ? 'selected' : '' }} data-val="{{ $value_amc->business_category }}" value="{{ $value_amc->id }}">{{ $value_amc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3" id="ShowDiv"
                                 style="@if($getrecord->amc_business_category_name == '') display: none @endif">
                                <label class="col-sm-2 col-form-label">Amc Business Category Name <span style="color: red"></span></label>
                                <div class="col-sm-10">
                                    <input readonly type="text" name="amc_business_category_name" class="form-control" value="{{ $getrecord->amc_business_category_name }}">
                                    <span style="color: red">{{ $errors->first('amc_business_category_name') }}</span>
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
        $('#SelectAMCBusinessCategory').on('change', function () {
            var HideAndShow = $('option:selected', this).attr('data-val');
            if (HideAndShow == 0) {
                $('#ShowDiv').show().find(':input').attr('required', true);
            } else {
                $('#ShowDiv').hide().find(':input').attr('required', false);
            }
        });
    </script>
@endsection
