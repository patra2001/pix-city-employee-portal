<?php $this->load->view('header'); 
		$this->load->view('menu');
?>
  
  <div class="content-wrapper">
	<section class="content-header">
      <h1>
        DashBoard
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> DashBoard</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

	<section class="content container-fluid" >
		<div class="container" style="background-color: white;width: 100% !important;">
				
		</div>
    </section>
  </div>
  <?php $this->load->view('footer'); ?>
<script type="text/javascript">
$(document).ready(function(){
	activemenu(0);	//for menu active
});
