
<?= $this->extend('admin_template/index') ?>

<?= $this->section('content') ?>



<div id="layoutSidenav_content">
                <main>
                     <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>
                      
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                     
                        <div class="row">
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-blue order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Accounts without orders</h6>
                                        <h2 class="text-right"><i class="fas fa-user-clock fa-2x f-left"></i><span>
                                        <?= (isset($accountWithoutOrders)&&$accountWithoutOrders!=0)? count($accountWithoutOrders) :''?>
                                        </span></h2>
                                       
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total accounts</h6>
                                        <h2 class="text-right"><i class="fas fa-user-friends fa-2x f-left"></i><span>
                                        <?= (isset($totalAccounts)&&$totalAccounts!=0)? $totalAccounts[0]->totalAccounts :''?>
                                        </span></h2>
                                        
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Orders</h6>
                                        <h2 class="text-right"><i class="fa fa-columns fa-2x f-left"></i><span>
                                        <?= (isset($orders)&&$orders!=0)? count($orders) :'0'?>
                                        </span></h2>
                                       
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-pink order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">Total Income</h6>
                                        <h2 class="text-right"><i class="fas fa-dollar-sign fa-2x f-left"></i><span>
                                        <?php if(isset($orders)&&$orders!=0)
                                        { 
                                            $totalIncome=0;
                                            foreach($orders as $order):
                                                $totalIncome+=$order->total;
                                            endforeach;
                                            echo $totalIncome;
                                        }  
                                        ?>
                                        </span></h2>
                                       
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Detalles</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
	                    </div>

                        <div class="row">
                           
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                       Most Demanded Products
                                    </div>
                                    <div class="card-body">
                                            <figure class="highcharts-figure">
                                               <div id="mostDemandedProducts"></div>
                                            </figure>    

                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </main>



                <script src="<?php echo base_url('/assets/admin_template/')?>/js/jquery-3.5.1.slim.min.js"></script> 
  

<script src="<?php echo base_url('/assets/highcharts/')?>/highcharts.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/exporting.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/export-data.js"></script> 
<script src="<?php echo base_url('/assets/highcharts/')?>/accessibility.js"></script> 
 

<script type="text/javascript">
$(document).ready(function()
{
 
Highcharts.chart('mostDemandedProducts', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Most Demanded Products'
    },
    subtitle: {
        text: 'Most Demanded Products'
    },
    xAxis: {
       //  categories: ['01/2021 ', '02/2021', '03/2021 ', '04/2021 ', '005/2021 ',],
        categories: [
            <?php 
            if(isset($mostDemanded) && $mostDemanded!=null){
            foreach ($mostDemanded as $md)
            {?>
            ['<?php echo $md->name ?>'],

            <?php } }?>
        ],
        title: {
            text: 'Product'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'IP',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ' '
       
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'Times ordered',
        data: [
           
            <?php if(isset($mostDemanded) && $mostDemanded!=null){
            foreach($mostDemanded as $md)
            {
               echo $md->mostDemanded.','; 
             
            } 
           }?>
//            ['Firefox',   45.0],
//            ['IE',       26.8],

          ]
    }]
}); 
});
</script>

                <?= $this->endSection() ?>