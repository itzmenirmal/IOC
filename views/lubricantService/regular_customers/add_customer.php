<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Customer Form</title>
        <meta charset="utf-8">
    </head>

    <body>
        <div class="container col-lg-7">
            <div class="span">
                <div class="row">
                    <h3><strong>Add a Customer</strong></h3>

                </div>

                <form id="form" class="form-horizontal" action="" method="post">
                    <div class="control-group panel panel-info">
                        <label class="control-label col-lg-4">Customer ID</label>
                        <div class="controls col-lg-6">
                            <input type="text" class="form-control" name="id" id="id" placeholder="Customer ID" readonly>
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label col-lg-4">Name</label>
                        <div class="controls col-lg-6">
                            <input type="text" class="form-control floating-label" name="name" id="name" placeholder="Name" value="<?php echo ($name); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                    

                    <div class="control-group">
                        <label class="control-label col-lg-4">Address</label>
                        <div class="controls col-lg-6">
                            <input type="text" class="form-control floating-label" name="address" id="address" placeholder="Address" value="<?php echo ($address); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label col-lg-4">Contact</label>
                        <div class="controls col-lg-6">
                            <input type="number" class="form-control floating-label" name="contact" id="contact" placeholder="Contact Number" value="<?php echo ($contact); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label col-lg-4">Email</label>
                        <div class="controls col-lg-6">
                            <input type="email" class="form-control floating-label" name="email" id="email" placeholder="Email" value="<?php echo ($email); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label col-lg-4">Date Registered</label>
                        <div class="controls col-lg-6">
                            <input type="text" class="form-control floating-label" name="date" id="date" placeholder="" readonly="readonly" value="<?php echo date("Y-m-d"); ?>">
                            <span class="help-inline"></span>
                        </div>
                    </div>
            </div>
            <br>
            <div class="form-actions col-lg-12 col-lg-offset-8">

                <button type="submit" class="btn btn-success btn-raised" name="form-submitted" id="form-submitted">Add Customer</button>

            </div>
        </form>
    </div>
</body>
</html>

<script type="text/javascript">
    $(document).ready(function () {
        var d = new Date();
        var x = d.getYear() + d.getMonth();
        var y = d.getDate() - d.getHours() - d.getMinutes() - d.getSeconds() + d.getMilliseconds();

        var CusID = "lc" + "-" + (x + y);
        document.getElementById('id').value = CusID;

        console.log('Addind Customer');
        $("#form-submitted").click(function () {
//assiging values    
            var id = $("#id").val();
            var name = $("#name").val();          
            var address = $("#address").val();
            var contact = $("#contact").val();
            var email = $("#email").val();
            var date = $("#date").val();
//expression for validation
            var numbers = /^[0-9]+$/;
            var validNic = /\d{9}[vV]$/;
            var phone = /^\d{10}$/;
            var validEmail = /\S+@\S+\.\S+/;
//validation
            if (id == '' || name == '' || address == '' || contact == '' || email == '') {
                swal("Oops..", "Insertion Failed Some Fields are Blank....!!", "error");
            }
            else if (name.match(numbers)) {
                swal("Oops...", "Name should be alphabetical....!!", "error");
            }
            
            else if (address.match(numbers)) {
                swal("Oops...", "Invalid Address....!!", "error");
            }
            else if (!(contact.match(phone))) {
                swal("Oops...", "Invalid Contact Number....!!", "error");
            }
            else if (!(email.match(validEmail))) {
                swal("Oops...", "Invalid Email....!!", "error");
            }
            else {
// Returns successful data submission message when the entered information is stored in database.
                $.post("lube_service/addCustomer", {id: id, name: name, address: address, contact: contact, email: email, date: date},
                function (data) {
                    swal("Good job!", "Successfully added the New Customer!", "success");
                    $('#form')[0].reset(); //To reset form fields
                    $('#subloader').empty();
                    $('#subloader').load('/IOC/lube_service/lu_customers', function () {
                        $('#subloader').hide();
                        $('#subloader').fadeIn('fast');
                    });
                });
                console.log('data sent');

            }
        });
    });


</script>