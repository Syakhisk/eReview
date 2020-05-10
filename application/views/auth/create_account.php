<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 my-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <?php if ($msg != '') : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $msg; ?>
                            </div>
                        <?php endif; ?>
                        <form class="user" action="<?php echo site_url('AccountCtl/creatingAccount'); ?>" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" id="sandi" name="sandi" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="peran">Peran</label>
                                <select class="form-control" id="peran" name="peran">
                                    <option value="1" selected>Editor</option>
                                    <option value="2">Reviewer</option>
                                </select>
                            </div>
                            <input type="submit" value="Create Account" class="btn btn-success btn-block">
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('AccountCtl/Login') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>