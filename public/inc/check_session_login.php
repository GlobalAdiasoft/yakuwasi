<?php 
if(Session::exist()){
    ?>
<script>
    window.location.href = "<?php echo URL;?>Index/cpanel";
</script>
<?php
}else{

}
?>