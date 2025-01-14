let code = 0; // Global variable to store the code sent to the user

$(document).ready(function () {
    $('#sendCode').click(function (e) {
        e.preventDefault();
        const email = $('#email').val();
        const inputPassword = document.querySelector('.input-password')
        const sendCode = document.querySelector('.sendCode-btn')
        const submitBtn = document.querySelector('.submit-btn')

        if (email === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please fill all the fields!',
            });
            return;
        }

        Swal.fire({
            title: "Sending code...",
            allowOutsideClick: false, // Prevent closing by clicking outside
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: '../backend/user/forgotpass.php',
            type: 'POST',
            data: {
                email: email
            },
            success: function (response) {
                const data = JSON.parse(response);
                setTimeout(() => {
                    Swal.close(); // Close the loading modal after delay
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Password reset code sent to your email!',
                        });
                        code = data.digitCode;
                        inputPassword.style.display = 'block';
                        sendCode.style.display = 'none';
                        submitBtn.style.display = 'block';
                    } else if(response === "Email not found"){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Email not found!',
                        });
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response,
                        });
                    }
                }, 1000); // Delay of 1 second
            },
            error: function () {
                setTimeout(() => {
                    Swal.close(); // Ensure the modal closes after delay in case of error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                }, 1000); // Delay of 1 second
            }
        });
    });

    $('#submit').click(function (e) {
        e.preventDefault();
        const authcode = $('#authcode').val();
        const newPassword = $('#password').val();
        const email = $('#email').val();

        console.log(code)
        if (parseInt(authcode) !== code) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Code',
                text: 'The code you entered is incorrect!',
            });
            return;
        }
        
        if(newPassword.length < 6){
            Swal.fire({
                icon: 'error',
                title: 'Invalid Password',
                text: 'Password must be at least 6 characters!',
            });
            return;
        }

        Swal.fire({
            title: "Resetting password...",
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: '../backend/user/resetpassword.php',
            type: 'POST',
            data: {
                password: newPassword,
                email: email
            },
            success: function (response) {
                setTimeout(() => {
                    Swal.close(); // Close the loading modal after delay
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Reset',
                            text: 'Your password has been successfully reset!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../login/login.php';
                            }
                        }); 
                       
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response,
                        });
                    }
                }, 1000); // Delay of 1 second
            },
            error: function () {
                setTimeout(() => {
                    Swal.close(); // Ensure the modal closes after delay in case of error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again later.',
                    });
                }, 1000); // Delay of 1 second
            }
        });
    });

    // Password visibility toggle
    $('.showHidePw').click(function () {
        const pwField = $('#password');
        if (pwField.attr('type') === 'password') {
            pwField.attr('type', 'text');
            $(this).removeClass('uil-eye-slash').addClass('uil-eye');
        } else {
            pwField.attr('type', 'password');
            $(this).removeClass('uil-eye').addClass('uil-eye-slash');
        }
    });
});
