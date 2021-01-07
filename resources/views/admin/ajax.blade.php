<script type="text/javascript">
$(document).ready(function(){

    // //-------------------- Manage pincode listing ----------------------//
    // $(function () {
    //     var table = $('#pincode-table').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{ route('admin.pincode') }}",
    //         columns: [
    //             {data: 'DT_RowIndex', name: 'DT_RowIndex'},
    //             {data: 'state_name', name: 'state_name'},
    //             {data: 'city_name', name: 'city_name'},
    //             {data: 'pincode', name: 'pincode'},
    //             {data: 'status', name: 'status'},
    //             {data: 'updated_at', name: 'updated_at'},
    //             {data: 'action', name: 'action', orderable: false, searchable: false},
    //         ],
    //     });
    // });

    //-------------------- View Pincodes----------------------//

    $('body').on('click', '#viewpincodes', function () {
        var city_id = $(this).data('id');
        $("#pincodes_in_modal > tr").remove(); // reset old row table
        $.get("{{ url('admin/dashboard/pincode/view-form') }}"+'/' + city_id, function (data) {
                $('#view-pincodes').modal('show');
                var trHTML = '';
                var sr_no=1;
                $.each(data, function (i, item) {
                    trHTML += '<tr><td>'  + sr_no++ + '</td><td>' + item.state_name + '</td><td>' + item.city_name + '</td><td>' + item.pincode + '</td></tr>';
                });
                $('#pincodes_in_modal').append(trHTML);

            })
        });


    //-------------------- Manage pincode Edit listing ----------------------//
    $(function () {
        var table = $('#editpincode-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'state_name', name: 'state_name'},
                {data: 'city_name', name: 'city_name'},
                {data: 'pincode', name: 'pincode'},
                {data: 'status', name: 'status'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });

    //-------------------- Pincode Add Modal Form ----------------------//

    $('body').on('click', '#addpincodeForm', function () {
            var url = window.location.pathname;
            var id = url.substring(url.lastIndexOf('/') + 1);
            $('#city_id_add').empty(); // emplty city old value
            $.get("{{ url('admin/dashboard/pincode/add-form') }}"+'/' + id, function (data) {
                    $('#add-pincode').modal('show');
                    var res;
                    data.forEach(function(res) {
                        $('#city_id_add').append('<option value="' + res.city_id + '">' + res.city_name + '</option>');

                        state_name = res.state_name
                        state_id = res.state_id
                        });
                    $('#state_id_add').append('<option value="' + state_id + '">' + state_name + '</option>');
                })
            });

    //---------------------------  Add Pincode Using Ajax--------------------- //

    $('body').on('click', '#addbtn', function (event) {
            event.preventDefault()
            var state_id = $('#state_id_add').val();
            var city_id = $('#city_id_add').val();
            var pincode = $('#pincode_add').val();

            $.ajax({
                url: "{{ route('admin.pincode.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    state_id: state_id,
                    city_id: city_id,
                    pincode: pincode,
                },
                dataType: 'json',
                success: function (response) {
                    if(response) {
                        $('.success').html('<div class="alert alert-success" role="alert">'+response.success+'</div>');
                        $('#add-pincode').modal('hide');
                    }
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //-------------------- Pincode Edit Form ----------------------//

        $('body').on('click', '#editModal', function () {
            var ids = $(this).data('id').split(",");
            var id = ids[0]
            var pincode_id = ids[1];
            $('#update_city_id').empty(); // emplty city old value

            $.ajax({
                url: "{{url('admin/dashboard/pincode/edit-form')}}"+'/' + id,
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    pincode_id: pincode_id
                },
                dataType: 'json',
                success: function (data) {
                    $('#edit-pincode').modal('show');
                    $('#update_state_id').append('<option value="' + data.state_id + '">' + data.state_name + '</option>');
                    $('#update_city_id').append('<option value="' + data.city_id + '">' + data.city_name + '</option>');
                    $('#update_pincode').val(data.pincode);
                    $('#pincode_id').val(data.pincode_id);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //---------------------------  Update Pincode Ajax --------------------- //

    $('body').on('click', '#update_pincode_btn', function (event) {
        event.preventDefault()
        var state_id = $('#update_state_id').val();
        var city_id = $('#update_city_id').val();
        var pincode = $('#update_pincode').val();
        var pincode_id = $('#pincode_id').val();

        if(pincode_id==''){
            var route = '{{url("admin/dashboard/pincode/")}}';
        }else{
            var route = '{{url("admin/dashboard/pincode/edit")}}'+'/' + pincode_id;
        }
            $.ajax({
            url: route,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                state_id: state_id,
                city_id: city_id,
                pincode: pincode,
            },
            dataType: 'json',
            success: function (response) {
                if(response) {
                    $('.success').html('<div class="alert alert-success" role="alert">'+response.success+'</div>');
                    $('#edit-pincode').modal('hide');
                }
            },
            error: function (data) {
                console.log('Error......');
            }
        });
    });

     //---------------------------  Add New User --------------------- //

        $('#name').on('keyup', function () {
            $('#add_user').prop('disabled', false)
            if ($('#name').val()) {
                $('#name_error').html('');
            } else{
                $('#add_user').prop('disabled', true)
                $('#name_error').html('Name is required!').css('color', 'red');
            }
        });

        // var password = $('#password').val();
        // var confirm_password = $('#confirm_password').val();

        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#add_user').prop('disabled', false)
                $('#password_error').html('Password Matching').css('color', 'green');
                if($('#password').val() == '' && $('#confirm_password').val() == '') {$('#password_error').html('');}
            } else{
                $('#add_user').prop('disabled', true)
                $('#password_error').html('Confirm Password Not Matching').css('color', 'red');
            }
        });


        $('body').on('click', '#add_user', function (event) {
            event.preventDefault()
            //var formData = new FormData($(this)[0]);
            // var name = $('#name').val();
            // var email = $('#email').val();
            // var mobile_number = $('#mobile_number').val();
            // var password = $('#password').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var mobile_number = $('#mobile_number').val();
            var password = $('#password').val();

                $.ajax({
                url: '{{route("admin.user.store")}}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name,
                    email: email,
                    mobile_number: mobile_number,
                    password: password,
                },
                dataType: 'json',
                success: function (response) {
                    if(response) {
                        $('.success').html('<div class="alert alert-success" role="alert">'+response.success+'</div>');
                        $('#add-user').modal('hide');
                    }
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //-------------------- Get state By country --------------------//

        $('#country').on('change', function() {
            var country_id = this.value;
            $("#state").html('');
            $.ajax({
                url:"{{route('admin.sub-category.get-state-by-country')}}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#state').html('<option value="">Select State</option>');
                    $.each(result,function(key,state){
                    $("#state").append('<option value="'+state.id+'" >'+state.name+'</option>');
                    });
                }
            });
        });


        //-------------------- Get city By state --------------------//

        $('#state').on('change', function() {
            var state_id = this.value;
            $("#city").html('');
            $.ajax({
                url:"{{route('admin.sub-category.get-cities-by-state')}}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#city').html('<option value="">Select City</option>');
                    $.each(result,function(key,city){
                    $("#city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                    });
                }
            });
        });

        //-------------------- Get Pincodes By City for Servicable Pincode --------------------//

        $('#city').on('change', function() {
            var city_id = this.value;
            $("#pincodes").html('');
            $.ajax({
                url:"{{route('admin.sub-category.get-pincodes-by-city')}}",
                type: "POST",
                data: {
                     city_id: city_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $.each(result,function(key,res){
                        $("#pincodes").append('<li><label><input type="checkbox" value="'+res.id+'" name="pincodes[]">'+' ' +res.pincode+ '</label></li>');
                    });
                }
            });
        });

        //-------------------- Get Sub-Categories By Category ID. --------------------//

        $('#category_id').on('change', function() {
            var category_id = this.value;
            //$("#sub_category").html('');
            $.ajax({
                url:"{{route('admin.sub-sub-category.getSubCategoriesByCategoryId')}}",
                type: "POST",
                data: {
                    category_id : category_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(key,res){
                        $("#sub_category").append('<option value="'+res.id+'">'+res.sub_category_name+'</option>');
                    });
                }
            });
        });

        //-------------------- Get Sub-Sub-Categories By sub Category ID. --------------------//

        $('#sub_category').on('change', function() {
            var sub_category_id = this.value;
            //$("#sub_sub_category").html('');
            $.ajax({
                url:"{{route('admin.services.get-sub-sub-categories-by-subCategoryId')}}",
                type: "POST",
                data: {
                    sub_category_id : sub_category_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(result){
                    $('#sub_sub_category').html('<option value="">Select Sub Category</option>');
                    $.each(result,function(key,res){
                        $("#sub_sub_category").append('<option value="'+res.id+'">'+res.name+'</option>');
                    });
                }
            });
        });

        //-------------------- Get package categories By sub sub category ID. --------------------//

        $('#sub_sub_category').on('change', function() {
            var sub_sub_category_id = this.value;
            $("#package_category_id").html('');
            $("#services").html('');
            $("#totalAmount").html('');
            $("#totalAmount2").html('');
            $.ajax({
                url:"{{route('admin.services.get-package-categories-by-subSubCategory')}}",
                type: "POST",
                data: {
                    sub_sub_category_id : sub_sub_category_id,
                    _token: '{{csrf_token()}}',
                },
                dataType : 'json',
                success: function(data){
                    $('#package_category_id').html('<option value="">Select Package Category</option>');
                    $.each(data.packageCategories,function(key,package_category){
                        $("#package_category_id").append('<option value="'+package_category.id+'">'+package_category.name+'</option>');
                    });
                    $.each(data.services,function(key,service){
                        $("#services").append('<li><label><input type="checkbox" class="services" value="'+service.id+'" name="services[]">'+' ' +service.name+ '</label></li>');
                    });
                },
                error: function (data) {
                    $("#totalAmount").val('');
                    $("#totalAmount2").val('');
                }
            });
        });

//--------------------Service Get AfterDiscount from Amount Given by Discount. --------------------//
        $('#amount,#discount').on('keyup', function() {
            var amount = $('#amount').val();
            var discount = $('#discount').val();
            var after_amount = amount - (amount * (discount / 100));
            $("#after_discount2").val(after_amount);
            $("#after_discount").html('<input type="hidden" name="after_discount" value="'+after_amount+'" class="text-control" />')
        });

//-------------------- Package Get AfterDiscount from Amount Given by Discount. --------------------//

         $('#totalAmount,#package_discount').on('keyup', function() {
            var totalAmount = $('#totalAmount').val();
            var package_discount = $('#package_discount').val();
            var after_amount = totalAmount - (totalAmount * (package_discount / 100));
            $("#after_discount2").val(after_amount);
            $("#after_discount").html('<input type="hidden" name="after_discount" value="'+after_amount+'" class="text-control" />')
        });

        //-------------------- Get Service by service ID in Edit Modal. --------------------//

        $('body').on('click', '#edit_service', function () {
            var service_id = $(this).data('id');
            $('#edit_category').empty(); // emplty old value
            $('#edit_sub_category').empty(); // emplty old value
            $('#edit_sub_sub_category').empty(); // emplty old value
            $('#edit_name').empty(); // emplty old value
            $('#edit_amount').empty(); // emplty old value
            $('#edit_discount').empty(); // emplty old value
            $('#edit_after_discount').empty(); // emplty old value

            $.ajax({
                url: "{{url('admin/dashboard/services/edit')}}"+'/' + service_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    service_id: service_id
                },
                dataType: 'json',
                success: function (data) {
                    $('#edit-service').modal('show');

                    $('#edit_category').html(data.categories);
                    $('#edit_sub_category').html(data.subCategories);
                    $('#edit_sub_sub_category').html(data.subSubCategories);

                    $('#edit_name').val(data.services.name);
                    $('#edit_amount').val(data.services.amount);
                    $('#edit_discount').val(data.services.discount);
                    $('#edit_after_discount_old').val(data.services.after_discount);
                    $('#service_id').val(data.services.id);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //-------------------- Get AfterDiscount from Amount Given by Discount In Package Category Edit Modal. --------------------//

        $('#edit_amount,#edit_discount').on('keyup', function() {
            var amount = $('#edit_amount').val();
            var discount = $('#edit_discount').val();
            var after_amount = amount - (amount * (discount / 100));
            $("#edit_after_discount_old").val(after_amount);
            $("#edit_after_discount").html('<input type="hidden" name="edit_after_discount" value="'+after_amount+'" class="text-control" />')
        });

        //---------------------------  Update Services Ajax --------------------- //

    $('body').on('click', '#update_service_button', function (event) {
        event.preventDefault()
        var service_id = $('#service_id').val();
        var category_id = $('#edit_category').val();
        var sub_category_id = $('#edit_sub_category').val();
        var sub_sub_category_id = $('#edit_sub_sub_category').val();
        var name = $('#edit_name').val();
        var amount = $('#edit_amount').val();
        var discount = $('#edit_discount').val();
        //var after_discount = $('#edit_after_discount_old').val();
        var after_discount = '';
        if($('#edit_after_discount_old').val() != ''){
            after_discount = $('#edit_after_discount_old').val();
        }else{
            after_discount = $('#edit_after_discount').val();
        }

            $.ajax({
            url: "{{url('admin/dashboard/services/edit')}}"+'/' + service_id,
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                category_id: category_id,
                sub_category_id: sub_category_id,
                sub_sub_category_id: sub_sub_category_id,
                name: name,
                amount: amount,
                discount: discount,
                after_discount: after_discount,
            },
            dataType: 'json',
            success: function (response) {
                if(response) {
                    $('.success').html('<div class="alert alert-success" role="alert">'+response.success+'</div>');
                    $('#edit-service').modal('hide');
                }
            },
            error: function (data) {
                console.log('Error......');
            }
        });
    });

    //-------------------- Get Package Category by package-category ID in Edit Modal. --------------------//

    $('body').on('click', '#edit_package_category_btn', function () {
            var package_category_id = $(this).data('id');
            $('#edit_category').empty(); // emplty old value
            $('#edit_sub_category').empty(); // emplty old value
            $('#edit_sub_sub_category').empty(); // emplty old value
            $('#edit_package_category').empty(); // emplty old value
            $('#package_category_id').empty(); // emplty old value

            $.ajax({
                url: "{{url('admin/dashboard/package-category/edit')}}"+'/' + package_category_id,
                type: "GET",
                data: {
                    // "_token": "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function (data) {
                    $('#edit-package-category').modal('show');

                    $('#edit_category').html(data.categories);
                    $('#edit_sub_category').html(data.subCategories);
                    $('#edit_sub_sub_category').html(data.subSubCategories);
                    $('#edit_package_category').val(data.packageCategory.package_category);
                    $('#package_category_id').val(data.packageCategory.id);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });


        //-------------------- Get Package-category by package_category_id in view Modal. --------------------//

        $('body').on('click', '#view_package_category', function () {
            var package_category_id = $(this).data('id');
             $('#package_category_tbl').empty(); // emplty old value

            $.ajax({
                url: "{{url('admin/dashboard/package-category/show')}}"+'/' + package_category_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function (data) {
                    $('#package-category-info').modal('show');
                    var trHTML = '';
                    trHTML += '<tr><th>Category</th><td>'  + data.category_name + '</td><th>Sub Category</th><td>' + data.sub_category_name + '</td></tr><tr><th>Sub Sub Category</th><td>' + data.sub_sub_category_name + '</td><th>Package Category</th><td>' + data.package_category_name + '</td></th></tr>';
                    // Bind Package Category table in manage-packages list //
                    $('#package_category_tbl').append(trHTML);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //-------------------- Get Service MRP or Amount by service_id in create Package page. --------------------//

            $('body').on('change', '.services', function () {
                var services_ids = [];
                $("#services_ids").val('');
                $("#totalAmount2").html('');
                $.each($(".services:checked"), function(){
                    services_ids.push($(this).val());
                });

                $.ajax({
                    url: "{{url('admin/dashboard/services/get_service_amount')}}",
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "services_ids" : services_ids
                    },
                    dataType: 'json',
                    success: function (totalAmount) {
                        $("#totalAmount").val(totalAmount);
                        $("#totalAmount2").html('<input type="hidden" name="totalAmount" value="'+totalAmount+'" />');
                    },
                    error: function (data) {
                        $("#totalAmount").val('');
                        $("#totalAmount2").html('');
                    }
                });
           });

         //-------------------- FAQ's Edit Form ----------------------//

         $('body').on('click', '#edit_faq', function () {
            var id = $(this).data('id');
            $('#question').empty(); // emplty city old value
            $('#answer').empty(); // emplty city old value

            $.ajax({
                url: "{{url('admin/dashboard/faq/edit')}}"+'/' + id,
                type: "GET",
                data: { id: id },
                dataType: 'json',
                success: function (data) {
                    $('#edit-faq').modal('show');
                    $('#question').val(data.question);
                    $('#answer').val(data.answer);
                    $('#faq_id').val(data.id);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });

        //-------------------- FAQ's view_answer Modal ----------------------//

        $('body').on('click', '#view_answer', function () {
            var id = $(this).data('id');
            $('#question').empty(); // emplty city old value

            $.ajax({
                url: "{{url('admin/dashboard/faq/view')}}"+'/' + id,
                type: "GET",
                data: { id: id },
                dataType: 'json',
                success: function (data) {
                    $('#view-answer').modal('show');
                    $('#view_ans').html(data.answer);
                },
                error: function (data) {
                    console.log('Error......');
                }
            });
        });


        //-------------------- Get Vendor Details ----------------------//
        $('body').on('click', '#view-vendor-details', function () {
            var vendor_id = $(this).data('id');
            $.ajax({
                url: "{{url('admin/dashboard/vendor-loan/view-vendor')}}"+'/' + vendor_id,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    $('#vendor_name').text(data.name);
                    $('#vendor_email').text(data.email);
                    $('#vendor_mobile_number').text(data.mobile_number);
                    $('#vendor_address').text(data.address);
                    $('#vendor_state').text(data.state);
                    $('#vendor_city').text(data.city);
                    $('#vendor_pincode').text(data.pincode);
                },
                error: function (data) {
                    console.log('error..')
                }
            });
        });


});

</script>
