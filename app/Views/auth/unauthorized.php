<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
    <div class="mt-5 pt-5">
        <div class="text-center">
            <div class="error mx-auto" data-text="403">403</div>
            <p class="lead text-gray-800 mb-5">Access Forbidden</p>
            <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
            <a href="<?= base_url('/login') ?>">&larr; Back to previous page</a>
        </div>
    </div>
<?= $this->endSection(); ?>