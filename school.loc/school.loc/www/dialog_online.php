<?php
    require_once 'FUNCTIONS/index.php';
    AUTH::autentificationCookies();

    $sel = $_COOKIE['sel'];

    $user_1 = USER::getUserInfo($_SESSION['user_id']);
    $user_2 = USER::getUserInfo($sel);
    $dialog_info = MESS::getDialogInfo($sel);
    $read = MESS::setReadMess($sel);
?>



    <script src="jQuery/jquery-3.1.0.js"></script>
    <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script src="js/ava.js"></script>

<?php if (isErr($dialog_info)): ?>
    <div class="col-xs-4">
        <?= $dialog_info['error']; ?> <!-- Сообщение, что нет сообщений  .. Или любая другая ошибка в виде текста -->
    </div>
<?php else: ?>
    <?php foreach ($dialog_info['data'] as $dialog): ?>
        <div class="dialog-body col-xs-12">
            <!--<div class="col-xs-1 ava-block">
                <a href=""><img src="<?= $dialog['user_avatar']; ?>" alt="ava" class="ava"></a>
              </div> -->
            <div class="col-xs-12">
                <a><?= $dialog['user_first_name'] . " " . $dialog['user_second_name']; ?></a><br>
                <?= $dialog['mess_date_add'] ?>
            </div>
            <div class="col-xs-12">
                <p class="text-muted message"><?= $dialog['message'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>