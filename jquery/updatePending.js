$(document).ready(()=>{
    $('.updateBtn').on('click', function(){
        const current_status = $(this).data('status-id');
        const user_id = $(this).data('user-id');
        const order_id = $(this).data('order-id');
        let status_id = 4;
        if(current_status === 1){
          status_id = 2;
        }else if(current_status === 2){
          status_id = 3;
        }
        
        
        Swal.fire({
            title: "Update Order Status?",
            text: "This order will be updated.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/cashier/updatePending.php",
                method: "post",
                data:{
                    status_id,
                    current_status,
                    user_id,
                    order_id
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
    })

    $('.acceptBtn').on('click', function(){
        const item_id = $(this).attr('id');
        const status_id = 2;
        const prod_id = $(this).data('prod-id');
        const prod_qnty = $(this).data('prod-qnty');
        Swal.fire({
            title: "Proceed to Claim?",
            text: "This order will be claimed.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/cashier/updatePending.php",
                method: "post",
                data:{
                    item_id,
                    status_id,
                    prod_id,
                    prod_qnty
                },
                success: function(response){
                    if(response === 'success'){
                        window.location.reload();
                    }else if(response === 'exceeds'){
                      Swal.fire({
                        title: "Invalid stocks!",
                        text: "Quantity requested exceeds available stock.",
                        showConfirmButton: false,
                        timer: 2000
                      })
                    }

                    window.location.reload();
                },
                error: function(){
                    alert("Connection Error")
                }
              })
            }
          });
    })
})