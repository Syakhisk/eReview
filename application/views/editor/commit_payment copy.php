<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Payment</h3>
            <p>
              View your payment status for the review
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent">
  <div class="container">
    <div class="span12">

      <ul class="nav nav-tabs">
        <li><a class="btn btn-info" href="<?= base_url('editorctl/viewassignedtask') ?>"> <i class="icon-file icon-white"></i> Tasks </a></li>
        <li><a class="btn btn-success" href="<?= base_url('editorctl/selectpotentialreviewer') ?>"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
        <li><a class="btn btn-danger" href="<?= base_url('editorctl/commitpayment') ?>"> <i class="icon-tasks icon-white"></i> Payment </a></li>
      </ul>
      <ul class="nav nav-tabs">
        <li class="<?php if ($this->uri->segment(3) == "2") {
                      echo "active";
                    } ?>"><a href="<?= base_url('editorctl/commitpayment/2') ?>">Unpaid</a></li>
        <li class="<?php if ($this->uri->segment(3) == "3") {
                      echo "active";
                    } ?>"><a href="<?= base_url('editorctl/commitpayment/3') ?>">Awating Makelaar Confirmation</a></li>
        <li class="<?php if ($this->uri->segment(3) == "4") {
                      echo "active";
                    } ?>"><a href="<?= base_url('editorctl/commitpayment/4') ?>">Paid & Confirmed</a></li>
      </ul>
      <div class="row">
        <div class="span6">
          <style>
            tr>td:first-child {
              width: 10px
            }
            a+a{
              color: green;
              font-weight: bold;
            }
          </style>
          <table class="table table-hover table-striped">
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Author(s)</th>
              <th>Date Submitted</th>
              <th>Reviewer(s)</th>
              <th>Status</th>
            </tr>
            <?php $i = 1;
            foreach ($article as $item) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><a href="<?= base64_encode($item['id_assignment']) ?>"><?= $item['judul']; ?></a></td>
                <td><?= $item['authors']; ?></td>
                <td><?= $item['date_created']; ?></td>
                <td><?= $item['nama']; ?></td>
                <td>
                  <a href="<?= base64_encode($item['id_assignment']) ?>">
                    <?php
                    $link = base64_encode($item['review_location']);
                    if ($item['status'] == 0) $item['status'] = "Not Yet Accepted";
                    else if ($item['status'] == 1) $item['status'] = "Accepted";
                    else if ($item['status'] == 2) $item['status'] = "Unpaid";
                    else if ($item['status'] == 3) $item['status'] = "Paid Unconfirmed";
                    else if ($item['status'] == 4) $item['status'] = "Paid Confirmed <a href='" . base_url('editorctl/downloadreview/'.$link) . "'>Download</a>";
                    echo $item['status'];
                    ?>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>

        <div class="span6">
          <form action="<?= base_url('editorctl/updatepaymentform/2'); ?>" method="post" align="center">

            <h3>Please select the assignment that you want to pay</h3>

            <?php if ($msg != '') : ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $msg; ?>
              </div>
            <?php endif; ?>

            <table align="center">
              <tr>
                <td>Assignment</td>
                <td>:</td>
                <td>
                  <?php
                  $mapped_task[''] = '-Select Task-';
                  if (!$selected) {
                    $selected = $mapped_task[''];
                  }
                  foreach ($article as $task) {
                    $mapped_task[$task['id_assignment']] = $task['judul'];
                  }
                  echo form_dropdown('assignment', $mapped_task, $selected);
                  ?>
                </td>
              </tr>

              <tr>
                <td>Page(s) Count</td>
                <td>:</td>
                <td>
                  <input type="number" name="halaman" value="<?php if ($form) echo $form['halaman']; ?>" readonly>
                </td>
              </tr>

              <tr>
                <td>Amount (IDR)</td>
                <td>:</td>
                <td>
                  <input type="number" name="amount" value="<?php if ($form) echo $form['amount']; ?>" readonly>
                </td>
              </tr>

              <tr>
                <td colspan="3" class="centered">
                  <input type="submit" href="<?= base_url('editorctl/updatepaymentform') ?>" class="btn btn-info" value="Estimate Price">
                  <!-- <a href="<= //base_url('editorctl/updatepaymentform') ?" class="btn btn-info">Update Data</a> -->
                  <a class="btn btn-success" value="Pay" id="commit">Commit Payment</a>
                </td>
              </tr>

            </table>
          </form>

          <script type="text/javascript">
            let button = document.getElementById('commit');
            button.addEventListener("click", function(){
              let flag = confirm("Are you sure this is the correct payment?");
              if (flag) {
                window.location.href = "<?php echo base_url('editorctl/committhispayment/'.$task['id_assignment']); ?>";
              }

            })
          </script>

        </div>
      </div>

    </div>
  </div>
</section>