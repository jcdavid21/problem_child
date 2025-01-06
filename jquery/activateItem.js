$(document).ready(()=>{
    $('.activateItem').on('click', function(){
        const prod_id = $(this).attr('id');

        if(prod_id){
            Swal.fire({
                title: "Reactivate Product",
                text: "This product will be activated.",
                
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, activate it!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url:"../backend/admin/activateProd.php",
                    method: "post",
                    data:{
                        prod_id
                    },
                    success: function(response){
                        if(response === "success"){
                            Swal.fire({
                                title: "Reactivated Product",
                                text: "Product has been reactivated.",
                                
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