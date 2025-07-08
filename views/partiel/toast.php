<?php if (isset($_SESSION['toast'])): ?>
    <div class="toast-message <?= $_SESSION['toast']['type'] ?>">
        <?= htmlspecialchars($_SESSION['toast']['message']) ?>
    </div>
    <script>
        setTimeout(() => {
            document.querySelector('.toast-message')?.remove();
        }, 3000);
    </script>
    <?php unset($_SESSION['toast']); ?>
<?php endif; ?>