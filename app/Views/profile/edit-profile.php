<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<form action="/edit-profile" method="post" enctype="multipart/form-data">
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>
    <div class="row">
        <div class="col-lg-4 col-6">
            <img class="product-img mb-3" src="<?= base_url('/assets/img/profile/'.$user['image']) ?>" alt="" style="width:100%;height:auto">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-12">
            <div class="form-group">
                <input type="text" class="form-control" name="user_id" hidden
                       id="user_id" value="<?= (old('user_id')) ? old('user_id') : $user['user_id'] ?>" required>
                <label for="name">Name</label>
                <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                       name="name"
                       id="name" value="<?= (old('name')) ? old('name') : $user['name'] ?>" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('name'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Phone number</label>
                <input type="text" class="form-control <?= ($validation->hasError('phone_number')) ? 'is-invalid' : ''; ?>"
                       name="phone_number"
                       id="phone_number" value="<?= (old('phone_number')) ? old('phone_number') : $user['phone_number'] ?>" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('phone_number'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Email address</label>
                <input type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                       name="email"
                       id="email" value="<?= (old('email')) ? old('email') : $user['email'] ?>" required>
                <div class="invalid-feedback">
                    <?= $validation->getError('email'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Profile picture</label>
                <input type="file" class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : ''; ?>"
                       name="image" id="image">
                <div class="invalid-feedback">
                    <?= $validation->getError('image'); ?>
                </div>
            </div>
            <button type="submit" name="button" class="btn btn-primary btn-user btn-block my-4">Change</button>
        </div>
    </div
</div>
</form>
<?= $this->endSection(); ?>
