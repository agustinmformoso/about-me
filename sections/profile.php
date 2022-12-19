<?php
require './libraries/posts.php';
require './libraries/followers.php';
require './libraries/comments.php';

$id_user = authGetUser()['id_user'];
$posts = postGetById($db, $id_user);
$followers = count(followersGetById($db, $id_user));
$followings = count(followingsGetById($db, $id_user));

$birthdate = new DateTime(authGetUser()['birthdate']);
$creation_date = new DateTime(authGetUser()['creation_date']);
?>

<section class="profile">
    <div class="profile-card">
        <div class="profile-card__header">
            <img src="img/<?= authGetUser()['banner_picture']; ?>" alt="<?= authGetUser()['banner_picture_alt']; ?>">
        </div>
        <div class="profile-card__body">
            <div class="profile-card__stats">
                <div class="profile-card__profile-picture">
                    <img src="img/<?= authGetUser()['profile_picture']; ?>" alt="<?= authGetUser()['profile_picture_alt']; ?>">
                </div>

                <div class="profile-card__account">
                    <p><?= authGetUser()['name']; ?></p>
                    <span>@<?= authGetUser()['username']; ?></span>
                </div>

                <div class="profile-card__stats__container">
                    <div class="profile-card__stats__stat">
                        <span><?= $followers ?></span>
                        <p>Followers</p>
                    </div>
                    <div class="profile-card__stats__stat">
                        <span><?= $followings ?></span>
                        <p>Following</p>
                    </div>

                    <div class="profile-card__stats__actions">
                        <a href="index.php?s=edit-profile" class="button profile-card__edit-button">Edit profile</a>
                    </div>
                </div>

            </div>

            <div class="profile-card__biography-content">
                <p><?= authGetUser()['biography']; ?></p>
            </div>

            <div class="profile-card__additional-data">
                <p><i class="fa-solid fa-location-pin"></i> <?= authGetUser()['location']; ?></p>
                <p><i class="fa-solid fa-cake-candles"></i> Fecha de nacimiento: <?= $birthdate->format('d') . ' de ' ?><?= translateMonth($birthdate->format('F')) . ' de ' . $birthdate->format('Y') ?></p>
                <p><i class="fa-solid fa-calendar-days"></i> Se unió en <?= translateMonth($creation_date->format('F')) . ' de ' . $birthdate->format('Y') ?></p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="card content-card">
        <form action="" class="new-post">
            <div class="new-post__row">
                <select name="" id="" class="new-post__select">
                    <option value="">film</option>
                    <option value="">serie</option>
                    <option value="">book</option>
                    <option value="">game</option>
                </select>

                <fieldset class="new-post__star-rating">
                    <input type="radio" value="5" id="stars-star5" name="rating">
                    <label for="stars-star5" title="5 Stars"></label>
                    <input type="radio" value="4" id="stars-star4" name="rating">
                    <label for="stars-star4" title="4 Stars"></label>
                    <input type="radio" value="3" id="stars-star3" name="rating">
                    <label for="stars-star3" title="3 Stars"></label>
                    <input type="radio" value="2" id="stars-star2" name="rating">
                    <label for="stars-star2" title="2 Stars"></label>
                    <input type="radio" value="1" id="stars-star1" name="rating">
                    <label for="stars-star1" title="1 Stars"></label>
                </fieldset>
            </div>

            <input class="new-post__title" type="text" placeholder="title" />

            <textarea class="new-post__post-box" rows="4" placeholder="Post something..."></textarea>

            <div class="new-post__actions">
                <label class="new-post__file">
                    <input type="file" />
                    <i class="fa-solid fa-image"></i>
                </label>

                <button class="button new-post__comment">Post</button>
            </div>
        </form>
    </div>
</section>

<section>
    <?php
    foreach ($posts as $post) :
    ?>
        <div class="card content-card">
            <div class="content-card__content">
                <div class="content-card__content__likes">
                    <span>0</span>
                    <i class="fa-regular fa-heart"></i>
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