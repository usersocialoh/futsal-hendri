<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"
                             style="background: url('<?= base_url('assets/img/login.jpg'); ?>');background-size:cover;background-position:center;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">SIGN IN</h1>
                                </div>
                                <?php if (session()->getFlashdata('message')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('message') ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>
                                <form class="user" method="post" action="<?= base_url('login') ?>">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user
                                            <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                                           id="email" name="email" placeholder="Email Address"
                                           value="<?= old('email'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user
                                        <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                               id="password" name="password" placeholder="Password"
                                               value="<?= old('password'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('forgot-password') ?>">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('register') ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
