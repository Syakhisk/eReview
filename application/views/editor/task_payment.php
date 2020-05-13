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
  <div class="container" style="margin-left: 174.6px">
    <ul class="nav nav-tabs">
      <li><a class="btn btn-info" href="<?= base_url('editorctl/viewassignedtask') ?>"> <i class="icon-file icon-white"></i> Tasks </a></li>
      <li><a class="btn btn-success" href="<?= base_url('editorctl/selectpotentialreviewer') ?>"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
      <li><a class="btn btn-danger" href="<?= base_url('editorctl/commitpayment') ?>"> <i class="icon-tasks icon-white"></i> Payment </a></li>
    </ul>
    <ul class="nav nav-tabs">
      <li class=""><a href="viewtask">All Task</a> </li>
      <li class=""><a href="viewassignedtask">Assigned Task</a></li>
      <li class="<?= ($this->uri->segment(2) == 'viewunpaidtask' ? 'active' : ''); ?>"><a href="<?= base_url('editorctl/viewunpaidtask') ?>">Unpaid Task</a></li>
      <!-- <li class="<?= ($this->uri->segment(2) == 'viewawaitingconfirmationtask' ? 'active' : ''); ?>"><a href="<?= base_url('editorctl/viewawaitingconfirmationtask') ?>">Awating Makelaar Confirmation</a></li> -->
      <li class="<?= ($this->uri->segment(2) == 'viewpaidtask' ? 'active' : ''); ?>"><a href="<?= base_url('editorctl/viewpaidtask') ?>">Paid & Confirmed Payment</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <style>
          tr>td:first-child {
            width: 10px
          }

          a+a {
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
              <td><a href="<?= base_url('editorctl/commitpayment/'.base64_encode($item['id_assignment'])) ?>"><?= $item['judul']; ?></a></td>
              <td><?= $item['authors']; ?></td>
              <td><?= $item['date_created']; ?></td>
              <td><?= $item['nama']; ?></td>
              <td>
                <a href="<?= base_url('editorctl/commitpayment/'.base64_encode($item['id_assignment'])) ?>">
                  <?php
                  $link = base64_encode($item['review_location']);
                  if ($item['status'] == 0) $item['status'] = "Not Yet Accepted";
                  else if ($item['status'] == 1) $item['status'] = "Accepted";
                  else if ($item['status'] == 2) $item['status'] = "Completed, Unpaid";
                  else if ($item['status'] == 3) $item['status'] = "Paid";
                  else if ($item['status'] == 4) $item['status'] = "Paid Confirmed <a href='" . base_url('editorctl/downloadreview/' . $link) . "'>Download</a>";
                  echo $item['status'];
                  ?>
                </a>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>

    </div>

  </div>
</section>