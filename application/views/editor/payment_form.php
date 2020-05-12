<section id="subintro">
  <div class="jumbotron subhead" id="overview" style="margin-bottom:0px;">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Commit Payment Form</h3>
            <p>
              Payment Form
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
      .card {
        background-color: rgba(20, 21, 22, 0.1);
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 3rem;
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
      <?= form_open_multipart(base_url('reviewerctl/committingPayment/')); ?>

      <table>
        <tr>
        <td>Assignment</td>
        <td>:</td>
        <td>
          <?php
          $mapped_task[''] = '-Select Task-';
          if (!$selected_id) {
            $selected_id = $mapped_task[''];
          }
          foreach ($assignments as $task) {
            $mapped_task[$task['id_assignment']] = $task['judul'];
          }
          echo form_dropdown('assignment', $mapped_task, $selected_id);
          ?>
        </td>
        </tr>

        <tr>
          <td>Author(s)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= (!$selected_id ? '' : $selected['authors']) ?>" readonly></td>
        </tr>
        <tr>
          <td>Assigned to Reviewer</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= (!$selected_id ? '' : $selected['nama']) ?>" readonly></td>
        </tr>
        <tr>
          <td>Page(s) count</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= (!$selected_id ? '' : $selected['jumlah_hal']) ?>" readonly></td>
        </tr>
        <tr>
          <td>Amount(Rp)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= (!$selected_id ? '' :  number_format(($selected['jumlah_hal'] * 100000), 2, ',', '.')) ?>" readonly></td>
        </tr>
        <tr>
          <td>Upload Review:</td>
          <td colspan="2">
            <input type="file" name="userfile">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: center">
            <input class="btn btn-info" type="submit" value="Commit Payment">
          </td>
        </tr>
      </table>

      </form>

      <script>
        let dropdown = document.getElementsByName("assignment")[0];
        dropdown.addEventListener("change", function(){
          window.location.href = "<?= base_url('editorctl/commitpayment2/'); ?>" + dropdown.value;
        });
      </script>
    </div>
  </div>
</section>