<?php 
$this->load->view('header');
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
          <div class="box-header d-flex justify-content-between align-items-center py-3">
            <form method="get" action="<?php echo base_url('employee'); ?>" class="d-flex align-items-center gap-2">
              <select name="gender" class="form-select" aria-label="Filter by gender">
                <option value="">All Genders</option>
                <option value="Male"   <?php echo ($selected_gender=='Male')?'selected':''; ?>>Male</option>
                <option value="Female" <?php echo ($selected_gender=='Female')?'selected':''; ?>>Female</option>
                <option value="Other"  <?php echo ($selected_gender=='Other')?'selected':''; ?>>Other</option>
              </select>
              <select name="city" class="form-select" aria-label="Filter by city">
                <option value="">All Cities</option>
                <?php if(!empty($cities)) { foreach($cities as $c){ ?>
                  <option value="<?php echo htmlspecialchars($c->city); ?>" <?php echo ($selected_city==$c->city)?'selected':''; ?>><?php echo htmlspecialchars($c->city); ?></option>
                <?php }} ?>
              </select>
              <button type="submit" class="btn btn-primary">Filter</button>
              <a href="<?php echo base_url('employee'); ?>" class="btn btn-secondary">Reset</a>
            </form>
            <div>
              <a href="<?php echo base_url('employee/form'); ?>" class="btn btn-primary">Add Employee</a>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped table-bordered" id="employees_table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Gender</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($employees)) { $i=1; foreach($employees as $emp){ ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($emp->name); ?></td>
                    <td><?php echo htmlspecialchars($emp->email); ?></td>
                    <td><?php echo htmlspecialchars($emp->phone); ?></td>
                    <td><?php echo htmlspecialchars($emp->gender); ?></td>
                    <td><?php echo htmlspecialchars($emp->city); ?></td>
                    <td>
                      <a href="<?php echo base_url('employee/form/'.$emp->employee_id); ?>" class="btn btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                      <a href="<?php echo base_url('employee/delete/'.$emp->employee_id); ?>" class="btn btn-danger" onclick="return confirm('Delete this employee?');"><i class="fa fa-fw fa-trash"></i></a>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('footer'); ?>
<script>
  $(function(){ $('#employees_table').DataTable(); });
</script>
</body>
</html>