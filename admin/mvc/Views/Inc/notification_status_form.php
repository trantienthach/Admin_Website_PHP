<?php if(!empty($dataStatusBrand) ) : ?>
    <div class="notification_status_form open">
        <div class="notification-inner <?php {{ echo $dataStatusBrand['status'];}} ?>">
            <p class="notification_text"><?php {{ echo $dataStatusBrand['notify'];}} ?></p>
            <span class="notification_close">X</span>
        </div>
    </div>
    <script>
    document.querySelector(".notification_close").addEventListener('click', function() {
        document.querySelector(".notification_status_form").style.display="none";
    })
</script>
<?php endif; ?>
