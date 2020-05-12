<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Assignment List</h3>
            <p>
              View all assignment from the database
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent">
  <div class="container">
    <?php if ($this->session->flashdata('assignsuccess')) {
      echo $this->session->flashdata('assignsuccess');
    } ?>
    <ul class="nav nav-tabs">
      <li><a href="viewassignment">Waiting List</a> </li>
      <li><a href="viewacceptedassignment">Accepted</a></li>
      <li><a href="viewrejectedassignment">Rejected</a></li>
      <li class="active"><a href="viewcompletedassignment">Completed</a></li>
    </ul>
    <style>tr>td:first-child{width:10px;}tr>td{color:green}</style>
    <div class="row">
      <div class="span12">
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Page(s) Count</th>
            <th>Keyword(s)</th>
            <th>Assigned by Editor</th>
            <th>Status</th>
          </tr>
          <?php $i = 1;
          foreach ($assignment as $item) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['judul']; ?></td>
              <td><?= $item['jumlah_hal']; ?></td>
              <td><?= $item['keywords']; ?></td>
              <td><?= $item['nama_editor']; ?></td>
              <td style="display:flex">
              <?php
                if ($item['status'] == 0) $item['status'] = "Not Yet Accepted";
                else if ($item['status'] == 1) $item['status'] = "Accepted";
                else if ($item['status'] == 2) $item['status'] = "Unpaid";
                else if ($item['status'] == 3) $item['status'] = "Paid Unconfirmed";
                else if ($item['status'] == 4) $item['status'] = "Paid Confirmed";
                ?>
                <strong><?= $item['status']; ?></strong>
              </td>
              <td></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>