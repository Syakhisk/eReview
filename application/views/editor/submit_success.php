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
                <h2>Assign Review Success</h2>
                <p>
                  You have sucessfully assign:
                </p>
                <h4>
                  <?= $judul ?>
                </h4>
                <p>to:</p>
                <h4>
                  <?= join(", ", $reviewers); ?>
                </h4>
              </div>
              <p>Go back to <a href="<?= base_url('editorctl/viewtask') ?>">task list</a></p>
            </div>
          </div>
        </div>
        <!-- end tagline -->
      </div>
    </div>
  </div>
</section>