$(document).ready(function () {
    // Function to validate form inputs
    function validateForm() {
        var isValid = true;

        // Validate name field
        var name = $("#name").val().trim();
        var nameRegex = /^[a-zA-Z0-9\s]+$/; // Regex to allow only letters and spaces
        if (name === "") {
            $("#nameError").show().html("**Product Name is missing");
            $("#nameFormatError").hide();
            $("#name").addClass("is-invalid");
            isValid = false;
        } else if (name.length < 3 || name.length > 20) {
            $("#nameError").show().html("**Length of product name must be between 3 and 20 characters");
            $("#name").addClass("is-invalid");
            isValid = false;
        } else if (!nameRegex.test(name)) {
            $("#nameFormatError").show().html("**Name can only contain letters, numbers and spaces");
            $("#nameError").hide();
            $("#name").addClass("is-invalid");
            isValid = false;
        } else {
            $("#nameError").hide();
            $("#nameFormatError").hide();
            $("#name").removeClass("is-invalid");
        }

        // Validate description field
        var description = $("#description").val().trim();
        if (description === "") {
            $("#descriptionError").show();
            $("#description").addClass("is-invalid");
            isValid = false;
        } else {
            $("#descriptionError").hide();
            $("#description").removeClass("is-invalid");
        }

        // Validate price field
        var price = $("#price").val().trim();
        if (price === "") {
            $("#priceError").show();
            $("#price").addClass("is-invalid");
            isValid = false;
        } else if (price.length > 10) {
            $("#priceError").show().html("**Length of Price should 10 digit");
            $("#price").addClass("is-invalid");
            isValid = false;
        } else {
            $("#priceError").hide();
            $("#price").removeClass("is-invalid");
        }

        // Validate image field
        var images = $("#image")[0].files;
        if (images.length === 0) {
            $("#imageError").show();
            isValid = false;
        } else {
            $("#imageError").hide();
        }

        return isValid;
    }

    // Handle form submission
    $("#productForm").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Validate form inputs
        if (!validateForm()) {
            return;
        }

        // Gather form data
        var name = $("input[name=name]").val();
        var description = $("textarea[name=description]").val();
        var price = $("input[name=price]").val();
        var status = $("select[name=status]").val();
        var fileList = $('#image')[0].files;

        // Initialize FormData object
        var formData = new FormData();

        formData.append('name', name);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('status', status);

        // Append files to FormData
        for (var i = 0; i < fileList.length; i++) {
            formData.append('images[]', fileList[i]);
        }

        // Perform AJAX request
        $.ajax({
            type: "POST",
            url: $('#productForm').attr('save-product'),
            headers: {
                'X-CSRF-TOKEN': $('#productForm').attr('token')
            },
            data: formData,
            processData: false,  // Prevent jQuery from automatically processing the data
            contentType: false,   // Prevent jQuery from setting contentType
            success: function(response) {
                // Handle success response
                if(response.status == 200){
                    // rendertable(response.data);
                    toastr.success(response.message);
                    // Clear input fields
                    window.location.href = $(".redirect-loc").attr('redirect-location');
                }
                // Optionally, redirect or show success message
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log("Error:", error);
                // Optionally, display an error message
            }
        });
    });


    // For Edit
    // Handle form submission
    $("#productFormedit").submit(function (event) {
        event.preventDefault(); // Prevent default form submission

        // Validate form inputs
        if (!editvalidateForm()) {
            return;
        }

        // Gather form data
        var product_id = $("input[name=product_id]").val();
        var name = $("input[name=name]").val();
        var description = $("textarea[name=description]").val();
        var price = $("input[name=price]").val();
        var status = $("select[name=status]").val();
        var fileList = $('#image')[0].files;

        // Initialize FormData object
        var formData = new FormData();

        // Append fields to FormData
        formData.append('product_id', product_id);
        formData.append('name', name);
        formData.append('description', description);
        formData.append('price', price);
        formData.append('status', status);

        // Append files to FormData
        for (var i = 0; i < fileList.length; i++) {
            formData.append('images[]', fileList[i]);
        }

        // Perform AJAX request
        $.ajax({
            type: "POST",
            url: $('#productFormedit').attr('edit-product'),
            headers: {
                'X-CSRF-TOKEN': $('#productFormedit').attr('token') // Ensure this meta tag is present
            },
            data: formData,
            processData: false,  // Prevent jQuery from automatically processing the data
            contentType: false,  // Prevent jQuery from setting contentType
            success: function(response) {
                // Handle success response
                if(response.status === 200){
                    toastr.success(response.message);
                    // Redirect if necessary
                    var redirectLocation = $(".redirect-loc").attr('redirect-location');
                    if (redirectLocation) {
                        window.location.href = redirectLocation;
                    }
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error("Error:", error);
                toastr.error("An error occurred while updating the product.");
            }
        });
    });

    function editvalidateForm() {
        var isValid = true;

        // Validate name field
        var name = $("#name").val().trim();
        var nameRegex = /^[a-zA-Z0-9\s]+$/; // Regex to allow only letters and spaces
        if (name === "") {
            $("#nameError").show().html("**Product Name is missing");
            $("#nameFormatError").hide();
            $("#name").addClass("is-invalid");
            isValid = false;
        } else if (name.length < 3 || name.length > 20) {
            $("#nameError").show().html("**Length of product name must be between 3 and 20 characters");
            $("#name").addClass("is-invalid");
            isValid = false;
        } else if (!nameRegex.test(name)) {
            $("#nameFormatError").show().html("**Name can only contain letters, numbers and spaces");
            $("#nameError").hide();
            $("#name").addClass("is-invalid");
            isValid = false;
        } else {
            $("#nameError").hide();
            $("#nameFormatError").hide();
            $("#name").removeClass("is-invalid");
        }

        // Validate description field
        var description = $("#description").val().trim();
        if (description === "") {
            $("#descriptionError").show();
            $("#description").addClass("is-invalid");
            isValid = false;
        } else {
            $("#descriptionError").hide();
            $("#description").removeClass("is-invalid");
        }

        // Validate price field
        var price = $("#price").val().trim();
        if (price === "") {
            $("#priceError").show();
            $("#price").addClass("is-invalid");
            isValid = false;
        } else if (price.length > 10) {
            $("#priceError").show().html("**Length of Price should 10 digit");
            $("#price").addClass("is-invalid");
            isValid = false;
        } else {
            $("#priceError").hide();
            $("#price").removeClass("is-invalid");
        }

        return isValid;
    }
});
