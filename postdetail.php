<?php
session_start();
if (!isset($_SESSION["logged_user"])) {
    header('Location: login.php');
    exit();
}
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location: /');
    exit();
}
?>

<html>
<head>
    <?php require_once('template/head_includes.php'); ?>
    <title>Camagru - post details</title>
    <link href="/css/postdetail.css" rel="stylesheet">
</head>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/upload.js"></script>
<body onload="showComments()">
    <div class="whole_body">
        <?php require_once('template/menu_bar.php'); ?>

        <div class="wrapper post_detail_wrapper">
            <div class="post_detail">
                <?php
                require_once 'functions/postdetail_fetch.php';
                require_once 'config/setup.php';

                $load_img = load_image($_GET['id'], $conn);
                ?>
                <div class="post_detail_header">
                    <div class="posted_by">
                        <span class="posted_by_label">Posted by : </span>
                        <span class="posted_by_text"><?php echo $load_img['login']; ?></span>
                    </div>

                    <?php
                    if ($load_img['login'] === $_SESSION['logged_user']) {
                        ?>
                        <form id="form_delete_post" class="form_delete_post" action="functions/delete_post.php" method="POST">
                            <img src="assets/delete-24px.svg" alt="delete" onclick="deletePost();">
                            <input type="hidden" name="img_id" value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="post_login" value="<?php echo $load_img['login']; ?>">
                        </form>
                        <?php
                    }
                    ?>
                </div>

                <img class="post_image" src="<?php echo $load_img['img']; ?>">

                <div class='post_info_wrapper'>
                    <input type="hidden" id="image_id" name="imgid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" id="logged_user" name="login" value="<?php echo $_SESSION['logged_user']; ?>">

                    <div class="like_comment_btns">
                        <div class="button_align">
                            <div class="icon">
                                <span class="visually-hidden">Likes:</span>
                                <?php
                                if (check_liked($_GET['id'], $_SESSION['logged_user'], $conn)) {
                                    ?>
                                    <i class="fas fa-heart fa-lg" id="like-btn-1" aria-hidden="true" onclick="likePost(1)"></i>
                                    <i class="far fa-heart fa-lg" id="like-btn-0" aria-hidden="true" onclick="likePost(0)"
                                       style="display:none"></i>
                                    <?php
                                } else {
                                    ?>
                                    <i class="fas fa-heart fa-lg" id="like-btn-1" aria-hidden="true" onclick="likePost(1)"
                                       style="display:none"></i>
                                    <i class="far fa-heart fa-lg" id="like-btn-0" aria-hidden="true" onclick="likePost(0)"></i>
                                    <?php
                                }
                                ?>
                            </div>
                            <div id="num_likes">
                                <?php echo(get_num_likes($_GET['id'], $conn)); ?>
                            </div>
                        </div>

                        <div class="button_align">
                            <span class="visually-hidden">Comments:</span>
                            <img id="comment-btn"
                                 class="icon"
                                 src="assets/comment-24px.svg"
                                 alt="comment"
                                 onclick="focusCommentTextarea()"
                            >

                            <div id="num_comments">
                                <?php echo(get_num_comments($_GET['id'], $conn)); ?>
                            </div>
                        </div>
                    </div>

                    <div class="post_date">
                        <span><?php echo $load_img['postdate']; ?></span>
                    </div>
                </div>

                <div id="comment_display" style="display:none">
                    <div class="comment_list" id="comment_list"></div>

                    <div class="comment_publish">
                        <textarea id="comment_input"
                                  class="comment_input"
                                  name="comment"
                                  placeholder="Enter the comment."
                                  onkeypress="keyHandle(event)"
                        ></textarea>
                        <button class="comment_submit" onclick="commentPost();">Publish</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require_once('template/footer.php') ?>
</body>
</html>

<script>
    function focusCommentTextarea() {
        var textarea = document.getElementById("comment_input");
        textarea.focus();
    }

    function keyHandle(event) {
        if (event.keyCode === 13) {
            commentPost();
            event.preventDefault();
        }
    }
</script>