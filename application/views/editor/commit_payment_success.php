2 <section id="intro">
</section>
<section id="maincontent">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="tagline centered">
          <div class="row">
            <div class="span12">
              <div class="tagline_text">
                <h2>Commit Payment Success</h2>
                <p>
                  You have sucessfully paid the assignment:
                </p>
                <h4>
                  <?= $judul ?>
                </h4>
                <p>to:</p>
                <h4>
                  <?= $reviewer; ?>
                </h4>
                <p>You can now download the reviewed article after the makelaar confirmed the assignment completion</p>
                <p>Go back to <a href="<?= base_url('editorctl/viewtask')?>">Task List</a> or <a href="<?= base_url('editorctl/commitpayment')?>">Payment</a></p>
              </div>
            </div>
          </div>
        </div>
        <!-- end tagline -->
      </div>
    </div>
  </div>
</section>