$(function () {
    $("#usercheck").hide();
    $("#emailcheck").hide();
    $("#passwordcheck").hide();
    $("#confirmpasswordcheck").hide();

    let usernameError = true;
    let emailError = true;
    let passwordError = true;
    let confirmPasswordError = true;

    function validateForm(name, email, password, confirm_password) {
        // Reset error flags
        usernameError = true;
        emailError = true;
        passwordError = true;
        confirmPasswordError = true;

        // Name validation
        let nameRegex = /^[a-zA-Z\s]+$/;
        if (name.trim() === "") {
            $("#usercheck").show().html("**Name cannot be empty");
            $("#name").addClass("is-invalid");
            usernameError = false;
        } else if (name.length < 3 || name.length > 10) {
            $("#usercheck").show().html("**Length of username must be between 3 and 10 characters");
            $("#name").addClass("is-invalid");
            usernameError = false;
        } else if (!nameRegex.test(name)) {
            $("#usercheck").show().html("**Name can only contain letters and spaces");
            $("#name").addClass("is-invalid");
            usernameError = false;
        } else {
            $("#usercheck").hide();
            $("#name").removeClass("is-invalid");
            usernameError = true;
        }

        // Email validation
        let emailRegex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        if (!emailRegex.test(email)) {
            $("#emailcheck").show().html("**Please enter a valid email address");
            $("#email").addClass("is-invalid");
            emailError = false;
        } else {
            $("#emailcheck").hide();
            $("#email").removeClass("is-invalid");
            emailError = true;
        }

        // Password validation
        if (password.trim() === "") {
            $("#passwordcheck").show().html("**Password cannot be empty");
            $("#password").addClass("is-invalid");
            passwordError = false;
        } else if (password.length < 5) {
            $("#passwordcheck").show().html("**Password must be at least 5 characters long");
            $("#password").addClass("is-invalid");
            passwordError = false;
        } else {
            $("#passwordcheck").hide();
            $("#password").removeClass("is-invalid");
            passwordError = true;
        }

        // Confirm password validation
        if (confirm_password.trim() === "") {
            $("#confirmpasswordcheck").show().html("**Confirm Password cannot be empty");
            $("#confirm_password").addClass("is-invalid");
            confirmPasswordError = false;
        } else if (confirm_password !== password) {
            $("#confirmpasswordcheck").show().html("**Passwords do not match");
            $("#confirm_password").addClass("is-invalid");
            confirmPasswordError = false;
        } else {
            $("#confirmpasswordcheck").hide();
            $("#confirm_password").removeClass("is-invalid");
            confirmPasswordError = true;
        }

        return usernameError && emailError && passwordError && confirmPasswordError;
    }

    // Event listeners for real-time validation
    $("#name").keyup(function () {
        validateForm($(this).val(), $("#email").val(), $("#password").val(), $("#confirm_password").val());
    });

    $("#email").blur(function () {
        validateForm($("#name").val(), $(this).val(), $("#password").val(), $("#confirm_password").val());
    });

    $("#password").keyup(function () {
        validateForm($("#name").val(), $("#email").val(), $(this).val(), $("#confirm_password").val());
    });

    $("#confirm_password").keyup(function () {
        validateForm($("#name").val(), $("#email").val(), $("#password").val(), $(this).val());
    });

    $('.saveSubAdmin').click(function () {
        if (validateForm($("#name").val(), $("#email").val(), $("#password").val(), $("#confirm_password").val())) {
            var name = $("input[name=name]").val();
            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            var confirm_password = $("input[name=confirm_password]").val();
            var status = $("select[name=status]").val();
            $.ajax({
                type: "POST",
                url: $('#modal-lg').attr('save-action'),
                headers: {
                    'X-CSRF-TOKEN': $('#modal-lg').attr('token')
                },
                data: {
                    'name': name,
                    'email': email,
                    'password': password,
                    'confirm_password': confirm_password,
                    'status': status,
                },
                success: function (response) {
                    if(response.status == 200){
                        rendertable(response.data);
                        $('#modal-lg').modal('hide');
                        toastr.success('SubAdmin Created Successfully');
                        // Clear input fields
                        $("input[name=name]").val('');
                        $("input[name=email]").val('');
                        $("input[name=password]").val('');
                        $("input[name=confirm_password]").val('');
                        $("select[name=status]").val('1');
                    }
                },
                error: function (response) {
                    console.log(response);
                    // Optionally handle error case
                }
            });
        }
    });
    $(".deleteRows").click(function() {
        console.log('hey');
        var action = $('.card-body').attr('delete-action');
        $.ajax({
            type: "POST",
            url: action, // Adjust to your actual resource path
            headers: {
                'X-CSRF-TOKEN': $('#modal-lg').attr('token')
            },
            data: {
                'id': $(this).attr('each-id'),
            },
            success: function(response) {
                if (response.status == 200) {
                    toastr.success('SubAdmin Deleted Successfully');
                }
                var tableRows = ``;
                var action = $(".card-body").attr('delete-action');

                for (let i = 0; i < rows.length; i++) {
                    var element = rows[i];
                    var serialNumber = i + 1;
                    tableRows+=`<tr>
                    <td>`+serialNumber+`</td>
                    <td>`+element.name+`</td>
                    <td>`+element.email+`
                    </td>
                    <td>`+element.user_type+`</td>
                    <td><button class="btn btn-app deleteRows" each-id="`+element.id+`">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                    </td>
                </tr>`;
                }
                $('.render-tr').html(tableRows);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("An error occurred while deleting the item.");
            }
        });
    });
    function rendertable(rows) {
        var tableRows = ``;
        var action = $(".card-body").attr('delete-action');

        for (let i = 0; i < rows.length; i++) {
            var element = rows[i];
            var serialNumber = i + 1;
            tableRows+=`<tr class="table-row">
            <td>`+serialNumber+`</td>
            <td>`+element.name+`</td>
            <td>`+element.email+`
            </td>
            <td>`+element.user_type+`</td>
            <td><button class="btn btn-app deleteRows" each-id="`+element.id+`">
                <i class="fas fa-trash"></i> Delete
            </button>
            </td>
          </tr>`;
        }
        $('.render-tr').html(tableRows);
    }
});
