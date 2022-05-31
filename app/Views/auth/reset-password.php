<?= $this->extend('layout/auth/template'); ?>
<?= $this->section('content'); ?>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"
                             style="background: url('<?= base_url('assets/img/reset-password.jpg'); ?>');background-size:cover;background-position:center;"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Enter new password</h1>
                                </div>
                                <form class="user" method="post" action="<?= base_url('/reset-password'); ?>">
                                    <input type="text" id="user_id" name="user_id" value="<?= $request['user_id'] ?>" hidden>
                                    <input type="text" id="request_id" name="request_id" value="<?= $request['request_id'] ?>" hidden>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password"
                                               name="password" placeholder="Password">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password_confirmation"
                                               name="password_confirmation" placeholder="Password Confirmation">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password_confirmation'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('login') ?>">Already have an account? Login
                                        here!</a>
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
