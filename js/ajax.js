function likePost(i) {
    var request = new XMLHttpRequest();
    var url = "functions/like.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-Type", "application/json");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            //var jsonData = JSON.parse(request.response);
            //console.log(jsonData);
            var num_likes = document.getElementById('num_likes');
            num_likes.innerHTML = request.response;
        }
    };
    var img_id = document.getElementById("image_id").value;
    var login = document.getElementById("logged_user").value;

    var data = JSON.stringify({"img_id": img_id, "login": login});

    request.send(data);

    if (i == 1) {
        document.getElementById("like-btn-1").style.display = "none";
        document.getElementById("like-btn-0").style.display = "block";
    } else {
        document.getElementById("like-btn-1").style.display = "block";
        document.getElementById("like-btn-0").style.display = "none";
    }
}

function commentPost() {
    var img_id = document.getElementById("image_id").value;
    var login = document.getElementById("logged_user").value;
    var comment = document.getElementById("comment_input").value;

    comment = comment.replace(/\r?\n/g, '');
    if (img_id && login && comment) {
        var request = new XMLHttpRequest();
        var url = "functions/comment.php";

        request.open("POST", url, true);
        request.setRequestHeader("Content-Type", "application/json");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                var num_likes = document.getElementById('num_comments');
                num_likes.innerHTML = request.response;
                var comment_box = document.getElementById('comment_list');
                var commentItem = document.createElement('p');

                commentItem.innerHTML = `<span class='comment_user_id'>${login} </span>${comment}`;
                comment_box.appendChild(commentItem);
            }
        };
        var data = JSON.stringify({"img_id": img_id, "login": login, "comment": comment});
        request.send(data);
    }
    document.getElementById("comment_input").value = '';
}

function showComments() {
    var comment = document.getElementById('comment_display');

    comment.style.display = 'block';
    var request = new XMLHttpRequest();
    var url = "functions/comment_load.php";
    request.open("POST", url, true);
    request.setRequestHeader("Content-Type", "application/json");
    request.onreadystatechange = function () {

        if (request.readyState === 4 && request.status === 200) {
            if (request.response) {
                var jsonData = JSON.parse(request.response);
                var comment_box = document.getElementById('comment_list');

                for (var i = 0; i < jsonData.length; i++) {
                    var comment = jsonData[i];
                    var login = comment['login'];
                    var commentText = comment['comment'];
                    var comment_paragraph = document.createElement('p');

                    comment_paragraph.innerHTML = `<span class='comment_user_id'>${login} </span>${commentText}`;
                    comment_box.appendChild(comment_paragraph);
                }
            }
        }
    };
    var img_id = document.getElementById("image_id").value;

    var data = JSON.stringify({"img_id": img_id});

    request.send(data);
}

function loadPosts() {
    if (!loader) {
        loader = document.getElementById("loader");
    }

    var xhr = new XMLHttpRequest();
    var url = "functions/post_load.php";

    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onloadstart = function () {
        loader.classList.remove("loader-hidden");
    };

    xhr.onloadend = function () {
        loader.classList.add("loader-hidden");
    };

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // xhr.response это строка
            if (xhr.response) {
                var jsonData = JSON.parse(xhr.response);
                var gallery_list = document.getElementById('gallery');

                for (var i = 0; i < jsonData.length; i++) {
                    var single_post = jsonData[i];
                    var count_likes = single_post['count_likes'];
                    var count_comments = single_post['count_comments'];
                    var img_id = single_post['id'];
                    var img_src = single_post['img'];
                    var gallery_item = document.createElement('div');

                    gallery_item.setAttribute('class', 'gallery-item');
                    gallery_item.innerHTML = `
					<img class="gallery-image" alt="" src="upload/${img_src}">
					<a href="postdetail.php?id=${img_id}" class="gallery-item-link">
						<div class="gallery-item-info">
							<div class="gallery-item-likes">
								<span class="visually-hidden">Likes:</span>
								<i class="fas fa-heart" aria-hidden="true"></i>
								${count_likes}
							</div>
							<div class="gallery-item-comments">
								<span class="visually-hidden">Comments:</span>
								<i class="fas fa-comment" aria-hidden="true"></i>
								${count_comments}
							</div>
						</div>
					</a>
					`;
                    gallery_list.appendChild(gallery_item);
                }
                num_load++;
                isPostsLoading = false;
            }
        }
    };
    var data = JSON.stringify({'num_load': num_load, 'num_post': num_post});
    xhr.send(data);
}