<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Select Potential Reviewer</h3>
            <p>
              Select reviewer(s) for corresponding task
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="tagline centered">
          <div class="row">
            <div class="span12">
              <div class="tagline_text">
                <div align="center">
                  <form action="submittingReviewer" method="post">
                    <h3>You have selected the article and reviewers</h3>
                    <p>go <a href="<?= base_url('editorctl/selectpotentialreviewer') ?>">back</a> if you made a mistake</p>

                    <?php if ($msg != '') : ?>
                      <div class="alert alert-danger" role="alert">
                        <?php echo $msg; ?>
                      </div>
                    <?php endif; ?>

                    <style>
                      th,
                      td {
                        font-size: 1.7em;
                        margin: 10px;
                        padding: 10px;
                        /* border-bottom: 1px solid #ddd; */
                      }

                      td>input {
                        font-weight: bolder;
                      }
                    </style>
                    <table>
                      <tr>
                        <td>Article</td>
                        <td>:</td>
                        <td>
                          <input name="article" type="hidden" value="<?= $article[0]['id_task'] ?>" readonly>
                          <input name="" type="text" value="<?= $article[0]['judul'] ?>" readonly>
                        </td>
                      </tr>

                      <tr>
                        <td>Reviewer(s)</td>
                        <td>:</td>
                        <td>
                          <!-- input hidden biar passing ke post nya gampang -->
                          <!-- $index itu index dari tiap elemen $reviewers -->
                          <?php foreach ($reviewers as $index=>$item) { ?>
                            <input type="hidden" name="reviewers[]" value="<?= $index ?>">
                          <?php } ?>
                          <input name="" type="text" value="<?= join(", ", $reviewers); ?>" readonly>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="3" class="centered">
                          <input style="margin-top: 20px" type="submit" class="btn btn-success" value="Submit">
                        </td>
                      </tr>
                    </table>
                  </form>
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