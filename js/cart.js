let selectedCity = '';
let shippingFeePrice = 0;

const shippingFeeByPostalCode = [
    { postalCode: 1000, city: 'Manila', fee: 60 },
    { postalCode: 1100, city: 'Quezon City', fee: 60 },
    { postalCode: 1200, city: 'Makati', fee: 60 },
    { postalCode: 1300, city: 'Pasay City', fee: 60 },
    { postalCode: 1400, city: 'Caloocan City', fee: 60 },
    { postalCode: 2000, city: 'San Fernando (Pampanga)', fee: 100 },
    { postalCode: 3000, city: 'Malolos City', fee: 100 },
    { postalCode: 4000, city: 'San Pablo City', fee: 140 },
    { postalCode: 4500, city: 'Legazpi City', fee: 140 },
    { postalCode: 5000, city: 'Iloilo City', fee: 200 },
    { postalCode: 6000, city: 'Cebu City', fee: 200 },
    { postalCode: 6500, city: 'Tacloban City', fee: 220 },
    { postalCode: 7000, city: 'Tagbilaran City', fee: 220 },
    { postalCode: 8000, city: 'Davao City', fee: 250 },
    { postalCode: 8500, city: 'Butuan City', fee: 250 },
    { postalCode: 9000, city: 'Cagayan de Oro City', fee: 270 },
    { postalCode: 9500, city: 'General Santos City', fee: 270 }
];

// Populate the dropdown menu with cities and fees
const citySelect = document.getElementById('city');
const shippingFee = document.getElementById('shippingFee');

shippingFeeByPostalCode.forEach(({ city, fee }) => {
    const option = document.createElement('option');
    option.value = city;
    option.textContent = `${city}`;
    citySelect.appendChild(option);
    selectedCity = citySelect.value;
});

// Optional: Handle city selection to display detailed info
const overAllTotal = document.getElementById('overAllTotal');



citySelect.addEventListener('change', function () {
    const selectedCity = this.value;
    const selectedFeeData = shippingFeeByPostalCode.find(data => data.city === selectedCity);
    shippingFee.value = `₱${selectedFeeData.fee}`;
    shippingFeePrice = selectedFeeData.fee;
    overAllTotal.value = `₱${Number($('#subtotal').val().replace('₱', '')) + selectedFeeData.fee}`;
    console.log(subtotal);
});

$('.proceed-btn').click(function () {
    const refNumber = $('#refNumber').val();
    const depositAmount = $('#depAmount').val();
    const city = $('#city').val();
    const shippingAddress = $('#shippingAddress').val();
    const contactNumber = $('#contactNumber').val();
    const receiptFile = $('#receiptFile')[0].files[0];
    const subtotal = Number($('#subtotal').val().replace('₱', ''));

    console.log(refNumber, depositAmount, city, shippingFeePrice, shippingAddress, contactNumber, receiptFile);

    if(receiptFile === undefined) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please upload a receipt!',
        });
        return;
    }

    const allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    const fileExtension = receiptFile.name.split('.').pop().toLowerCase();

    if(!refNumber || !depositAmount || !city || !shippingFee || !shippingAddress || !contactNumber || !receiptFile) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Please fill all the fields!',
        });
        return;
    }

    if(!allowedExtensions.includes(fileExtension)) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Invalid file format! Please upload an image file.',
        });
        return;
    }

    if(refNumber.length < 13) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Reference number must be 13 characters long!',
        });
        return;
    }

    const total = subtotal + Number(shippingFeePrice);

    if(Number(depositAmount) != subtotal + Number(shippingFeePrice)) {
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: `Deposit amount must be equal to the total amount of ${total}!`,
        });
        return;
    }

    const formData = new FormData();
    formData.append('refNumber', refNumber);
    formData.append('depositAmount', depositAmount);
    formData.append('city', city);
    formData.append('shippingFee', shippingFeePrice);
    formData.append('shippingAddress', shippingAddress);
    formData.append('contactNumber', contactNumber);
    formData.append('receiptFile', receiptFile);

    console.log(formData);

    Swal.fire({
        title: "Proceed to checkout?",
        text: "Are you sure you want to proceed to checkout?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, proceed!",
    }).then((result)=>{
        if(result.isConfirmed)
        {
            Swal.fire({
                title: "Placing order...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            $.ajax({
                url: '../backend/user/checkout.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    setTimeout(() => {
                        Swal.close();
                        if(response === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Order placed successfully!',
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response,
                            });
                        }
                    }, 1000);
                },
                error: function () {
                    setTimeout(() => {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.',
                        });
                    }, 1000);
                }
            });
        }
    })

})

