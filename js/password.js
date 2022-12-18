window.addEventListener('DOMContentLoaded', function() {
    const passwordButtons = document.querySelectorAll('.form-password-button');

    passwordButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const associatedInput = document.getElementById(btn.getAttribute('data-input'));

            associatedInput.type = associatedInput.type === "text" ? "password" : "text";
        });
    });
});