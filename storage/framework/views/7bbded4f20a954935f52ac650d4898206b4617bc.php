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
        <h3 class="mb-30 fw600 mb-3">Wallet History</h3>
    </div>
	<div class="w_box">
 <ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#ERC20_tab">ERC20</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#TRC20_tab">TRC20</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#BEP20_tab">BEP20 </a>
    </li>
  </ul>
	

  <!-- Tab panes -->
 <div class="tab-content">
    <div id="ERC20_tab" class="tab-pane active">
     <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Transaction Id </th>                                
                                <th>Amount </th>
                                <th>Transaction Type </th>
                                <th>Date</th>
								
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($walletArr[1])): ?>
                                <?php $__currentLoopData = $walletArr[1]['trans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <?php if(!empty($t['trans_id'])): ?>
                                    <td><?php echo substr($t['trans_id'],0,7);?>.......<?php echo substr($t['trans_id'],-7);?></td>
                                    <?php else: ?>
                                    <td>-</td>
                                    <?php endif; ?>

                                    <td><?php echo $t['amount'];?></td> 
                                    <td><?php echo $t['type'];?></td>  
                                    <td><?php echo $t['created_at'];?></td>
                                </tr>     
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php endif; ?>  
                        </tbody>
                    </table> </div>        
   </div>
    <div id="TRC20_tab" class="tab-pane fade">
     <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Transaction Id </th>
                                <th>Amount </th>
                                <th>Transaction Type </th>
                                <th>Date</th>								
                            </tr>
                        </thead>
                        <tbody> 
                            <?php if(isset($walletArr[0])): ?>
                            <?php $__currentLoopData = $walletArr[0]['trans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <?php if(!empty($t['trans_id'])): ?>
                                <td><?php echo substr($t['trans_id'],0,7);?>.......<?php echo substr($t['trans_id'],-7);?></td>
                                <?php else: ?>
                                <td>-</td>
                                <?php endif; ?>

                                <td><?php echo $t['amount'];?></td> 
                                <td><?php echo $t['type'];?></td>  
                                <td><?php echo $t['created_at'];?></td>
                            </tr>     
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php endif; ?>                                            
                             
                        </tbody>
                    </table></div>
    </div>
	<div id="BEP20_tab" class=" tab-pane fade">
     <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Transaction Id </th>                                
                                <th>Amount </th>
                                <th>Transaction Type </th>
                                <th>Date</th>								
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($walletArr[2])): ?>
                                <?php $__currentLoopData = $walletArr[2]['trans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <?php if(!empty($t['trans_id'])): ?>
                                    <td><?php echo substr($t['trans_id'],0,7);?>.......<?php echo substr($t['trans_id'],-7);?></td>
                                    <?php else: ?>
                                    <td>-</td>
                                    <?php endif; ?>

                                    <td><?php echo $t['amount'];?></td> 
                                    <td><?php echo $t['type'];?></td>  
                                    <td><?php echo $t['created_at'];?></td>
                                </tr>     
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php endif; ?>                                   
                                                                                   
                             
                        </tbody>
                    </table>
					</div>
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
<?php echo $__env->make('adminCommon.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/techno/collectusdt/resources/views/walletHistory.blade.php ENDPATH**/ ?>