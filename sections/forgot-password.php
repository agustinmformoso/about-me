<section>
    <div class="card content-card">
        <form class="login" action="actions/send-recovery.php" method="post">
            <h2 class="login__title">Forgot Password</h2>

            <p class="forgot-password-text">Enter your email address in the form and we'll send you an email so you can create a new password.</p>

            <div class="login__form-group">
                <label for="email">Email</label>
                <input class="login__input" type="email" id="email" name="email" placeholder="Email" value="<?= $oldData['email'] ?? ''; ?>">
            </div>

            <button class="button login__button">Send</button>
        </form>
    </div>
</section>