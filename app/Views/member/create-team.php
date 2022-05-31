<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<form action="/create-team" method="post">
    <div class="container-fluid">
        <h3 class="mt-5 mb-4"><?= $title ?></h3>
        <div class="form-group">
            <strong>Team Name</strong> <br>
            <input class="form-control <?= ($validation->hasError('team')) ? 'is-invalid' : ''; ?>"
                   type="text" name="team" value="<?= old('team'); ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('team'); ?>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <button type="submit" name="button" class="btn btn-primary btn-user btn-block">Create</button>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>
