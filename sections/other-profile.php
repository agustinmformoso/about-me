<?php
require './libraries/posts.php';
require './libraries/followers.php';
require './libraries/comments.php';
require './libraries/likes.php';
require './utils/index.php';

$id_user = $_GET['id'];
$posts = postGetById($db, $id_user);
$followers = count(followersGetById($db, $id_user));
$followings = count(followingsGetById($db, $id_user));


$birthdate = new DateTime(userSearchById($db, $id_user)['birthdate']);
$creation_date = new DateTime(userSearchById($db, $id_user)['creation_date']);
?>

<section class="profile">
    <div class="profile-card">
        <div class="profile-card__header">
            <img src="img/<?= userSearchById($db, $id_user)['banner_picture']; ?>" alt="<?= userSearchById($db, $id_user)['banner_picture_alt']; ?>">
        </div>
        <div class="profile-card__body">
            <div class="profile-card__stats">
                <div class="profile-card__profile-picture">
                    <img src="img/<?= userSearchById($db, $id_user)['profile_picture']; ?>" alt="<?= userSearchById($db, $id_user)['profile_picture_alt']; ?>">
                </div>

                <div class="profile-card__account">
                    <p><?= userSearchById($db, $id_user)['name']; ?></p>
                    <span>@<?= userSearchById($db, $id_user)['username']; ?></span>
                </div>

                <div class="profile-card__stats__container">
                    <a href="index.php?s=followers-list">
                        <div class="profile-card__stats__stat">
                            <span><?= $followers ?></span>
                            <p>Followers</p>
                        </div>
                    </a>

                    <a href="index.php?s=following-list">
                        <div class="profile-card__stats__stat">
                            <span><?= $followings ?></span>
                            <p>Following</p>
                        </div>
                    </a>
                </div>

            </div>

            <div class="profile-card__biography-content">
                <p><?= userSearchById($db, $id_user)['biography']; ?></p>
            </div>

            <div class="profile-card__additional-data">
                <p><i class="fa-solid fa-location-pin"></i> <?= userSearchById($db, $id_user)['location']; ?></p>
                <p><i class="fa-solid fa-cake-candles"></i> Fecha de nacimiento: <?= $birthdate->format('d') . ' de ' ?><?= translateMonth($birthdate->format('F')) . ' de ' . $birthdate->format('Y') ?></p>
                <p><i class="fa-solid fa-calendar-days"></i> Se unió en <?= translateMonth($creation_date->format('F')) . ' de ' . $birthdate->format('Y') ?></p>
            </div>
        </div>
    </div>
</section>

<section>
    <?php
    foreach ($posts as $post) :
    ?>
        <div class="card content-card">
            <div class="content-card__content">
                <div class="content-card__content__likes">
                    <span><?= count(likesGetById($db, $post['id_post'])); ?></span>

                    <?php
                    if (isLiked(likesGetById($db, $post['id_post']), userSearchById($db, $id_user)['id_user'])) : ?>
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