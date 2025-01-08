$(document).ready(()=>{
    $('.updateResBtn').on('click', function() {
        const modalContent = $(this).closest('.modal-content');
        const prod_id = $(this).val();
        const prod_name = modalContent.find('.updatedName').val();
        const prod_price = modalContent.find('.updatedPrice').val();
        const productDesc = modalContent.find('.updatedDesc').val();
    
        const variationSmall = modalContent.find('.variationSmall').val();
        const variationMedium = modalContent.find('.variationMedium').val();
        const variationLarge = modalContent.find('.variationLarge').val();
        const variationExtraLarge = modalContent.find('.variationExtraLarge').val();
    
        const updatedSmallStock = modalContent.find('.updatedSmallStock').val();
        const updatedMediumStock = modalContent.find('.updatedMediumStock').val();
        const updatedLargeStock = modalContent.find('.updatedLargeStock').val();
        const updatedExtraLargeStock = modalContent.find('.updatedExtraLargeStock').val();


        //stocks must be greater than 0
        if(updatedSmallStock < 0 || updatedMediumStock < 0 || updatedLargeStock < 0 || updatedExtraLargeStock < 0){
            Swal.fire({
                title: "Invalid Stock",
                text: "Stocks must be greater than 0.",
                icon: "warning"
            });
            return;
        }

        //name, price, and description must not be empty
        if(prod_name === "" || prod_price === "" || productDesc === ""){
            Swal.fire({
                title: "Empty Field",
                text: "All fields must be filled.",
                icon: "warning"
            });
            return;
        }
    
        if (prod_id && prod_name && prod_price) {
            $.ajax({
                url: "../backend/admin/updateProd.php",
                method: "POST",
                data: {
                    prod_id,
                    prod_name,
                    prod_price,
                    productDesc,
                    variationSmall,
                    variationMedium,
                    variationLarge,
                    variationExtraLarge,
                    updatedSmallStock,
                    updatedMediumStock,
                    updatedLargeStock,
                    updatedExtraLargeStock
                },
                success: function(response) {
                    const responseData = JSON.parse(response);
                    if (responseData.status === "success") {
                        Swal.fire({
                            title: "Product Updated",
                            text: "Product has been updated.",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Failed to update the product.",
                            icon: "error"
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "Connection Error",
                        text: "Failed to communicate with the server.",
                        icon: "error"
                    });
                }
            });
        } else {
            Swal.fire({
                title: "Empty Field!",
                text: "All fields must be filled.",
                icon: "warning",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
    

    $('.deleteResBtn').on('click', function(){
        const prod_id = $(this).val();
        
        if(prod_id){
            Swal.fire({
                title: "Disable this Product?",
                text: "This product will be disabled.",
                
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, disable it!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url:"../backend/admin/deleteProd.php",
                    method: "post",
                    data:{
                        prod_id
                    },
                    success: function(response){
                        if(response === "success"){
                            Swal.fire({
                                title: "Product Disabled",
                                text: "Product has been disabled.",
                                
                            }).then((result)=>{
                                if(result.isConfirmed){
                                    window.location.reload();
                                }
                            })
                              
                        }else{
                            Swal.fire({
                                title: "Product Not Deleted",
                                text: "Product has not been deleted.",
                                
                            })
                        }
                    },
                    error: function(){
                        alert("Connection Error")
                    }
                  })
                }
              });
        }
    })

})
