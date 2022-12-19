<?php
require_once './data/bootstrap.php';
require_once './libraries/auth.php';
require './libraries/comments.php';
require './libraries/likes.php';
require './libraries/posts.php';
require './utils/index.php';

$posts = postsGetAll($db);
?>

<section class="home">
    <?php
    foreach ($posts as $post) :
    ?>
        <div class="card content-card">
            <div class="content-card__content">
                <div class="content-card__content__likes">
                    <span><?= count(likesGetById($db, $post['id_post'])); ?></span>

                    <?php
                    if (isLiked(likesGetById($db, $post['id_post']), authGetUser()['id_user'])) : ?>
                        <i class="fa-solid fa-heart"></i>
                    <?php
                    else : ?>
                        <i class="fa-regular fa-heart"></i>
                    <?php
                    endif; ?>
                </div>
                <div class="content-card__content__main">
                    <div class="content-card__heading">
                        <div class="content-card__heading__tag">
                            <?php
                            switch ($post['type']) {
                                case 'Serie':
                            ?>
                                    <i class="fa-solid fa-film"></i>
                                <?php
                                    break;
                                case 'Film':
                                ?>
                                    <i class="fa-solid fa-film"></i>
                                <?php
                                    break;
                                case 'Game':
                                ?>
                                    <i class="fa-solid fa-gamepad"></i>
                                <?php
                                    break;
                                case 'Book':
                                ?>
                                    <i class="fa-solid fa-book"></i>
                            <?php
                                    break;
                            }
                            ?>
                        </div>

                        <h3><?= htmlspecialchars($post['title']); ?></h3>

                        <div>
                            <?php
                            for ($x = 1; $x <= $post['rating']; $x++) {
                            ?>
                                <i class="fa-solid fa-star"></i>
                            <?php
                            }
                            ?>

                            <?php
                            for ($x = 1; $x <= 5 - $post['rating']; $x++) {
                            ?>
                                <i class="fa-regular fa-star"></i>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <p class="content-card__text"><?= htmlspecialchars($post['content']); ?></p>

                    <div class="content-card__post-photo">
                        <img src="img/<?= $post['image']; ?>" alt="<?= htmlspecialchars($post['alt_image']); ?>">
                    </div>
                </div>
                <div class="content-card__content__actions">
                    <div class="content-card__dropdown">
                        <button onclick="displayDropdown(<?= $post['id_post']; ?>)" class="content-card__dropdown-button"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <div id="dropdown-<?= $post['id_post']; ?>" class="content-card__dropdown-content">
                            <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="actions/post-delete.php?id=<?= $post['id_post']; ?>"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-card__comments">
                <?php
                foreach (commentsGetById($db, $post['id_post']) as $comment) :
                ?>
                    <div class="content-card__comment-row">
                        <p class="content-card__comment-row__user"><?= htmlspecialchars(userSearchById($db, $comment['id_user'])['username']); ?></p>
                        <p class="content-card__comment-row__text"><?= htmlspecialchars($comment['comment_content']); ?></p>
                    </div>
                <?php
                endforeach;
                ?>
            </div>

            <div class="content-card__footer">
                <textarea rows="1" placeholder="Comment something..." class="content-card__footer__comment-box"></textarea>
                <button class="button content-card__comment">Comment</button>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</section>