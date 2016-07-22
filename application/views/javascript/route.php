<?php (string)__('notification.validation'); ?>
<?php (string)__('route.home'); ?>
<script type="text/javascript">
    var route = <?php echo json_encode(\Laravel\Lang::$lines["application"][Config::get('application.language')]["route"]); ?>;
    var notification = <?php echo json_encode(\Laravel\Lang::$lines["application"][Config::get('application.language')]["notification"]); ?>;
</script>