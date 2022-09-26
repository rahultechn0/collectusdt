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
        <h3 class="mb-30 fw600 mb-3">Level Income</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Level Type</th>
                                <th>Team Size</th>
                                <th>Team Business</th>
                                <th>Level Income</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $levelArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td>Level <?php echo e($key+1); ?></td>
              
                                <td><b><?php echo e($level['levelCnt']); ?></b></td> 
                                <td><b>$<?php echo e(number_format( $level['business'],2)); ?></b></td>
                                <?php if(isset($levelTrans[$key]['amount'])): ?>
                                <td><b>$<?php echo e(number_format( $levelTrans[$key]['amount'],2)); ?></b></td>                                        
                                <?php else: ?>
                                <td><b>0.00</b></td>    
                                <?php endif; ?>          
                                         
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
<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/levelIncome.blade.php ENDPATH**/ ?>