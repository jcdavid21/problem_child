$(document).ready(()=>{
    $('.deactivateResBtn').on('click', function(){
        const account_id = $(this).attr('id');

        if(account_id){
            Swal.fire({
                title: "Deactivate this Account?",
                text: "This account will be deactivated.",
                
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, deactivate it!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url:"../backend/admin/deactivate.php",
                    metehod: "get",
                    data:{
                        account_id
                    },
                    success: function(response){
                        if(response === "success"){
                            Swal.fire({
                                title: "Deactivated Account",
                                text: "Account has been deactivated.",
                                
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