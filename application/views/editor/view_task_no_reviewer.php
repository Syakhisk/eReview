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
      <li><a class="btn btn-success" href="selectpotentialreviewer"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
    </ul>
    <ul class="nav nav-tabs">
      <li> <a href="viewtask">All Task</a> </li>
      <li><a href="viewtaskreviewer">Assigned</a></li>
      <li class="active"><a href="viewtasknoreviewer">Not Assigned</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>Title</th>
            <th>Keyword(s)</th>
            <th>Filename</th>
            <th>Date Submitted</th>
            <th>Reviewer(s)</th>
          </tr>
          <?php $i = 1;
          foreach ($tasks as $item) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['judul']; ?></td>
              <td><?= $item['keywords']; ?></td>
              <td><?= $item['filelocation']; ?></td>
              <td><?= $item['date_created']; ?></td>
              <td></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>