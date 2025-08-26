<?php $this->load->view('header');
$this->load->view('menu');
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title; ?></a></li>
      <li class="active">Here</li>
    </ol>
  </section>

  <section class="content container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
          </div><!-- /.box-header -->
          <div class="box-body">

            <form class="form-horizontal" method="POST" id="userForm" action="<?php echo base_url("" . $formAction); ?>">
              <div class="box-body">

                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="">Name</label>
                      <input type="text" class="input-block-level input_validate form-control" placeholder="Name" name="name" value="<?php echo $name; ?>" id="name">
                      <input type="hidden" name="userId" value="<?php echo $user_id; ?>" />
                    </div>
                  </div>


                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="">User Name</label>
                      <input type="text" onchange="getUserData()" class="input-block-level input_validate form-control" placeholder="Username" name="username" value="<?php echo $username; ?>" id="username">
                      <span id="fileError" style="color: red; display: none;">Duplicated data not allowed.</span>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="">Email</label>
                      <input type="text" onchange="getUserData()" class="input-block-level input_validate form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" id="email">
                      <span id="fileErroremail" style="color: red; display: none;">Duplicated data not allowed.</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="">User Type</label>
                      <select class="input-large m-wrap  input_validate form-control" tabindex="1" name="usertype" id="usertype">
                        <option value="">Usertype</option>
                        <option value="1" <?php if ($usertype == 1) {
                                            echo "selected";
                                          } ?>>Admin</option>
                        <option value="2" <?php if ($usertype == 2) {
                                            echo "selected";
                                          } ?>>Sales Manager</option>
                        <option value="3" <?php if ($usertype == 3) {
                                            echo "selected";
                                          } ?>>Employee</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group" style="padding:10px">
                      <label for="">Status</label>
                      <select class="input-large m-wrap  input_validate form-control" tabindex="1" name="status" id="status">
                        <option value="">Status</option>
                        <option value="1" <?php if ($status == 1) {
                                            echo "selected";
                                          } ?>>Enable</option>
                        <option value="2" <?php if ($status == 2) {
                                            echo "selected";
                                          } ?>>Disable</option>
                      </select>
                    </div>
                  </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                  <a href="<?php echo base_url(); ?>user" class="btn btn-primary pull-right" style="margin-left:5px"><i class=" icon-remove"></i> Cancel </a>
                  <button type="submit" class="btn  btn-success pull-right" onclick='return formValidation("userForm");'>Submit</button>
                </div><!-- /.box-footer -->
            </form>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section>
</div>

<?php $this->load->view('footer'); ?>


<script type="text/javascript">
 // ajax call start
 function getUserData() {
    var username = $('#username').val();
    var email = $('#email').val(); 

    if (username !== '' || email !== '') {
        $.ajax({
            url: "<?php echo base_url('getUserDetails'); ?>",
            type: "POST",
            data: { username: username, email: email }, // Send data to the server

            success: function (data) {
                if (data == 400) {
                    console.log(data);
                    
                    fileError.style.display="block";
                    
                } else if(data == 300) {
                    fileErroremail.style.display="block";
                } else{
                    fileError.style.display="none";
                    fileErroremail.style.display="none";
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
            },
        });
    } else {
        // Handle the error on the client side or redirect to an error page
        alert('Invalid input. Please provide a valid username or email.');
    }
}
// ajax call end
</script>


<script>
  $(function() {
    $(" input[type=radio], input[type=checkbox]").uniform();
  });

  $(document).ready(function() {
    activemenu(19, 20); //for menu active
  });


  function formValidation(fromName) {

    // Validate the entries
    var valid = true,
      params;
    var confirm = true;

    //Remove any previous errors
    jQuery("#" + fromName + " .input_validate").each(function() {
      jQuery(this).removeClass('error_cl');
    });

    // Loop through required field
    jQuery("#" + fromName + " .input_validate").each(function() {

      // Check the min length
      if (jQuery(this).val().length < 1) {
        jQuery(this).addClass("error_cl");
        valid = false;
      }
    });
    if (valid === true && confirm === true) {
      return true;
    }
    return false;
  }

</script>
</body>

</html>