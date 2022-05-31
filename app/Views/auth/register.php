<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"
                     style="background: url('<?= base_url('assets/img/register.jpg'); ?>');background-size:cover;background-position:center;"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">SIGN UP</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('register'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user
                                <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>"
                                       id="name" name="name"
                                       placeholder="Fullname" value="<?= old('name'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('name'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user
                                <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>"
                                       id="email" name="email"
                                       placeholder="Email Address" value="<?= old('email'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user
                                <?= ($validation->hasError('phone_number')) ? 'is-invalid' : ''; ?>"
                                       id="phone_number" name="phone_number"
                                       placeholder="Phone Number" value="<?= old('phone_number'); ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('phone_number'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user
                                    <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>"
                                           id="password" name="password"
                                           placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user
                                    <?= ($validation->hasError('password_confirmation')) ? 'is-invalid' : ''; ?>"
                                           id="password-confirmation" name="password_confirmation"
                                           placeholder="Repeat Password">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('password_confirmation'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('forgot-password') ?>">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('login') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
