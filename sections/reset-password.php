<section>
    <div class="card content-card">
        <form class="login" action="actions/reset-password.php" method="post">
            <h2 class="login__title">Create New Password</h2>

            <p class="forgot-password-text">Complete the form with the new password you want for your account.</p>

            <input type="hidden" name="token" value="<?= $_GET['token']; ?>">
            <input type="hidden" name="email" value="<?= $_GET['email']; ?>">

            <div class="login__form-group">
                <label for="password">New password</label>
                <input class="login__input" type="password" id="password" name="password" placeholder="Password">
            </div>

            <button class="button login__button">Send</button>
        </form>
    </div>
</section>