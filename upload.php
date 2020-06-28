<?php
session_start();
if (!isset($_SESSION["logged_user"])) {
    header('Location: login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Camagru - Upload your image!</title>
    <?php require_once('template/head_includes.php'); ?>
    <link href="/css/upload.css" rel="stylesheet">
    <script src="js/capture.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/upload.js"></script>
</head>
<body>
<div class="whole_body">
    <?php require_once('template/menu_bar.php'); ?>

    <div class="wrapper upload_wrapper">
        <div class="choice">
            <a class="instagram-btn" href="upload.php?id=use_cam">Take Snap!</a>
            <a class="instagram-btn" href="upload.php?id=upload">Upload file</a>
        </div>

        <?php
        if (isset($_GET['id'])) {
            ?>
            <form action='functions/merge.php' method="POST" id="preview" class="preview-form">
                <?php
                if ($_GET['id'] === 'use_cam') {?>
                    <script>activateSticker();</script>

                    <div class="camera">
                        <video id="video">Video stream not available.</video>
                        <img id="filter_tmp">
                        <canvas id="canvas"></canvas>
                    </div>

                    <?php
                }

                if ($_GET['id'] === 'upload') {
                    echo "<script> preventSticker(); </script>"
                    ?>
                    <input type="hidden" name="test" id="take_val">
                    <div class="show_box">
                        <img id="output">
                        <img id="filter_tmp">
                    </div>
                    <input id="choose_file"
                           class="choose_file"
                           type="file"
                           accept="image/png"
                           onchange="previewFile(event); activateSticker();"
                    >
                    <label for="choose_file" class="choose_file_wrapper">
                        <span>Choose file</span>
                    </label>
                    <?php
                }

                if ($_GET['id'] === 'upload' || $_GET['id'] === 'use_cam') {
                    ?>
                    <div id='sticker'></div>
                    <div id="sticker_lists">
                        <?php
                        $file_count = 0;
                        $files = glob('stickers/*');
                        if ($files) {
                            $file_count = count($files);
                            while ($file_count > 0) {
                                ?>
                                <label>
                                    <input type="radio" name="source" class="sticker_lists_clickable"
                                           value="../stickers/<?php echo $file_count; ?>.png"
                                           onclick="changePreview();">
                                    <img src='stickers/<?php echo $file_count; ?>.png' class='sticker_icons'>
                                </label>
                                <?php
                                $file_count--;
                            }
                        }
                        ?>
                    </div>
                <?php } ?>
                <input type='hidden' name='return_id' value="<?php echo $_GET['id']; ?>">
                <input id="startbutton" type="submit" class="instagram-btn" name="take_photo" value="Take photo">
            </form>
            <?php
        }
        ?>
        <form action="functions/upload.php" method="POST" enctype="multipart/for-data">
            <?php
            if (isset($_GET['id'])) {
                if ($_GET['id'] === 'use_cam' || $_GET['id'] === 'upload') {
                    $index = 0;
                    ?>
                    <div class="tmp_pics">
                        <?php
                        while (isset($_SESSION['img_tmp'][$index]) && $_SESSION['img_tmp'][$index]) {
                            ?>
                            <label>
                                <input type="radio" name="upload"
                                       value="<?php echo $_SESSION['img_tmp'][$index]; ?>" checked>
                                <img class="tmp_img" src="<?php echo $_SESSION['img_tmp'][$index]; ?>"/>
                            </label>
                            <?php
                            $index++;
                        }
                        ?>
                    </div>
                    <?php
                }
            } ?>
            <?php

            if (isset($_SESSION["error"])) {
                $error = $_SESSION["error"];
                echo "<span class='error'>$error</span>";
                unset($_SESSION["error"]);
            }

            if (isset($_GET['id'])) {
                if ($_GET['id'] === 'use_cam' || $_GET['id'] === 'upload') {
                    ?>
                    <input type="submit" class="upload_btn instagram-btn" name="submit" value="Upload">
                    <?php
                }
            }
            ?>
        </form>
    </div>
</div>

<?php require_once('template/footer.php') ?>
</body>
</html>
