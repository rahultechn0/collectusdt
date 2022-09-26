<div class="modal fade" id="stakeModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Stake Now in <span id="c_name"></span></h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <br>
         </div>
         <!-- Modal body -->
         <div class="modal-body">
            <?php echo Form::open(["url"=>"", "method"=>"POST","autocomplete"=>"off","id"=>"stakeForm"]); ?>


            <div class="row">
               <div class="col-lg-12 mb-20">
                  <label for="currency_id">Currency Balance</label>
                  <input type="text" class="form-control" placeholder="Balance:" readonly="readonly" disabled="disabled"  name="stack_balance" value="" id="stack_balance" />
                  <input type="hidden" class="form-control" readonly="readonly" disabled="disabled"  name="stack_currency_id" value="" id="stack_currency_id" />
               </div>
               <div class="col-lg-12 mb-20">
                   <label for="stake_amt">Stake Amount</label>
                   <input type="number" class="form-control" placeholder="Enter amount for staking" name="stake_amt" value="" id="stake_amt" />
               </div>
               <div class="col-lg-12 ">
                  <div class="st-brtn ">
                     <button type="button" class="btn btn-lg stakeNowBtn">Stake Now</button>
                  </div>
               </div>
            </div>
            <?php echo e(Form::close()); ?>



         </div>
      </div>
   </div>
</div>

<!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('collect-usdt/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/jquery.easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/sb-admin-2.min.js')); ?>"></script>
    <!---
    <script src="<?php echo e(asset('collect-usdt/js/chart.min.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/chart-pie-demo.js')); ?>"></script>
    --->
    
    <script src="<?php echo e(asset('collect-usdt/js/jquery.toaster.js')); ?>"></script>
    <script src="<?php echo e(asset('collect-usdt/js/collectUSDT.js')); ?>"></script>
    <script>    
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
    <script type="text/javascript">
        function copyToClipboard(id,msg,divId){	
            var textArea = document.getElementById(id);
            var linkHtml = textArea.value;
            textArea.focus();
            textArea.select();
            document.execCommand('copy');
            $("#"+divId).html(msg);
            $("#"+divId).removeClass("d-none");
            setTimeout(function(){
                $("#"+divId).addClass("d-none");
            },5000);
        }
    </script>
    <script>
        $(".stakeNow").click( function(){
            var currency_id   = $(this).data("currency");
            $.ajax({ 
                url: webLink+"getCurrencyprice",
                data:{"currency_id":currency_id},
                dataType: 'json',
                type: 'POST',  
                success: function(result)
                { 
                    if(result.type =='success'){ 	
                        $("#stack_balance").val(result.balance+" "+result.c_name);
                        $("#stack_currency_id").val(currency_id);			        
                        $("#c_name").html(result.c_name);			        
                        $("#stakeModal").modal("show");
                        if(result.balance > 0){
                            $(".stakeNowBtn").removeAttr("disabled","disabled");
                        }else{
                            $(".stakeNowBtn").attr("disabled","disabled");
                        }
                    }else if(result.type =='error'){
                         
                    }
                }
            });
        });
        $(".stakeNowBtn").click( function(){
            $(".stakeNowBtn").attr("disabled","disabled");
            var currency_id   = $("#stack_currency_id").val();
            var stake_amt     = $("#stake_amt").val();
            if(stake_amt =="" || stake_amt ==0){
                $.toaster({ priority : 'danger', title : 'Stake Alert !', message : "Please enter amount greater than zero"});
                $(".stakeNowBtn").removeAttr("disabled","disabled");
                return false;
            }
            $.ajax({ 
                url: webLink+"stakeNow",
                data:{"currency_id":currency_id,"stake_amt":stake_amt},
                dataType: 'json',
                type: 'POST',  
                success: function(result)
                { 
                    if(result.type =='success'){ 	
                        $.toaster({ priority : 'success', title : 'Stake Alert !', message : result.msg });                        
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    }else if(result.type =='error'){
                        $.toaster({ priority : 'danger', title : 'Stake Alert !', message : result.msg });
                        $(".stakeNowBtn").removeAttr("disabled","disabled");
                    }
                }
            });
        });
    </script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#staticBackdrop').modal('show');
    });
</script>

    <?php echo $__env->yieldContent('footerScript'); ?>
</body>
</html><?php /**PATH /home/techno/collectusdt/resources/views/adminCommon/footer.blade.php ENDPATH**/ ?>