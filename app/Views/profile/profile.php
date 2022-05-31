<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container-fluid">
    <h3 class="mt-5 mb-4"><?= $title ?></h3>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-3 col-12">
            <img alt="" src="<?= base_url('/assets/img/profile/'.$user['image']) ?>" style="width:100%;height:auto">
        </div>
        <div class="col-lg-9 col-12">
            <div class="text-left">
                <p>
                    <strong>Full Name</strong> <br>
                    <span><?= ucfirst($user['name']) ?></span>
                </p>
                <p>
                    <strong>Phone Number</strong> <br>
                    <span><?= $user['phone_number'] ?></span>
                </p>
                <p>
                    <strong>Email Address</strong> <br>
                    <span><?= $user['email'] ?></span>
                </p>
                <p>
                    <strong>Team</strong> <br>
                    <span><?= ($user['team'])? $user['team'] : '-' ?></span>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
