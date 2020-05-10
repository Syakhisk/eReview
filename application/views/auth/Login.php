<body>

    <!-- <div class="container">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="col-lg-7 text-center text-dark mx-auto py-3">
                <h1 class="font-weight-bold">E-Review</h1>
            </div>
        </div>
    </div> -->

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-7 my-5">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <!-- Judul -->
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Account Form</h1>
                                    </div>

                                    <!-- Alert Form Validation -->
                                    <?php if ($msg != '') : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $msg; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Sucess Register -->
                                    <?php if ($this->session->flashdata('msgSuccess') != '') {
                                        echo $this->session->flashdata('msgSuccess');
                                    } ?>

                                    <!-- Form -->
                                    <form class="user" action="<?php echo site_url('AccountCtl/checkingLogin'); ?>" method="post">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="sandi" name="sandi" placeholder="Password">
                                        </div>
                                        <div class=" px-0 mx-auto">
                                            <input class="btn btn-success btn-user btn-block" type="submit" value="Login">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('AccountCtl/creatingAccount') ?>">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>