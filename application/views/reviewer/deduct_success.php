<section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text">
                    <br>
                  <h2>Deduction Page</h2>
                  <div align="center">
                      <table>
                        <tr>
                          <td>
                          <?php echo form_open_multipart(base_url() . '/reviewerctl/deductfunds');?>
                            <table>
                                <tr>
                                  <td colspan="3" style="text-align:center">You have successfully deduct Rp. <?= number_format($amount, 2, ',', '.')?></td>
                                </tr>
                                <tr>
                                  <td>Account Number</td>
                                  <td>:</td>
                                  <td><input type="number" id="acc" name="acc" width="100" value="<?php echo $session_data['no_rek']?>" style="text-align:right" readonly/></td>
                                </tr>
                                <tr>
                                  <td>Balance</td>
                                  <td>:</td>
                                  <td><input type="number" id="balance" name="balance" width="100" value="<?php echo $session_data['balance'] ?>" style="text-align:right" readonly/></td>
                                </tr>
                            </table>
                          </form>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end tagline -->
        </div>
      </div>
    </div>
  </section>