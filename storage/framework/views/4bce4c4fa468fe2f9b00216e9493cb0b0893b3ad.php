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
        <h3 class="mb-30 fw600 mb-3">Staking Income</h3>
    </div>

        <div class="card shadow cardtable">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S No</th>
                                <th>Package Amt</th>
                                <th>Network Type</th>
                                <th>Dividend</th>
                                <th>Datetime</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $levelTrans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key+1); ?></td>
                                <td><b><?php echo e($level->fromPackageData->amount); ?></b></td>  
                                
                                <td><b><?php echo e($level->currencyData->name); ?></b></td>  
                                <td><b><?php echo e($level['amount']); ?></b></td>  
                                <td><b><?php echo e($level['created_at']); ?></b></td>  
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                </div>
</div>
<?php $__env->startSection('footerScript'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/stakIncome.blade.php ENDPATH**/ ?>