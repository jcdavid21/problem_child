$(document).ready(() => {
    $(".submit").on("click", function() {
        const userDetails = JSON.parse(localStorage.getItem("userDetails"));

        if (userDetails) {
            const prodId = $(this).attr("id");
            const qnty = 1;
            let selectedAddOns = [];
            $("input[name='add_ons[]']:checked").each(function() {
                selectedAddOns.push($(this).val());
            });
            let flavor = $(this).closest(".modal-content").find("#flavors").val();

            console.log(prodId, qnty, selectedAddOns, flavor);

            if (prodId === null || qnty === '' || qnty === '0') {
                Swal.fire({
                    title: "Invalid Input",
                    text: "Make sure you have selected all the order selection fields.",
                });
                return;
            }

            if (flavor === null) {
                Swal.fire({
                    title: "Invalid Input",
                    text: "Please select a flavor.",
                });
                return;
            }

            $.ajax({
                url: "../backend/user/addcart.php",
                method: "POST",
                data: {
                    prodId,
                    qnty,
                    addOns: selectedAddOns,
                    flavor
                },
                success: function(response) {
                    if (response === 'exceeds') {
                        Swal.fire({
                            title: "Item already in cart!",
                            text: "This item is already in your cart.",
                        });
                    } else if (response === 'success') {
                        Swal.fire({
                            title: "Success",
                            text: "Item added to cart, quantity updated.",
                        }).then((result) => {
                            if (result) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong. Please try again.",
                        });
                    }
                },
                error: function() {
                    alert("Connection Error");
                }
            });
        } else {
            Swal.fire({
                title: "Log in first!",
                text: "You need to log in first before you order!",
            });
        }
    });
});
