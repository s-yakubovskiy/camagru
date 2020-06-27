<?php
// protection from direct access
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
    exit();
}
?>
<footer class="footer">
    <span>&copy; 2020 yharwyn- agottlie   |   hosted on k8s <3 </span>
</footer>
