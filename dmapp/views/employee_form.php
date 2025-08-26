<?php $this->load->view('header');
$this->load->view('menu');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1><?php echo $title; ?></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title; ?></a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <section class="content container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header"></div>
          <div class="box-body">
            <?php if (isset($_GET['error'])) { ?>
              <div class="alert alert-danger">
                <?php if ($_GET['error'] == 'company_email') { echo 'Company emails are not allowed.'; }
                      if ($_GET['error'] == 'duplicate_email') { echo 'This email address is already in use.'; } ?>
              </div>
            <?php } ?>
            <form class="form-horizontal" method="POST" id="employeeForm" action="<?php echo base_url($formAction); ?>">
              <div class="box-body">
                <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>" />
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="name">Name</label>
                      <input type="text" class="input-block-level input_validate form-control" placeholder="Name" name="name" value="<?php echo $name; ?>" id="name">
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="email">Email</label>
                      <input type="email" class="input-block-level input_validate form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" id="email">
                      <div id="email-validation-status" class="mt-1"></div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="phone">Phone</label>
                      <input type="text" class="input-block-level input_validate form-control" placeholder="Phone" name="phone" value="<?php echo $phone; ?>" id="phone">
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="gender">Gender</label>
                      <select class="input-large m-wrap input_validate form-control" name="gender" id="gender">
                        <option value="">Select Gender</option>
                        <option value="Male"   <?php echo ($gender=="Male")?"selected":""; ?>>Male</option>
                        <option value="Female" <?php echo ($gender=="Female")?"selected":""; ?>>Female</option>
                        <option value="Other"  <?php echo ($gender=="Other")?"selected":""; ?>>Other</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="city">City</label>
                      <input type="text" class="input-block-level input_validate form-control" placeholder="City" name="city" value="<?php echo $city; ?>" id="city">
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <a href="<?php echo base_url('employee'); ?>" class="btn btn-primary pull-right" style="margin-left:5px">Cancel</a>
                <button type="submit" class="btn btn-success pull-right">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('footer'); ?>

<script>
$(document).ready(function() {
    $("#employeeForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo base_url('employee/ajax_check_email'); ?>",
                    type: "post",
                    data: {
                        email: function() {
                            return $("#email").val();
                        },
                        employee_id: function() {
                            return $("input[name='employee_id']").val();
                        }
                    }
                }
            },
            phone: "required",
            gender: "required",
            city: "required"
        },
        messages: {
            name: "Please enter the employee's name",
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            phone: "Please enter a phone number",
            gender: "Please select a gender",
            city: "Please enter a city"
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>
</body>
</html>