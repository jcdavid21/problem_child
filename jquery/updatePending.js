$(document).ready(() => {
  $('.updateBtn').on('click', function () {
      const current_status = $(this).data('status-id');
      const user_id = $(this).data('user-id');
      const order_id = $(this).data('order-id');
      let status_id = 4;

      let formData = new FormData();

      if (current_status === 1) {
          status_id = 2;
      } else if (current_status === 2) {
          status_id = 3;
      }

      formData.append('status_id', status_id);
      formData.append('current_status', current_status);
      formData.append('user_id', user_id);
      formData.append('order_id', order_id);

      if (status_id === 3) {
          const tracking_number = $('#tracking_number').val();

          if (tracking_number === "" || tracking_number === null || tracking_number === undefined) {
              Swal.fire({
                  title: "Empty Field",
                  text: "Please enter a tracking number.",
                  icon: "warning"
              });
              return;
          }

          formData.append('tracking_number', tracking_number);
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
                  method: "POST",
                  data: formData,
                  processData: false, // Prevent jQuery from converting data into a query string
                  contentType: false, // Ensure proper content type for FormData
                  success: function (response) {
                      if (response === 'success') {
                          window.location.reload();
                      } else {
                          Swal.fire('Error', 'There was an issue updating the order.', 'error');
                      }
                  },
                  error: function () {
                      Swal.fire('Connection Error', 'There was an issue connecting to the server.', 'error');
                  }
              });
          }
      });
  });

  $('.acceptBtn').on('click', function () {
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
                  method: "POST",
                  data: {
                      item_id,
                      status_id,
                      prod_id,
                      prod_qnty
                  },
                  success: function (response) {
                      if (response === 'success') {
                          window.location.reload();
                      } else if (response === 'exceeds') {
                          Swal.fire({
                              title: "Invalid stocks!",
                              text: "Quantity requested exceeds available stock.",
                              showConfirmButton: false,
                              timer: 2000
                          });
                      }
                  },
                  error: function () {
                      Swal.fire('Connection Error', 'There was an issue connecting to the server.', 'error');
                  }
              });
          }
      });
  });
});
