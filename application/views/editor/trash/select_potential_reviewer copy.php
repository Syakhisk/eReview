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
	<div class="container p-2">
		<div class="row">
			<div class="container">

				<form class="form-horizontal" action="selectpotentialreviewer" method="post">
					<div class="container">
						<div class="form-group" style="margin-bottom: 20px">
							<label for="Task" class="col-sm-2 control-label" style="margin-right: 20px">Task</label>
							<div class="col-sm-10">
								<select class="span3">
									<option value="1">a</option>
									<option value="1">a</option>
									<option value="1">a</option>
									<option value="1">a</option>
									<option class="" disabled selected>Select Task</option>
								</select>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<label for="Reviewer" class="col-sm-2 control-label" style="margin-right: 20px">Reviewer</label>
							<div class="col-sm-10">
								<select multiple class="form-control" style="width: 270px">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<label for="Task" class="col-sm-2 control-label" style="margin-right: 20px">Title: </label>
							<div class="col-sm-10" style="padding-top:5px">
								<span name="judul">Judul Task</span>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<label for="Task" class="col-sm-2 control-label" style="margin-right: 20px">Authors: </label>
							<div class="col-sm-10" style="padding-top:5px">
								<span name="judul">Judul Task</span>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<label for="Task" class="col-sm-2 control-label" style="margin-right: 20px">Keyword: </label>
							<div class="col-sm-10" style="padding-top:5px">
								<span name="judul">Judul Task</span>
							</div>
						</div>

						<div class="form-group" style="margin-bottom: 20px">
							<label for="Task" class="col-sm-2 control-label" style="margin-right: 20px">Reviewer: </label>
							<div class="col-sm-10" style="padding-top:5px">
								<span name="judul">Judul Task</span>
							</div>
						</div>
					</div>


					<div class="form-group" style="margin-bottom: 20px">
						<div class="col-sm-offset-2 col-sm-10" style="display: flex; justify-content: center;">
							<button type=" submit" class="btn btn-default">Submit</button>
						</div>
					</div>
				</form>


			</div>
		</div>
	</div>
</section>