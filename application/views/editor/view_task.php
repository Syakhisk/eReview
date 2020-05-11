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
      <li class="active"> <a href="viewtask">All Task</a> </li>
      <li><a href="viewassignedtask">Assigned</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <style>
          tr>td:first-child {
            width: 10px
          }
        </style>
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Author(s)</th>
            <th>Page(s) Count</th>
            <th>Date Submitted</th>
          </tr>
          <?php $i = 1;
          foreach ($tasks as $item) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['judul']; ?></td>
              <td><?= $item['authors']; ?></td>
              <td><?= $item['jumlah_hal']; ?></td>
              <td><?= $item['date_created']; ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>