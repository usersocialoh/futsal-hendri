<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"
                                 style="background: url('<?= base_url('assets/img/forgot-password.jpg'); ?>');background-size:cover;background-position:center;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div>
                                        <h1 class="h4 text-gray-900 mb-4 text-center">Forgot Password</h1>
                                        <?php if (session()->getFlashdata('error')): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= session()->getFlashdata('error') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <form class="user" method="post"
                                          action="<?= base_url('forgot-password'); ?>">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user
                                            <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                                                   id="email" name="email" placeholder="Email Address"
                                                   value="<?= old('email'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('login') ?>">Already have an account?
                                            Login
                                            here!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('register') ?>">Create an
                                            Account!</a>
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