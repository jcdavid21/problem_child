$(document).ready(()=>{
    $(".cancelOrder").on("click", function(){
        const prodId = $(this).attr("id");
        Swal.fire({
            title: "Are you sure you want to cancel this order?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    url:"../backend/user/cancelProd.php",
                    method: "get",
                    data:{
                        prodId,
                    },
                    success: function(response){
                        if(response === "deleted"){
                            Swal.fire({
                                title: "Item cancelled",
                                text: "Product item has been cancelled in your cart.",
                                icon: "warning"
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    window.location.reload();
                                }
                            })
                        }
                    },
                    error: function(){
                        alert("Connection Error!");
                    }
                })
            }
        })
    })
})

