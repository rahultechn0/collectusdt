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
        <h3 class="mb-30 fw600 mb-3">Rank Income</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Rank Name</th>
                                <th>Team Business</th>
                                <th>Weekly Bonus</th>
                                <th>Get Bonus</th>
                                <th>Status</th>
                                <th>More Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $ranks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $rank): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php 
                                $total       = 0;
                                $getBonus    = \App\Models\Transaction::select("amount","roi_cnt")->where("packageId",$rank['id'])->where("trans",5)->first();
                                if($getBonus){
                                    $total   = $getBonus['amount']*$getBonus['roi_cnt'];
                                }
                                $status      = "Pending";
                                if($total>0){
                                    $status  = "Ongoing";

                                    if( $total >= $getBonus['amount']*12 ){
                                        $status  = "Complete";
                                    }
                                }

                            ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><b><?php echo e($rank->name); ?></b></td>  
                                <td><b>$<?php echo e(number_format( $rank['amount'],2 )); ?></b></td>  
                                <td><b>$<?php echo e(number_format( $rank['reward'],2 )); ?></b></td>  
                                <td><b>$<?php echo e(number_format( $total,2 )); ?></b></td>  
                                <td><b><?php echo $status; ?></b></td>
                                <td><a href="javascript:void(0)">Click Here</a></td>  
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="heading ">
        <h3 class="mb-30 fw600 mt-3">Rank Details</h3>
    </div>
        <div class="card shadow cardtable">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Rank Name</th>
                        <th>Bonus</th>
                        <th>Datetime</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            </table>
        </div>
        </div>
</div>
<?php $__env->startSection('footerScript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/rankIncome.blade.php ENDPATH**/ ?>