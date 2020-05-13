<section id="subintro">
  <div class="jumbotron subhead" id="overview" style="margin-bottom:0px;">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Topup Balance Form</h3>
            <p>
              Topup your balance
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="maincontent" style="margin-top: 0px; padding-bottom: 30px">
  <div class="container">
    <style>
      .card {
        background-color: rgba(20, 21, 22, 0.1);
        padding: 1rem;
        border-radius: 5px;
        padding-top: 40px;
      }

      input {
        margin-top: 10px;
        overflow: visible;
        margin-bottom: 3rem;
        height: 30px !important;

      }

      table {
        font-size: 13px;
        vertical-align: middle
      }

      .file {
        vertical-align: middle;
        margin-bottom: 0px;
      }
    </style>

    <?php if (sizeof($error) > 0) : ?>
      <div class="alert alert-danger" role="alert">
        <?php foreach ($error as $err) {
          echo $err;
        } ?>
      </div>
    <?php endif ?>

    <?php if (strlen($msg) > 0) : ?>
      <div class="alert alert-success" role="alert">
        <?= $msg ?>
      </div>
    <?php endif ?>

    <div align='center' class="card">
      <?= form_open_multipart(base_url('paymentctl/submittopup')); ?>

      <table>

        <tr>
          <td>Current Balance (Rp)</td>
          <td>:</td>
          <td><input type="text" name="" value="<?= number_format($session_data['balance'], 2, ',', '.') ?>" readonly></td>
        </tr>
        <tr>
          <td>Topup Amount (Rp)</td>
          <td>:</td>
          <td>
            <input type="number" name="amount" value="0">
          </td>
        </tr>
        <tr>
          <td>Payment Receipt</td>
          <td>:</td>
          <td>
            <input class="file" type="file" name="userfile">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <hr>
          </td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: center">
            <input class="btn btn-info" type="submit" value="Submit Topup">
          </td>
        </tr>
      </table>

      </form>
    </div>
  </div>
</section>