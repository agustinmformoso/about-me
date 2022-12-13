<section class="edit-profile">
    <form class="card edit-profile__form" action="">
        <div class="edit-profile__header" style="background-image: url(http://localhost/www/aboutdotme/img/banner.jpeg);">
            <label class="edit-profile__button">
                <input type="file" />
                <i class="fa-solid fa-image"></i>
            </label>
        </div>

        <div class="edit-profile__profile-picture" style="background-image: url(http://localhost/www/aboutdotme/img/profile.jpg);">
            <label class="edit-profile__button">
                <input type="file" />
                <i class="fa-solid fa-image"></i>
            </label>
        </div>

        <div class="edit-profile__column">
            <input class="edit-profile__input" type="text" placeholder="user_name">
            <input class="edit-profile__input" type="text" placeholder="user_id">
            <textarea class="edit-profile__biography" rows="4" placeholder="biography"></textarea>
            <input class="edit-profile__input" type="text" placeholder="location">
            <input class="edit-profile__input" type="date">
            <button class="button edit-profile__save">save</button>
        </div>
    </form>
</section>