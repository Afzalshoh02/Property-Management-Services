@extends('user.layouts.app')
@section('content')

    <div class="pagetitle">
        <h1>Book Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('user/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Book Service</li>
            </ol>
        </nav>
    </div>
    @include('_message')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Book Service</h5>

                        <form action="{{ url('user/book_service/add') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Service Type <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="service_type_id" required id="SelectServiceTypeHideShow">
                                        <option value="">Select Service Type</option>
                                        @foreach($getServiceType as $value)
                                            <option {{ (old('service_type_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red">{{ $errors->first('service_type_id') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3" id="hideDivCategory">
                                <label class="col-sm-2 col-form-label">Category <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category_id" id="category">
                                        <option value="">Select Category</option>
                                        @foreach($getCategory as $value_category)
                                            <option {{ (old('category_id') == $value_category->id) ? 'selected' : '' }} value="{{ $value_category->id }}">{{ $value_category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red">{{ $errors->first('category_id') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3" id="hideDivSubCategory">
                                <label class="col-sm-2 col-form-label">Sub Category <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="sub_category_id" id="sub_category">
                                        <option value="">Select Sub Category</option>

                                    </select>
                                    <span style="color: red">{{ $errors->first('sub_category_id') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3" id="showDivAMCFreeService">
                                <label class="col-sm-2 col-form-label">AMC Free Service <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="amc_free_service_id" required>
                                        <option value="">Select AMC Free Service</option>
                                        @foreach($getAMC->option as $value_amc)
                                            @php
                                                $RecordCount = \App\Models\BookService::where('amc_free_service_id', '=', $value_amc->id)
                                                    ->where('user_id', '=', \Illuminate\Support\Facades\Auth::user()->id)
                                                    ->count();
                                                $CountRecord = $value_amc->limits;
                                                $LimitCount = $CountRecord - $RecordCount;
                                            @endphp
                                            <option {{ (old('amc_free_service_id') == $value_amc->id) ? 'selected' : '' }} value="{{ $value_amc->id }}">{{ $value_amc->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color: red">{{ $errors->first('amc_free_service_id') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Description <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" required></textarea>
                                    <span style="color: red">{{ $errors->first('description') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Special Instructions <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <textarea name="special_instructions" class="form-control" required></textarea>
                                    <span style="color: red">{{ $errors->first('special_instructions') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Do you have a pet? <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="pet">
                                        <option {{ old('pet') == 2 ? 'selected' : '' }} value="2">No</option>
                                        <option {{ old('pet') == 1 ? 'selected' : '' }} value="1">Yes</option>
                                    </select>
                                    <span style="color: red">{{ $errors->first('pet') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Available date <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="date" name="available_date" class="form-control" required>
                                    <span style="color: red">{{ $errors->first('available_date') }}</span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Attachment Add <span style="color: red"> *</span></label>
                                <div class="col-sm-10">
                                    <table>
                                        <tr>
                                            <th>Select Image</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="file" name="option[100][attachment_image]" class="form-control">
                                            </td>
                                            <td></td>
                                            <td>
                                                <a href="#" class="item_remove btn btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                        <tr id="item_below_row100">
                                            <td colspan="100%">
                                                <button type="button" id="100" class="btn btn-primary add_row">Add</button>
                                            </td>
                                        </tr>
                                    </table>
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

@section('script')
    <script type="text/javascript">

        $("#SelectServiceTypeHideShow").on('change', function () {
           if (this.value == 3) {
               $("#showDivAMCFreeService").show().find(":input").attr("required", true);
               $("#hideDivCategory").hide().find(":input").attr("required", false);
               $("#hideDivSubCategory").hide().find(":input").attr("required", false);
           } else {
               $("#showDivAMCFreeService").hide().find(":input").attr("required", false);
               $("#hideDivCategory").show().find(":input").attr("required", true);
               $("#hideDivSubCategory").show().find(":input").attr("required", true);
           }
        });

        $(document).ready(function () {
           $('#category').on('change', function (e) {
               var cat_id = this.value;
               $.ajax({
                   url: "{{ url('user/book_service/sub_category') }}",
                   type: "POST",
                   data: {
                       cat_id: cat_id,
                       _token: "{{ csrf_token() }}"
                   },
                   dataType: "json",
                   success: function (result) {
                       $('#sub_category').html('<option value="">Select Sub Category</option>');
                       $.each(result.get_sub_category, function (key, value) {
                           $('#sub_category').append('<option value="' + value.id + '">' + value.name +'</option>');
                       })
                   }
               })
           });
        });
        var item_row = 101;
        $("body").delegate(".add_row", "click", function (e) {
           var id = $(this).attr('id');
           e.preventDefault();
           html = '<tr><td><input class="form-control" required name="option['+item_row+'][attachment_image]" type="file"><td>\n\
           <td><a href="#" class="item_remove btn btn-danger">Remove</td>\n\</tr';
           $('#item_below_row'+id).before(html);
           item_row++;
           $('body').delegate(".item_remove", "click", function (e) {
               e.preventDefault();
               $(this).parent().parent().remove();
           })
        });
    </script>
@endsection
