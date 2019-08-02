<?php 
if(Session::exist()){
    
}else{
?>
<script>
    window.location.href = "<?php echo URL;?>";
</script>
<?php
}
?>
