<?php echo $__env->make('common/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           
            
            <!-- about us -->
            <div class="about-area" style="text-align:center">
            <h2><?php echo e($data['content']); ?></h2>
            </div>
            
            
            
            
            
           
            
            
           
            
            
<?php echo $__env->make('common/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>         

<script type="text/javascript">

function refreshCap() {
    $.ajax({
     type:'GET',
     url:'/refresh_captcha',
     success:function(data){
        $(".cap-im").html(data.captcha);
     }
  });
}

</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/home.blade.php ENDPATH**/ ?>