$(document).ready(()=>{
    $('.submitReview').on('click', function(){
        const cart_id = $(this).data('cart-id');
        const comment = $(this).closest('.modal-content').find('.comment').val();
        const variation_id = $(this).data('variation-id');

        if(comment === ''){
            Swal.fire({
                title: "Empty Comment!",
                text: "Please write a comment.",
                icon: "warning",
                confirmButtonColor: "#3085d6",
            })
            return;
        }

        Swal.fire({
            title: "Submit Review?",
            text: "This review will be submitted.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/user/submitReview.php",
                method: "post",
                data:{
                    cart_id,
                    comment,
                    variation_id
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Review Submitted!",
                            text: "Review has been submitted.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        }).then((result) => {
                            if (result) {
                                window.location.reload();
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
    })
})