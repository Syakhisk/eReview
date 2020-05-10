<html>

<head>
	<title>Select Reviewer</title>
</head>

<body>
	<h1>Select Reviewer</h1>
	<p>
		A new task has been sucsessfully added
	</p>
	
	<table>
		<tr>
			<td>Judul</td>
			<td>:</td>
			<!-- $task ada di managemytask.php selectpotentialreviewer() -->
			<!-- 'judul' itu key dari array task (query db) -->
			<td><?php echo $task['judul'] ?></td>
		</tr>
		<tr>
			<td>Kata Kunci</td>
			<td>:</td>
			<td><?php echo $task['keywords'] ?></td>
		</tr>
		<tr>
			<td>Authors</td>
			<td>:</td>
			<td><?php echo $task['authors'] ?></td>
		</tr>
		<tr>
			<!--bedanya penggunaan name utk field di form dan id utk php -->
			<td>Reviewer</td>
			<td>:</td>
			<td>
				<select name="" id="reviewer">
					<?php
						for($x = 0; $x < count($reviewers); $x++){
							echo '<option value="';
							echo $reviewers[$x]['id_reviewer'];
							echo '">';
							echo $names[$x]['nama'];
							echo '</option>';
						}
					?>
					
				</select>
			</td>
		</tr>
		<tr>
						<?php 
							// echo $names[0]['nama'];
							// echo $names[0]['nama'];
							// print_r(array_values($names));
						?>
						
						
		</tr>
		<tr>
			<td>Simpan</td>
			<td><?php echo "Submit"; ?></td>
		</tr>
	</table>
</body>

</html>