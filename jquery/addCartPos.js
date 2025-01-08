$(document).ready(() => {
    $('.addCart').on('click', function () {
        const prod_id = $(this).val();

        // Get the dropdown within the same modal and find the selected option
        const dropdown = $(this).closest('.modal-content').find('.updatedSize');
        const selectedOption = dropdown.find('option:selected');
        const variation_id = selectedOption.data('variation-id');

        // Get the quantity input within the same modal
        const quantity = $(this).closest('.modal-content').find('.updatedQuantity').val();

        // Get the price of the item
        const price = $(this).closest('.modal-content').find('.updatedPrice').val().replace('₱', '');

        const total = price * quantity;

        if(variation_id === undefined || variation_id === null || variation_id === ''){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a size!'
            });
            return;
        }

        if(quantity === undefined || quantity === null || quantity === '' || quantity <= 0 ){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please input a valid quantity!'
            });
            return;
        }


        $.ajax({
            url: "../backend/admin/addCartPos.php",
            method: "post",
            data: {
                prod_id,
                variation_id,
                quantity,
                total
            },
            success: function (response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Item added to cart!'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `Error: ${data.message}`
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Connection Error!'
                });
            }
        });

    });
});
