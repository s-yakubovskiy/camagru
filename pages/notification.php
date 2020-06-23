<?php
// protection from direct access
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}
require_once("config/setup.php");
$sql = $conn->prepare("SELECT login, notification FROM users WHERE login=?");
$sql->execute(array($_SESSION['logged_user']));
$ref = $sql->fetch();
?>

<div class="content_body">

    <form action="../functions/noti_update.php" method="POST" class="acct_details">
        <div class="form_header">
            <h3>Notification Setting</h3>
            <p style="font-size: 16px;">
                Mobile Notification:
                <input name="mobile_noti"
                       type="checkbox"
                       <?php if ($ref['notification']) { ?>checked<?php }; ?>
                >
                <br/>
            </p>
        </div>
        <input class="save_change instagram-btn" name="submit" type="submit" value="Save changes">
    </form>
</div>