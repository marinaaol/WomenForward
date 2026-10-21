<?php
require_once __DIR__ . '/auth.php';
?>
<input type="hidden" name="csrf" value="<?= htmlspecialchars(token_csrf()) ?>">