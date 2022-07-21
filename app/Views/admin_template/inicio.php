<?php // aqui llamamos a la plantilla desde esta vista vista?>
<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>



<div id="layoutSidenav_content">
                <main>
                     <div class="container-fluid">
                        <h1 class="mt-4">Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">New Order</li>
                        </ol>
                       
                        <div class="row">
                           
	                    </div>

                        <div class="row">
                            
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Plan vs Real
                                    </div>
                                    <div class="card-body">
                                              

                                    </div>
                                   
                                </div>
                            </div>
                            <!-- <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Indices Prorrateo
                                    </div>
                                    <div class="card-body">
                                              

                                    </div>
                                </div>
                            </div> -->
                        </div>
                       
                    </div>
                </main>



                <script src="<?php echo base_url('/assets/admin_template/')?>/js/jquery-3.5.1.slim.min.js"></script> 
  

<script src="<?php echo base_url('/assets/highcharts/')?>/highcharts.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/exporting.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/export-data.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/accessibility.js"></script> 
 

<script type="text/javascript">


</script>
             
                <?= $this->endSection() ?>