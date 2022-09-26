<?php echo $__env->make('adminCommon.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php echo $__env->make('adminCommon.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            <?php echo $__env->make('adminCommon.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
           

  <div class="container-fluid">
    <div class="heading ">
        <h3 class="mb-30 fw600 mb-3">Package History</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                   
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Username</th>
                                <th>Network</th>
                                <th>Package Amount</th>
                                <th>Total Income</th>
                                <th>Activate Date</th>
                                
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $investArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $t->userData->username; ?></td>
                                <td><?php echo $t->currencyData->name; ?></td>
                                <td>$<?php echo number_format($t['amount'],4); ?></td>
                                <td>$<?php echo number_format($t['amount']*2.6,4); ?></td>
                                <td><?php echo $t['created_at']; ?></td>
                                 <?php /*$packageamt=$t['amount']*260/100;
                                 $packageamt=(int)$packageamt;
                                 $totincome=(int)$totalincome;*/
                                 ?>
                                <?php if($t['trans'] == 8){ ?>
                                    
                                    <td class="text-danger">Expired</td>
                                <?php }else{?>
                               
                                    <td class="text-success">Active</td>
                              <?php  }?>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                </div>
</div>
<?php $__env->startSection('footerScript'); ?>
<script type="text/javascript">
    $(".investPackage").click(function(){
        var investAmt   = $("#investAmt").val();
        if (confirm('Are you sure you want to invest with : '+investAmt)) {
            $.ajax({ 
                url: "/investPackage",
                data:{ 
                    "investAmt":investAmt
                },
                type: 'POST',
                dataType: 'json',async: false,
                success: function(res)
                { 
                    if(res.type=="success"){
                        $.toaster({ priority : 'success', title : 'Invest Alert !', message : res.msg});
                        setTimeout(function () {
                                window.location.href = webLink+"package-history";
                        }, 5000);
                    }else{
                        $.toaster({ priority : 'danger', title : 'Invest Alert !', message : res.msg});
                    }
                    
                }
            });
        }
    }); 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/package-history.blade.php ENDPATH**/ ?>