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
      <li class="active"><a href="viewacceptedassignment">Accepted</a></li>
      <li><a href="viewrejectedassignment">Rejected</a></li>
      <li><a href="viewcompletedassignment">Completed</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <style>tr>td:first-child{width:10px}</style>
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Page(s) Count</th>
            <th>Keyword(s)</th>
            <th>Author(s)</th>
            <th>Assigned by Editor</th>
            <th>Deadline</th>
            <th>Action</th>
          </tr>
          <?php $i = 1;
          foreach ($assignment as $item) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['judul']; ?></td>
              <td><?= $item['jumlah_hal']; ?></td>
              <td><?= $item['keywords']; ?></td>
              <td><?= $item['authors']; ?></td>
              <td><?= $item['nama_editor']; ?></td>
              <td style="color: red"><?= $item['tgl_deadline']; ?></td>
              <td style="display:flex">
                <a href="downloadtask/<?= base64_encode($item['id_assignment']); ?>" class="btn btn-info" style="margin-right: 10px">Download</a>
                <a href="submitreview/<?= $item['id_assignment']; ?>" class="btn btn-info">Submit</a>
              </td>
              <td></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>