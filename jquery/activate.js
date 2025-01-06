$(document).ready(()=>{
    $('.deactivateResBtn').on('click', function(){
        const account_id = $(this).attr('id');

        if(account_id){
            Swal.fire({
                title: "Reactivate Account",
                text: "This account will be activated.",
                
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, activate it!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url:"../backend/admin/activated.php",
                    metehod: "get",
                    data:{
                        account_id
                    },
                    success: function(response){
                        if(response === "success"){
                            Swal.fire({
                                title: "Reactivated Account",
                                text: "Account has been reactivated.",
                                
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    window.location.reload();
                                }
                            })
                              
                        }
                    }
                  })
                }
              });
        }
    })
})