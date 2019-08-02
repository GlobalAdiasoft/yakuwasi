 <?php
class Utilizables {
    function datatable() {
?>
<script>
 $(document).ready(function(){
  $('#table').dataTable( {     
        "language": {
            "url": "<?php echo URL . URLFW; ?>datatables/Spanish.json"
        }        
    });

      });
    </script>
<?php
    }
    function fecha_nombre(){
        $date = new DateTime(fecha_mysql);
    
            
    }
}