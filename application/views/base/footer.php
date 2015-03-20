<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
<script src="<?php echo base_url()?>assets/libraries/jquery-ui.min.js"></script>
<!--  libraries-->
<script>
    $(document).ready(function(){
        $('#adddate').datepicker({ dateFormat: 'yy/mm/d' });
        $('#editdate').datepicker({ dateFormat: 'yy/mm/d' });
    });
</script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url()?>assets/js/plugins/morris/raphael.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/morris/morris.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/morris/morris-data.js"></script>
<?php
if(!empty($script)){
    echo '<script>'.$script.'</script>';
}
?>


</body>
</html>
