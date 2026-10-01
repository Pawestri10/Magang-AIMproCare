<?php

$successMessage = session()->getFlashdata('success');
$errorMessage = session()->getFlashdata('error');

?>

<?php if ($successMessage): ?>

    <div
        class="alert alert-success"
        role="alert">

        <span class="alert-message">
            <?= esc($successMessage) ?>
        </span>

    </div>

<?php endif; ?>


<?php if ($errorMessage): ?>

    <div
        class="alert alert-error"
        role="alert">

        <span class="alert-message">
            <?= esc($errorMessage) ?>
        </span>

    </div>

<?php endif; ?>