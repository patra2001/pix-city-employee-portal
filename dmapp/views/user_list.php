<?php 
    $this->load->view('header'); 
    $this->load->view('menu'); 
?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo isset($title) ? $title : 'Employees'; ?>
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo isset($title) ? $title : 'Employees'; ?></a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <section class="content container-fluid" >
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <div class=" pull-right search-wrap" style="margin-bottom:10px;">
                      <a href="<?php echo base_url('employee/form'); ?>"> <button type="button" class="btn  btn-primary">Add Employee</button></a>
                   <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped table-bordered" id="sample_1">
                            <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Name</th>
                                <th class="">Email</th>
                                <th class="">Phone</th>
                                <th class="">Gender</th>
                                <th class="">City</th>
                                <th class="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            if(isset($employees) && $employees){
                                $scount = 1;
                                foreach ($employees as $emp){
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $scount; ?></td>
                                        <td class=""><?php echo htmlspecialchars($emp->name); ?></td>
                                        <td class=""><?php echo htmlspecialchars($emp->email); ?></td>
                                        <td class=""><?php echo htmlspecialchars($emp->phone); ?></td>
                                        <td class=""><?php echo htmlspecialchars($emp->gender); ?></td>
                                        <td class=""><?php echo htmlspecialchars($emp->city); ?></td>
                                        <td class="">
                                            <a href="<?php echo base_url('employee/form/'.$emp->employee_id); ?>"> <button type="button" class="btn btn-warning"><i class="fa fa-fw fa-edit"></i></button></a>
                                            <a href="<?php echo base_url('employee/delete/'.$emp->employee_id); ?>" onclick="return confirm('Delete this employee?');"> <button type="button" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></button></a>
                                        
                                        </td>
                                        
                                    </tr>
                                    <?php 
                                    $scount++;
                                } 
                            }
                            ?>
                            </tbody>
                        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
  </div>
  
 <?php $this->load->view('footer'); ?>
  <script>
  $(function () {
    $('#sample_1').DataTable()
  })
</script>
 </body>
</html>