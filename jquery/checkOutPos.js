$(document).ready(()=>{
    $('#checkoutAll').on('click', function(){
        const total = $(this).data('total');

        Swal.fire({
            title: "Proceed to Check Out?",
            text: "This order will be checked out.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/admin/checkOutPos.php",
                method: "post",
                data:{
                    total
                },
                success: function(response){
                    const data = JSON.parse(response);
                    if(data.status === 'success'){
                        Swal.fire({
                            title: "Checked Out!",
                            text: "Order has been checked out.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        }).then((result) => {
                            if (result) {
                                window.open(`./print.php?order_id=${data.order_id}`, '_blank');
                            }
                        })
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
        });
    });

    $('.removeItem').on('click', function(){
        $cart_id = $(this).data('cart-id');
        Swal.fire({
            title: "Remove Item?",
            text: "This item will be removed.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/admin/removeItem.php",
                method: "post",
                data:{
                    cart_id: $cart_id
                },
                success: function(response){
                    if(response === 'success'){
                        window.location.reload();
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
        });
    });
    
    $('#clearCart').on('click', function(){
        Swal.fire({
            title: "Clear Cart?",
            text: "This cart will be cleared.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/admin/clearCart.php",
                method: "post",
                success: function(response){
                    if(response === 'success'){
                        window.location.reload();
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
        });
    });
})