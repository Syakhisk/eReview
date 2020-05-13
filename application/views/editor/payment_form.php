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
        border-radius: 5px;
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
      <?= form_open_multipart(base_url('editorctl/committingPayment/'.$selected_id)); ?>

      <table>
        <tr>
          <td>Assignment</td>
          <td>:</td>
          <td>
            <?php
            $flag = true;

            $mapped_task[''] = '-Select Task-';
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
        <?php
        if ($selected) {
          $harga = $selected['jumlah_hal'] * 100000;
          if ($harga > $balance) { ?>
            <tr style="text-align: center">
              <td colspan="3" style="color: red">Insufficient Balance, Please Top Up!</td>
            </tr>
        <?php
            $flag = false;
          }
        }
        ?>
        <tr>
          <td>Your Balance(Rp)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= number_format(($balance), 2, ',', '.') ?>" readonly></td>
        </tr>
        <!-- <tr>
          <td>Payment Receipt</td>
          <td>:</td>
          <td>
            <input type="file" name="userfile">
          </td>
        </tr> -->
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: center">
            <?php if ($flag && $selected_id) : ?>
              <button class="btn btn-info" type="submit">Commit Payment</button>
            <?php elseif (!$flag && $selected_id) : ?>
              <div class="btn btn-danger">Insufficient Balance</div>
            <?php elseif (!$selected_id) : ?>
              <div class="btn btn-info">Select Task</div>
            <?php else : ?>
              <div></div>
            <?php endif; ?>
          </td>
        </tr>
      </table>

      </form>

      <script>
        let dropdown = document.getElementsByName("assignment")[0];
        dropdown.addEventListener("change", function() {
          window.location.href = "<?= base_url('editorctl/commitpayment/'); ?>" + dropdown.value;
        });
      </script>
    </div>
  </div>
</section>