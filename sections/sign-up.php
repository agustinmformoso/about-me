<?php
$errors = sessionGetFlashValue('errors', []);
$oldData = sessionGetFlashValue('old_data', []);
?>

<section>
    <div class="card content-card">
        <form class="login" action="actions/sign-up.php" method="post">
            <h2 class="login__title">Sign Up</h2>

            <div class="login__form-group login__form-group--sign-up">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="login__input" value="<?= $oldData['email'] ?? ''; ?>" <?php if (isset($errors['email'])) echo 'aria-describedby="error-email"'; ?>>
                <?php
                if (isset($errors['email'])) : ?>
                    <div id="error-email" class="login__email-error"><?= $errors['email']; ?></div>
                <?php
                endif; ?>
            </div>

            <div class="login__form-group login__form-group--sign-up">
                <label for="password">Password</label>
                <div class="login__form-group__wrapper">
                    <input type="password" id="password" name="password" class="login__input login__input--password" value="<?= $oldData['password'] ?? ''; ?>" <?php if (isset($errors['password'])) echo 'aria-describedby="error-password"'; ?>>
                    <div class="input-group-append">
                        <div class="input-group-text form-password-button" data-input="password"><i class="far fa-eye-slash"></i></div>
                    </div>
                    <?php
                    if (isset($errors['password'])) : ?>
                        <div id="error-password"><?= $errors['password']; ?></div>
                    <?php
                    endif; ?>
                </div>
            </div>

            <div class="login__form-group login__form-group--sign-up">
                <label for="name">Name</label>
                <input type="name" id="name" name="name" class="login__input" value="<?= $oldData['name'] ?? ''; ?>" <?php if (isset($errors['name'])) echo 'aria-describedby="error-name"'; ?>>
                <?php
                if (isset($errors['name'])) : ?>
                    <div id="error-name" class="login__email-error"><?= $errors['name']; ?></div>
                <?php
                endif; ?>
            </div>

            <div class="login__form-group login__form-group--sign-up">
                <label for="username">Username</label>
                <input type="username" id="username" name="username" class="login__input" value="<?= $oldData['username'] ?? ''; ?>" <?php if (isset($errors['username'])) echo 'aria-describedby="error-username"'; ?>>
                <?php
                if (isset($errors['username'])) : ?>
                    <div id="error-username" class="login__email-error"><?= $errors['username']; ?></div>
                <?php
                endif; ?>
            </div>

            <div class="login__form-group login__form-group--sign-up">
                <label for="location">Location</label>
                <input type="location" id="location" name="location" class="login__input" value="<?= $oldData['location'] ?? ''; ?>" <?php if (isset($errors['location'])) echo 'aria-describedby="error-location"'; ?>>
                <?php
                if (isset($errors['location'])) : ?>
                    <div id="error-location" class="login__email-error"><?= $errors['location']; ?></div>
                <?php
                endif; ?>
            </div>

            <div class="login__form-group login__form-group--sign-up">
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" class="login__input" value="<?= $oldData['birthdate'] ?? ''; ?>" <?php if (isset($errors['birthdate'])) echo 'aria-describedby="error-birthdate"'; ?>>
                <?php
                if (isset($errors['birthdate'])) : ?>
                    <div id="error-birthdate" class="login__email-error"><?= $errors['birthdate']; ?></div>
                <?php
                endif; ?>
            </div>


            <div class="login__form-group login__form-group--sign-up">
                <label for="biography">Biography</label>
                <textarea type="biography" id="biography" name="biography" class="edit-profile__biography" value="<?= $oldData['biography'] ?? ''; ?>" <?php if (isset($errors['biography'])) echo 'aria-describedby="error-biography"'; ?>></textarea>
                <?php
                if (isset($errors['biography'])) : ?>
                    <div id="error-biography" class="login__email-error"><?= $errors['biography']; ?></div>
                <?php
                endif; ?>
            </div>

            <button class="button login__button">Sign Up</button>
        </form>

        <p>¿Ya tenés cuenta? <a href="index.php?s=login">Login</a></p>
    </div>
</section>