<section id="subintro">
  <div class="jumbotron subhead" id="overview">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="centered">
            <h3>Payment Requests</h3>
            <p>
              View all payment requests from the database
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
      <li class="active"><a href="<?= base_url('paymentctl/paymentconfirmation/3') ?>">Pending</a> </li>
      <li class=""><a href="<?= base_url('paymentctl/paymentconfirmation/4') ?>">Confirmed</a></li>
      <!-- <li class=""><a href="2">Rejected</a></li> -->
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
        <?php if ($this->session->flashdata('payment_confirmed')) : ?>
          <div class="alert alert-success"><?= $this->session->flashdata('payment_confirmed') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('payment_rejected')) : ?>
          <div class="alert alert-danger"><?= $this->session->flashdata('payment_rejected') ?></div>
        <?php endif; ?>
        <table class="table table-hover table-striped">
          <tr>
            <th>No</th>
            <th>ID Payment</th>
            <th>ID Assignment</th>
            <th>Title</th>
            <th>Review</th>
            <th>Requested By Editor</th>
            <th>Requested For Reviewer</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
          <?php $i = 1;
          foreach ($requests as $item) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $item['id_pembayaran'] ?></td>
              <td><?= $item['id_assignment'] ?></td>
              <td><?= $item['judul'] ?></td>
              <td>
                <a href="<?= base_url('makelaarctl/downloadreview/'. base64_encode($item['review_location'])) ?>" class="btn btn-info"> Download</a>
              </td>
              <td><?= $item['nama_editor'] ?></td>
              <td><?= $item['nama_reviewer'] ?></td>
              <td><?= $item['amount'] ?></td>
              <td>
                <a href="<?= base_url('paymentctl/confirmpayment/' . base64_encode($item['id_pembayaran'])) ?>" class="btn btn-success">Confirm</a>
                <!-- <a href="<?= base_url('paymentctl/rejectpayment/' . base64_encode($item['id_pembayaran'])) ?>" class="btn btn-danger">Reject</a> -->
              </td>
              <td></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
</section>