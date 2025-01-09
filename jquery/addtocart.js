$(document).ready(() => {
    $(".submit").on("click", function(e) {
        e.preventDefault();
        const product_id = $('#product_id').val();
        const size_id = $('.size_box.selected').data('size-id');
        const price = $('#price').val();
        const quantity = $('#quantityInput').val();

        $.ajax({
            url: "../backend/user/addToCart.php",
            method: "post",
            data: {
                product_id,
                size_id,
                price,
                quantity
            },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Added to Cart!",
                        text: "Item has been added to cart.",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        customClass: {
                            title: 'default-font',
                            htmlContainer: 'default-font',
                            confirmButton: 'default-font'
                        }
                    }).then((result) => {
                        if (result) {
                            location.reload();
                        }
                    });                    
                }else if(data.status === 'error'){
                    Swal.fire({
                        title: "Error!",
                        text: data.message,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                        customClass: {
                            title: 'default-font',
                            htmlContainer: 'default-font',
                            confirmButton: 'default-font'
                        }
                    });
                }
            },
            error: function() {
                alert("Connection Error")
            }
        });
    });
});
