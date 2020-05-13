<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Top Up Requests</h3>
            <p>
              View all top up requests from the database
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
      <li class=""><a href="3">Pending</a> </li>
      <li class=""><a href="4">Confirmed</a></li>
      <li class="active"><a href="2">Rejected</a></li>
    </ul>
    <div class="row">
      <div class="span12">
        <style>
          tr>td:first-child {
            width: 10px
          }
          table{
            font-size:13px;
          }
        </style>
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>ID Dana</th>
            <th>Requested By</th>
            <th>Role</th>
            <th>Amount</th>
            <th>Receipt</th>
          </tr>
          <?php $i = 1;
          foreach ($requests as $item) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['id_dana'] ?></td>
              <td><?= $item['nama'] ?></td>
              <td>Editor <?= $item['id_editor'] ?></td>
              <td><?= $item['amount'] ?></td>
              <td>
                <a class="btn btn-info" href="<?= base_url('paymentctl/downloadbukti/' . base64_encode($item['bukti'])) ?>">
                  Download Receipt
                </a>
              </td>

            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>