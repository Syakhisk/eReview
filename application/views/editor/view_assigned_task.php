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
      <li><a class="btn btn-info" href="<?= base_url('editorctl/viewassignedtask')?>"> <i class="icon-file icon-white"></i> Tasks </a></li>
      <li><a class="btn btn-success" href="<?= base_url('editorctl/selectpotentialreviewer')?>"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
      <li><a class="btn btn-danger" href="<?= base_url('editorctl/commitpayment')?>"> <i class="icon-tasks icon-white"></i> Payment </a></li>
    </ul>
    <ul class="nav nav-tabs">
      <li> <a href="viewtask">All Task</a> </li>
      <li class="active"><a href="viewassignedtask">Assigned</a></li>
    </ul>
    <div class="row">
      <div class="span12">
      <style>tr>td:first-child{width:10px}</style>
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
                else if ($item['status'] == 1) $item['status'] = "Accepted";
                else if ($item['status'] == 2) $item['status'] = "Unpaid";
                else if ($item['status'] == 3) $item['status'] = "Paid Unconfirmed";
                else if ($item['status'] == 4) $item['status'] = "Paid Confirmed";
                echo $item['status'];
                ?>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>