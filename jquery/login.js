$(document).ready(()=>{
    $("#submit").on("click", function(e){
        const email = $("#email").val()
        const password = $("#password").val()

        if(email && password){
            $.ajax({
                url: "../backend/user/login.php",
                method: "post",
                data:{
                    email,
                    password
                },
                success: function(response){
                    if(response === "Invalid Password"){
                        Swal.fire({
                            title: "Invalid Password",
                            
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else if(response === "deactivated"){
                        Swal.fire({
                            title: "Account Deactivated!",
                            
                            showConfirmButton: false,
                            timer: 3000,
                        });
                    }else{
                        console.log(response)
                        Swal.fire({
                            title: "Welcome To Ninong's Food Corner!",
                            text: "Successfully Log in",
                            
                            showConfirmButton: false,
                            timer: 3000,
                          }).then((result) => {
                            const data = JSON.parse(response);
                            if(data.role_id == 1){
                                localStorage.setItem("userDetails", response);
                                window.location.href = "./Menus.php";
                            }else if(data.role_id == 2){
                                localStorage.setItem("adminDetails", response);
                                window.location.href = "../admin/index.php"
                            }else if(data.role_id == 3){
                                localStorage.setItem("cashierDetails", response);
                                window.location.href = "../cashier1/index.php";
                            }
                        });
                    }
                },
                error: function(){
                    alert("Connection Error")
                }
            })
        }
    })
})