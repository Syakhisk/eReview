<section id="subintro">
  <div class="jumbotron subhead" id="overview" style="margin-bottom:0px;">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Submit Review Form</h3>
            <p>
              Submit your review
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent" style="margin-top: 0px;">
  <div class="container">
    <style>
      td,
      th {
        font-size: 0.7rem;
        padding: 0.2rem 0;
      }

      .card {
        background-color: rgba(20, 21, 22, 0.1);
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 3rem;
      }

      tr>td:first-child {
        text-align: right;
        font-weight: bold;
      }

      tr>td:last-child {
        text-align: left;
        font-weight: normal;
      }

      input {
        margin-top: 10px;
        overflow: visible;
      }
    </style>

    <?php if (sizeof($error) > 0) : ?>
      <div class="alert alert-danger" role="alert">
        <?php foreach ($error as $err) {
          echo $err;
        } ?>
      </div>
    <?php endif ?>

    <div align='center' class="card">
      <!-- <form action="<?php //echo base_url('reviewerctl/submittingreview'); 
                          ?>" method="post" enctype="multipart/form-data"> -->
      <?= form_open_multipart(base_url('reviewerctl/submittingreview/' . $id_assignment)); ?>

      <table>
        <tr>
          <td>Article Title</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= $task[0]['judul'] ?>" readonly></td>
        </tr>
        <tr>
          <td>Keyword(s)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= $task[0]['keywords'] ?>" readonly></td>
        </tr>
        <tr>
          <td>Author(s)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= $task[0]['authors'] ?>" readonly></td>
        </tr>
        <tr>
          <td>Assigned by editor</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= $task[0]['id_editor'] ?>" readonly></td>
        </tr>
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
        <tr>
          <td>Upload Review:</td>
          <td colspan="2">
            <input type="file" name="userfile">
          </td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: center">
            <input class="btn btn-info" type="submit" value="Submit">
          </td>
        </tr>
      </table>

      </form>
    </div>
  </div>
</section>