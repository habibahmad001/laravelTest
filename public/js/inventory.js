$(document).ready(function(){
    // $('#stockdata thead tr').clone(true).appendTo('#stockdata');
    // $('#stockdata thead tr:eq(1) th').each(function(i) {
    //     var title = $(this).text();
    //     $(this).html('<input type="text" placeholder="Search..." />');
    //
    //     $('input', this).on('keyup change', function() {
    //         if (table.column(i).search() !== this.value) {
    //             table
    //                 .column(i)
    //                 .search(this.value)
    //                 .draw();
    //         }
    //     });
    // });

    // DataTable
    var table = $('#stockdata').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        "order": [],
        "pageLength": 50,
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
        }],
    });

    $("#submit_btn").click(function() {
        var name = $("#name").val();
        var qty = $("#qty").val();
        var stock = $("#stock").val();
        var price = $("#price").val();
        // var fileInput = $("#logo")[0]; // Get the DOM element from jQuery object
        // var file = fileInput.files[0];
        var formData = new FormData();
        formData.append('name', name);
        formData.append('qty', qty);
        formData.append('stock', stock);
        formData.append('price', price);
        // formData.append('file', file);
        formData.append('_token', csrf_token);

        // formData.forEach(function(value, key) {
        //     console.log(key + ": " + value);
        // });

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "/ajax-stock-store",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            $(".spineroverlay").show();
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#progress').html('Upload Progress: ' + percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        $(".spineroverlay").hide();
                        if(response.code == 200) {
                            Swal.fire({
                                title: response.status + "!",
                                text: response.msg,
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "OK!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $(".populatedata").html(response.html);
                                }
                            });
                        }

                        if(response.code == 500) {
                            Swal.fire({
                                title: "failed!",
                                text: "Ops operation is failed!",
                                icon: "error"
                            });
                        }
                    },
                    error: function () {
                        $(".spineroverlay").hide();
                        $('#response').html('An error occurred during upload');
                    }
                });
            }
        });
    });
});

