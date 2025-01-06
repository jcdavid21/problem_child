$(document).ready(()=>{
    $('.removeComment').on('click', function(){
        const comment_id = $(this).attr('id');
        Swal.fire({
            title: "Remove Comment?",
            text: "This comment will be removed.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes!"
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                url: "../backend/admin/removeComment.php",
                method: "post",
                data:{
                    comment_id
                },
                success: function(response){
                    if(response === 'success'){
                        Swal.fire({
                            title: "Comment Removed!",
                            text: "Comment has been removed.",
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