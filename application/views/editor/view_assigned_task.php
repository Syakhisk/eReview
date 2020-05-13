<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Task List</h3>
            <p>
              View all task from the database
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent">
  <div class="container">
    <ul class="nav nav-tabs">
      <li><a class="btn btn-info" href="<?= base_url('editorctl/viewassignedtask') ?>"> <i class="icon-file icon-white"></i> Tasks </a></li>
      <li><a class="btn btn-success" href="<?= base_url('editorctl/selectpotentialreviewer') ?>"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
      <li><a class="btn btn-danger" href="<?= base_url('editorctl/commitpayment') ?>"> <i class="icon-tasks icon-white"></i> Payment </a></li>
    </ul>
    <ul class="nav nav-tabs">
      <li class=""><a href="<?= base_url('editorctl/viewtask') ?>">All Task</a> </li>
      <li class="active"><a href="<?= base_url('editorctl/viewassignedtask') ?>">Assigned Task</a></li>
      <li class=""><a href="<?= base_url('editorctl/viewunpaidtask') ?>">Unpaid Task</a></li>
      <li class=""><a href="<?= base_url('editorctl/viewawaitingconfirmationtask') ?>">Awating Makelaar Confirmation</a></li>
      <li class=""><a href="<?= base_url('editorctl/viewpaidtask') ?>">Paid & Confirmed Payment</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <style>
          tr>td:first-child {
            width: 10px
          }

          a.btn-mini {
            width: 80%
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
            <th></th>
          </tr>
          <?php $i = 1;
          foreach ($assignment as $item) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['judul']; ?></td>
              <td><?= $item['authors']; ?></td>
              <td><?= $item['date_created']; ?></td>
              <td><?= $item['nama']; ?></td>
              <td>
                <?php
                if ($item['status'] == 0) $item['status'] = "Not Yet Accepted";
                else if ($item['status'] == -1) $item['status'] = "Rejected";
                else if ($item['status'] == 1) $item['status'] = "Accepted";
                else if ($item['status'] == 2) $item['status'] = "Completed, Unpaid";
                else if ($item['status'] == 3) $item['status'] = "Completed, Awaiting Makelaar Confirmation";
                else if ($item['status'] == 4) $item['status'] = "Completed, Paid Confirmed";
                echo $item['status'];
                ?>
              </td>
              <td align="center" style="display: flex; justify-content:center">
                <?php if ($item['status'] == "Completed, Unpaid") : ?>
                  <a class="btn btn-mini btn-info" href="<?= base_url('editorctl/commitpayment/' . base64_encode($item['id_assignment'])) ?>">Pay Now</a>
                <?php elseif ($item['status'] == "Completed, Paid Confirmed") : ?>
                  <a class="btn btn-mini btn-success" href="<?= base_url('editorctl/downloadreview/' . base64_encode($item['review_location'])) ?>">Download Review</a>
                <?php endif ?>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>