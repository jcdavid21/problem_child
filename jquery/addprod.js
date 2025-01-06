$(document).ready(function() {
    $('#addProd').submit(function (event) {
        event.preventDefault(); // Prevent the form from submitting normally

        // Get form values
        var productName = $('#prod_name').val();
        var productPrice = $('#prod_price').val();
        var productType = $('#prod_type').val();
        var prodDesc = $('#productDesc').val();

        var smallStockSizeId = $('#prod_small').data('size-id');
        var smallStock = $('#prod_small').val();

        var mediumStockSizeId = $('#prod_medium').data('size-id');
        var mediumStock = $('#prod_medium').val();

        var largeStockSizeId = $('#prod_large').data('size-id');
        var largeStock = $('#prod_large').val();

        var extraLargeStockSizeId = $('#prod_extra_large').data('size-id');
        var extraLargeStock = $('#prod_extra_large').val();

        var productImage = $('#prod_img').prop('files')[0];
        var first_hover_img = $('#first_hover_img').prop('files')[0];
        var second_hover_img = $('#second_hover_img').prop('files')[0];
        var third_hover_img = $('#third_hover_img').prop('files')[0];

        // Validate form inputs
        if (!productName || !productPrice || !productType || !prodDesc || !smallStock || !mediumStock || !largeStock || !extraLargeStock || !productImage) {
            Swal.fire({
                title: "Empty Field!",
                text: "Please fill in all fields.",
                icon: "warning",
                showConfirmButton: true,
            });
            console.error("Validation Error: Missing required fields.");
            return;
        }

        // Stocks must be greater than 0
        if (smallStock < 0 || mediumStock < 0 || largeStock < 0 || extraLargeStock < 0) {
            Swal.fire({
                title: "Invalid Stock",
                text: "Stocks must be greater than 0.",
                icon: "warning",
            });
            console.error("Validation Error: Stock values must be greater than 0.");
            return;
        }

        // Create FormData object
        var formData = new FormData();
        formData.append('prod_name', productName);
        formData.append('prod_price', productPrice);
        formData.append('prod_type', productType);
        formData.append('prod_img', productImage);

        if (first_hover_img) {
            formData.append('first_hover_img', first_hover_img);
        }

        if (second_hover_img) {
            formData.append('second_hover_img', second_hover_img);
        }

        if (third_hover_img) {
            formData.append('third_hover_img', third_hover_img);
        }

        formData.append('prod_small_stock', smallStock);
        formData.append('prod_medium_stock', mediumStock);
        formData.append('prod_large_stock', largeStock);
        formData.append('prod_extra_large_stock', extraLargeStock);
        formData.append('prod_desc', prodDesc);
        formData.append('small_size_id', smallStockSizeId);
        formData.append('medium_size_id', mediumStockSizeId);
        formData.append('large_size_id', largeStockSizeId);
        formData.append('extra_large_size_id', extraLargeStockSizeId);

        // Debugging: Log all formData values
        console.log("Form Data Values:");
        formData.forEach((value, key) => {
            console.log(key, value);
        });

        // AJAX request to submit form data
        $.ajax({
            url: '../backend/admin/add_product.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("Server Response:", response);
                if (response === 'success') {
                    Swal.fire({
                        title: "Successfully Added",
                        text: "Product Added Successfully!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000,
                    }).then((result) => {
                        if(result){
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Failed to Add Product",
                        text: response,
                        icon: "error",
                        showConfirmButton: true,
                    });
                    console.error("Error Response:", response);
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: "Failed to communicate with server.",
                    icon: "error",
                });
                console.error("AJAX Error:", status, error);
                console.error("XHR Response:", xhr.responseText);
            },
        });
    });

});
