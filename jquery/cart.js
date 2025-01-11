
$(document).ready(()=>{

    $('.proceed-btn').on('click', function() {
    
        const receiptFile = $('#receiptFile')[0].files[0];
        const refNumber = $("#refNumber").val().trim();
        const depositAmnt = $("#depAmount").val().trim();
        const totalAmnt = $("#overAllTotal").val().trim().replace("₱", "").replace(",", "");
        const order_type = $("#order_type").val().trim();
        let text = "Want to pick up now?";

        // Check if the receipt file is uploaded
        if (!receiptFile) {
            Swal.fire({
                title: "Please upload your receipt",
                
                showConfirmButton: true,
            });
            return;
        }
        
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        const fileExtension = receiptFile.name.split('.').pop().toLowerCase();
        
        // Validate file extension
        if (!allowedExtensions.includes(fileExtension)) {
            Swal.fire({
                title: "Invalid file type",
                text: "Please upload a file with one of the following extensions: jpg, jpeg, png, svg, webp",
                
                showConfirmButton: true,
            });
            return;
        }
        
        // Validate reference number input
        if (!refNumber) {
            Swal.fire({
                title: "Please enter your reference number.",
                
                showConfirmButton: true,
            });
            return;
        }

        if(refNumber.length < 13){
            Swal.fire({
                title: "Invalid reference number",
                text: "Reference number must be 13 characters long.",
                
                showConfirmButton: true,
            });
            return;
        }
    
        // Validate deposit amount input
        if (!depositAmnt || isNaN(depositAmnt) || parseFloat(depositAmnt) <= 0) {
            Swal.fire({
                title: "Please enter a valid deposit amount.",
                
                showConfirmButton: true,
            });
            return;
        }

        
        if(parseFloat(totalAmnt) != depositAmnt){
            Swal.fire({
                title: "Invalid deposit amount",
                text: "Deposit amount must be equal to the total amount.",
                
                showConfirmButton: true,
            });
            return;
        }

        if(order_type === "2"){
            text = "Want to reserve now?";
        }
        
        // Confirm pickup action
        Swal.fire({
            title: `${text}`,
            text: "Your items will be prepared right away.",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, proceed!"
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                formData.append('receipt', receiptFile);
                formData.append('refNumber', refNumber);
                formData.append('depositAmount', depositAmnt);
                formData.append('order_type', order_type);
    
                $.ajax({ 
                    url: "../backend/user/proceed.php",
                    method: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'success') {
                            window.location.reload();
                        } else {
                            Swal.fire({
                                title: "Update error",
                                text: response,
                                
                                showConfirmButton: true,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: "Connection Error!",
                            text: "Could not connect to the server.",
                            
                            showConfirmButton: true,
                        });
                    }
                });
            }
        });
    });
    
    
})
