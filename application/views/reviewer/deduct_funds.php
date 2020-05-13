<section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text">
                    <br>
                  <h2>Account Page</h2>
                  <div align="center">
                      <table>
                        <tr>
                          <td width="66%">
                          <?php echo form_open_multipart(base_url() . 'reviewerctl/deductingfunds');?>
                            <table align="center">
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
                                <tr>
                                  <td>Deduct Funds</td>
                                  <td>:</td>
                                  <td><input type="number" id="amount" name="amount" width="100" min="0" 
                                  max="<?= $session_data['balance']?>"></td>
                                </tr>
                            </table>
                          <p align="center"><input type="submit" value="Deduct"></p>
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