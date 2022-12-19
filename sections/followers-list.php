<?php
require './libraries/followers.php';

$id_user = authGetUser()['id_user'];
?>

<section>
    <div class="card card-follow">
        <h2 class="card-follow__title">Followers</h2>

        <?php
        foreach (followersGetById($db, $id_user) as $follower) :
        ?>
            <a class="card-follow-link" href="index.php?s=other-profile&id=<?= $follower['id_follower']; ?>">
                <div class="card-follow__follow">
                    <div class="navbar__profile-picture card-follow__follow__image">
                        <img src="img/<?= userSearchById($db, $follower['id_follower'])['profile_picture']; ?>" alt="<?= userSearchById($db, $follower['id_follower'])['profile_picture_alt']; ?>" />
                    </div>
                    <div>
                        <p class="card-follow__follow__username"><?= htmlspecialchars(userSearchById($db, $follower['id_follower'])['username']); ?></p>
                        <p class="card-follow__follow__biography"><?= htmlspecialchars(userSearchById($db, $follower['id_follower'])['biography']); ?></p>
                    </div>
                </div>
            </a>
        <?php
        endforeach;
        ?>
    </div>
</section>