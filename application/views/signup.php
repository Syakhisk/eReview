  <section id="intro">
  </section>
  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text">
                  <h2>Sign-up Form</h2>
                  <p>
                    Fill in your account details! Field with <span style="color:red">*</span> is required
                  </p>

                  <!-- Alert Form Validation -->
                  <?php if (strlen($error)>0) { ?>
                    <div class="alert alert-danger" role="alert">
                      <?= $error; ?>
                    </div>
                  <?php }?>

                  <div align="center">
                    <?= form_open_multipart(base_url('AccountCtl/signingUp'));?>
                      <table>
                        <tr>
                          <td>*Nama: </td>
                          <td><input type="text" id="nama" name="nama" width="100" /></td>
                        </tr>
                        <tr>
                          <td>*Username: </td>
                          <td><input type="text" id="username" name="username" width="100" /></td>
                        </tr>
                        <tr>
                          <td>*Password: </td>
                          <td><input type="password" id="sandi" name="sandi" width="100" /></td>
                        </tr>
                        <tr>
                          <td>*Email: </td>
                          <td><input type="text" id="email" name="email" width="100" /></td>
                        </tr>
                        <tr>
                          <td>*Roles: </td>
                          <td>
                            <input type="radio" name="roles[]" value="1" width="100" checked/>Editor
                            <br>
                            <input type="radio" name="roles[]" value="2" width="100" />Reviewer
                          </td>
                        </tr>
                        <tr>
                          <td>Photo: </td>
                          <td><input type="file" id="photo" name="photo" width="100" /></td>
                        </tr>
                      </table>

                      <input type="submit" value="Sign-up">
                      <?= form_close(); ?>
                    <p><a href="<?php echo base_url() . "AccountCtl/login" ?>">Login</a> to eReview</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end tagline -->
        </div>
      </div>
    </div>
  </section>