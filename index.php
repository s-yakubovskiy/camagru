<?php
	session_start();
?>
<html>
	<head>
		<?php require_once('template/head_includes.php'); ?>
        <link href="/css/index.css" rel="stylesheet">
		<title>Camagru</title>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script>
			var num_load = 0;
			var num_post = 8;
			var isPostsLoading = false;

			var loader;

			function fetchPosts() {
				if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && isPostsLoading !== true) {
					isPostsLoading = true;
					loadPosts();
				}
			}
		</script>
	</head>
	<body onload="loadPosts();" onscroll="fetchPosts();">
		<div class="whole_body">
			<?php require_once ('template/menu_bar.php')?>

			<div class="wrapper">
				<div class="gallery" id="gallery">
					
				</div>
				<div class="loader-wrapper loader-hidden" id="loader">
                    <div class="loader"></div>
                </div>
			</div>
		</div>

        <?php require_once ('template/footer.php')?>
	</body>
</html>