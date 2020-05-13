<section id="subintro">
	<div class="jumbotron subhead" id="overview">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="centered">
						<h3>Select Potential Reviewer</h3>
						<p>
							Select reviewer(s) for corresponding task
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="maincontent">
	<div class="container">
		<div class="row">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li><a class="btn btn-info" href="<?= base_url('editorctl/viewassignedtask') ?>"> <i class="icon-file icon-white"></i> Tasks </a></li>
					<li><a class="btn btn-success" href="<?= base_url('editorctl/selectpotentialreviewer') ?>"> <i class="icon-plus-sign icon-white"></i> Select Potential Reviewer</a></li>
					<li><a class="btn btn-danger" href="<?= base_url('editorctl/commitpayment') ?>"> <i class="icon-tasks icon-white"></i> Payment </a></li>
				</ul>
				<div class="tagline centered">
					<div class="row">
						<div class="span12">
							<div class="tagline_text">
								<div align="center">

									<form action="<?= base_url('editorctl/selectingpotentialreviewer'); ?>" method="post">

										<h3>Please select the article and the reviewers</h3>
										<p>you can select mulitple reviewer by using <code>ctrl</code> button</p>

										<?php if ($msg != '') : ?>
											<div class="alert alert-danger" role="alert">
												<?php echo $msg; ?>
											</div>
										<?php endif; ?>

										<table>
											<tr>
												<td>Article</td>
												<td>:</td>
												<td>
													<?php
													$mapped_task[''] = '-Select Task-';
													foreach ($tasks as $task) {
														$mapped_task[$task['id_task']] = $task['judul'];
													}
													echo form_dropdown('article', $mapped_task, $mapped_task['']);
													?>
												</td>
											</tr>

											<tr>
												<td>Reviewer(s)</td>
												<td>:</td>
												<td>

													<select name="reviewers[]" multiple>
														<?php foreach ($reviewers as $item) : ?>
															<option value="<?= $item['id_reviewer'] ?> "><?= $item['nama'] ?> </option>
														<?php endforeach; ?>
													</select>

												</td>
											</tr>

											<tr>
												<td colspan="3" class="centered">
													<input type="submit" class="btn btn-success" value="Select">
												</td>
											</tr>

										</table>
									</form>
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