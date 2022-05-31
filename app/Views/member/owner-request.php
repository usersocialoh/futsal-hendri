<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<form action="/owner-request" method="post">
    <div class="container-fluid">
        <h3 class="mt-5 mb-4"><?= $title ?></h3>
        <div class="form-group">
            <strong>Message</strong> <br>
            <textarea placeholder="NAME , ADDRESS, NOTE " class="form-control <?= ($validation->hasError('message')) ? 'is-invalid' : ''; ?>"
                      rows="3" name="message" value="<?= old('message'); ?>"></textarea>
            <div class="invalid-feedback">
                <?= $validation->getError('team'); ?>
            </div>
        </div>
        <button type="submit" name="button" class="btn btn-primary btn-user btn-block">Send</button>
    </div>
</form>
<?= $this->endSection(); ?>
