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
            <div class=" pull-right search-wrap" style="margin-bottom:10px;">
              <a href="<?php echo base_url(); ?>city/add"> <button type="button" class="btn  btn-primary">Add City
                </button></a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered" id="sample_1">
              <thead>
                <tr>
                  <th>S No.</th>
                  <th>City Name</th>
                  <th>City short name</th>
                  <th class="">Status</th>
                  <th class="">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($cityLists) {
                  $scount = 1;
                  foreach ($cityLists as $city) {
                    ?>
                    <tr class="odd gradeX">
                      <td><?php echo $scount; ?></td>
                      <td class=""><?php echo $city->city_name; ?></td>
                      <td class=""><?php echo $city->city_short_name; ?></td>
                      <td class=""><?php if ($city->city_status == 1) {
                        echo "Enable";
                      } else {
                        echo "Disable";
                      } ?></td>

                      <td class="">
                        <a href="<?php echo base_url(); ?>city/add/<?php echo $city->city_id; ?>"> <button
                            type="button" class="btn btn-danger"><i class="fa fa-fw fa-edit"></i></button></a>
                        <?php /*<a href="<?php echo base_url(); ?>city/deleteCity/<?php echo $city->city_id; ?>"> <button
                            type="button" class="btn btn-inverse "><i class="fa fa-fw fa-remove"></i>Delete</button></a> */?>

                      </td>
                    </tr>
                    <?php $scount++;
                  }
                } ?>
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
  $(document).ready(function () {
    activemenu(1, 2);	//for menu active
  });

  $(function () {
    $('#sample_1').DataTable()
   
  })
</script>
</body>

</html>