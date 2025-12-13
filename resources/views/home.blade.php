@include('common/header')
           
            
            <!-- about us -->
            <div class="about-area" style="text-align:center">
            <h2>{{$data['content']}}</h2>
            </div>
            
            
            
            
            
           
            
            
           
            
            
@include('common/footer')         

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
