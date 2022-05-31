<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <form method="post" action="/change-password">
        <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" class="form-control
                                <?= ($validation->hasError('old_password')) ? 'is-invalid' : ''; ?>"
                   id="old_password" name="old_password"
                   value="" required>
            <div class="invalid-feedback">
                <?= $validation->getError('old_password'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" class="form-control
                                <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                   id="password" name="password"
                   value="" required>
            <div class="invalid-feedback">
                <?= $validation->getError('password'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">New Password Confirmation</label>
            <input type="password" class="form-control
                                <?= ($validation->hasError('password_confirmation')) ? 'is-invalid' : ''; ?>"
                   id="password_confirmation" name="password_confirmation"
                   value="" required>
            <div class="invalid-feedback">
                <?= $validation->getError('password_confirmation'); ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?= $this->endSection(); ?>
