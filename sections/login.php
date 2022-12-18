<?php
$errors = sessionGetFlashValue('errors', []);
$oldData = sessionGetFlashValue('old_data', []);
?>

<section>
    <div class="card content-card">
        <form class="login" action="actions/login.php" method="post">
            <h2 class="login__title">Login</h2>

            <div class="login__form-group">
                <label for="email">Email</label>
                <input class="login__input" type="email" id="email" name="email" placeholder="Email" value="<?= $oldData['email'] ?? ''; ?>">
                <?php
                if (isset($errors['email'])) : ?>
                    <div class="login__email-error" id="error-email"><?= $errors['email']; ?></div>
                <?php
                endif; ?>
            </div>

            <div class="login__form-group">
                <label for="password">Contraseña</label>
                <input class="login__input" type="password" id="password" name="password" placeholder="Password">
            </div>

            <button class="button login__button">Login</button>
        </form>

        <p>¿Olvidaste tu contraseña? <a href="index.php?s=forgot-password">Recuperá tu contraseña</a>.</p>
        <p>¿Todavía no tenés cuenta? <a href="index.php?s=sign-up">¡Registrate ahora!</a></p>
    </div>
</section>