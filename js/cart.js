$(document).ready(function(){
    // Update checkbox status via AJAX
    let total = 0;

    // Update shipping fee dynamically based on postal code
    const postalCode = document.getElementById("postalCode").value;
    const shippingFeeInput = document.getElementById("shippingFee");


    if (postalCode >= 1000 && postalCode <= 4999) {
        shippingFeePrice = 60;
    } else if (postalCode >= 5000 && postalCode <= 5599) {
        shippingFeePrice = 100;
    } else if (postalCode >= 5600 && postalCode <= 5999) {
        shippingFeePrice = 140;
    } else if (postalCode >= 6000 && postalCode <= 6999) {
        shippingFeePrice = 180;
    } else if (postalCode >= 7000 && postalCode <= 7999) {
        shippingFeePrice = 220;
    } else {
        if(postalCode < 1000 || postalCode > 9999 || postalCode == '' || postalCode == null || postalCode == 'None'){
            shippingFeeInput.value = `Invalid postal code`;
            shippingFeePrice = 0;
        }else{
            shippingFeePrice = 240;
        }
    }
    shippingFeeInput.value = `₱${shippingFeePrice}.00`;

    
    $('.checkbox').on('change', function () {
        var cartId = $(this).data('id');
        var isChecked = $(this).prop('checked') ? 1 : 0;

        $.ajax({
            url: 'update_checkbox.php',
            method: 'POST',
            data: { cartId: cartId, isChecked: isChecked },
            success: function (response) {
                updateTotalPrice();
            },
            error: function (xhr, status, error) {
                console.error("Error updating checkbox:", error);
            }
        });
    });

    // Update quantity and price via AJAX
    $('.updateQuantity').on('click', function () {
        var cartId = $(this).closest('.cart-item').data('id');
        var action = $(this).data('action');
        var quantityInput = $(this).siblings('.quantity');
        var quantity = parseInt(quantityInput.val());

        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease' && quantity > 1) {
            quantity--;
        }

        quantityInput.val(quantity);

        $.ajax({
            url: 'update_quantity.php',
            method: 'POST',
            data: { cartId: cartId, quantity: quantity },
            success: function (response) {
                try {
                    const responseData = JSON.parse(response);
                    
                    if(responseData.status === 'error'){
                        quantityInput.val(quantity - 1);
                    }else{
                        var newTotalPrice = parseFloat(responseData.newPrice);

                        if (!isNaN(newTotalPrice)) {
                            $('#price' + cartId + ' .price').text(newTotalPrice.toFixed(2));
                            updateTotalPrice();
                        } else {
                            console.error("Invalid newPrice in response:", response);
                        }
                    }
                } catch (e) {
                    console.error("Error parsing JSON:", e, response);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error updating quantity:", error);
            }
        });
    });

    // Remove item from the cart
    $('.remove-btn').on('click', function (e) {
        e.preventDefault();
        var cartId = $(this).closest('.cart-item').data('id');

        $.ajax({
            url: 'remove_from_cart.php',
            method: 'POST',
            data: { cartId: cartId },
            success: function () {
                $('#cart-items-container .cart-item[data-id="' + cartId + '"]').remove();
                updateTotalPrice();
            },
            error: function (xhr, status, error) {
                console.error("Error removing item:", error);
            }
        });
    });

    // Calculate total price
    function updateTotalPrice() {
        var totalPrice = 0;
        $('.cart-item').each(function () {
            var cartId = $(this).data('id');
            var isChecked = $('.checkbox[data-id="' + cartId + '"]').prop('checked');

            if (isChecked) {
                var priceElement = $('#price' + cartId + ' .price');
                var itemPrice = parseFloat(priceElement.text());

                if (!isNaN(itemPrice)) {
                    totalPrice += itemPrice;
                } else {
                    console.error(`Invalid price for cartId ${cartId}`);
                }
            }
        });

        $('#price2').text(totalPrice.toFixed(2));
        $('#overAllTotal').val('₱' + (totalPrice + shippingFeePrice).toFixed(2));
        total = totalPrice + shippingFeePrice;
    }

    // Initial total price calculation
    updateTotalPrice();



    // Proceed button event listener
    $('.proceed-btn').click(function () {
        const refNumber = $('#refNumber').val();
        const depositAmount = $('#depAmount').val();
        const receiptFile = $('#receiptFile')[0].files[0];
        const address_id = $('#address_id').val();

        const address = $('#address').val();
        const contactNumber = $('#contactNumber').val();

        if(postalCode < 1000 || postalCode > 9999){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Invalid postal code!',
            });
            return;
        }

        if(postalCode == '' || address == '' || contactNumber == '' || postalCode == null || address == null || contactNumber == null || postalCode == 'None' || address == 'None' || contactNumber == 'None'){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Address, Postal Code, and Contact Number must not be empty!',
            });
            return;
        }


        if (!receiptFile) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please upload a receipt!',
            });
            return;
        }

        const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        const fileExtension = receiptFile.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Invalid file format! Please upload an image file.',
            });
            return;
        }

        if (!refNumber || !depositAmount || address_id == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please fill all the fields!',
            });
            return;
        }

        if (refNumber.length < 13) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Reference number must be 13 characters long!',
            });
            return;
        }

        if (Number(depositAmount) !== total) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: `Deposit amount must be equal to the total amount of ₱${total}.00!`,
            });
            return;
        }

        const formData = new FormData();
        formData.append('refNumber', refNumber);
        formData.append('depositAmount', depositAmount);
        formData.append('shippingFee', shippingFeePrice);
        formData.append('address_id', address_id);
        formData.append('receiptFile', receiptFile);

        Swal.fire({
            title: "Proceed to checkout?",
            text: "Are you sure you want to proceed to checkout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, proceed!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Placing order...",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    url: '../backend/user/checkout.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        setTimeout(() => {
                            Swal.close();
                            if (response.trim() === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Order placed successfully!',
                                });
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response,
                                });
                            }
                        }, 1000);
                    },
                    error: function () {
                        setTimeout(() => {
                            Swal.close();
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong. Please try again later.',
                            });
                        }, 1000);
                    }
                });
            }
        });
    });
})