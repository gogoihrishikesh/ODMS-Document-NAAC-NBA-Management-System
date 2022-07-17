<style>
	.custom-menu {
		z-index: 1000;
		position: absolute;
		background-color: #ffffff;
		border: 1px solid #0000001c;
		border-radius: 50%;
		padding: 8px;
		min-width: 13vw;
	}

	a.custom-menu-list {
		width: 100%;
		display: flex;
		color: #4c4b4b;
		font-weight: 600;
		font-size: 1em;
		padding: 1px 11px;
	}

	span.card-icon {
		position: absolute;
		font-size: 3em;
		bottom: .2em;
		color: #ffffff80;
	}

	.file-item {
		cursor: pointer;
	}

	a.custom-menu-list:hover,
	.file-item:hover,
	.file-item.active {
		background: #80808024;
	}

	table th,
	td {
		border-left: 1px solid gray;
		/* Edited*/
	}

	a.custom-menu-list span.icon {
		width: 1em;
		margin-right: 5px;
	}
</style>
<nav aria-label="breadcrumb " style="margin:16px; ">
	<ol class="breadcrumb" style="background-color: #fff ;  ; border-radius:15px; padding-left:45px;">
		<li class="breadcrumb-item " style="color: #222; font-size:25px; "><b>HOME</b></li>
	</ol>
</nav>
<div class="containe-fluid">
	<?php include('db_connect.php');

	$usr = $_SESSION['login_type'];
	if ($usr == 1) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 OR f.is_admin = 1 order by date(f.date_updated) desc");
	} elseif ($usr == 2) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 OR f.is_dean = 1 order by date(f.date_updated) desc");
	} else {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 OR f.is_hod = 1 order by date(f.date_updated) desc");
	}

	?>
	<div class="row" style="display: flex; gap:10px; margin-left :2px; margin-right:2px;">
		<div class="col-lg-12">

			<div class="  float-left" style="background-color: #fff   ; border-radius: 15px; width:48%; margin-right:4%; padding-left:30px;padding-right:30px;">
				<div class="card-body " style="color:#222; ">
					<h4><b>Users</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-users" style="color: #1e2530;"></i></span>
					<h3 class="text-right"><b><?php echo $conn->query('SELECT * FROM users')->num_rows ?></b></h3>
				</div>
			</div>
			<div class=" float-left" style="background-color: #fff  ; border-radius: 15px;  width:48%; padding-left:30px;padding-right:30px;">
				<div class="card-body " style="color:#222;">
					<h4><b>Files</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-file" style="color: #1e2530;"></i></span>
					<h3 class="text-right"><b><?php echo $conn->query('SELECT * FROM files')->num_rows ?></b></h3>
				</div>
			</div>
		</div>
	</div>




	<?php include('db_connect.php');

	$usr = $_SESSION['login_type'];
	if ($usr == 1) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_admin = 1) AND ftype = 1 order by date(f.date_updated) desc");
	} elseif ($usr == 2) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_dean = 1) AND ftype = 1 order by date(f.date_updated) desc");
	} else {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_hod = 1) AND ftype = 1 order by date(f.date_updated) desc");
	}

	?>

	<div class="row mt-3 ml-3 mr-3">
		<div class="card col-md-12" style="background-color:#fff ; padding:20px; border-radius:15px; ">
			<h5>NAAC DOCUMENTS</h5>


			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="20%" class="">Uploader</th>
						<th width="30%" class="">File Description</th>
						<th width="30%" class="">Filename</th>
						<th width="20%" class="">Upload Date</th>

					</tr>


					<?php
					while ($row = $files->fetch_assoc()) :
						$name = explode(' ||', $row['name']);
						$name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
						$img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
						$doc_arr = array('doc', 'docx');
						$pdf_arr = array('pdf', 'ps', 'eps', 'prn');
						$icon = 'fa-file';
						if (in_array(strtolower($row['file_type']), $img_arr))
							$icon = 'fa-image';
						if (in_array(strtolower($row['file_type']), $doc_arr))
							$icon = 'fa-file-word';
						if (in_array(strtolower($row['file_type']), $pdf_arr))
							$icon = 'fa-file-pdf';
						if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
							$icon = 'fa-file-excel';
						if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
							$icon = 'fa-file-archive';

					?>


						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i><?php echo ucwords($row['uname']) ?></i></td>


							<td><?php echo $row['description'] ?></td>

							

							<td>
								<large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
								<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>

							<td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
						</tr>


					<?php endwhile; ?>
				</table>

			</div>
		</div>
	</div>

	<?php include('db_connect.php');

	$usr = $_SESSION['login_type'];
	if ($usr == 1) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_admin = 1) AND ftype = 2 order by date(f.date_updated) desc");
	} elseif ($usr == 2) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_dean = 1) AND ftype = 2 order by date(f.date_updated) desc");
	} else {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_hod = 1) AND ftype = 2 order by date(f.date_updated) desc");
	}

	?>

	<div class="row mt-3 ml-3 mr-3">
		<div class="card col-md-12" style="background-color:#fff ; padding:20px; width:100%; border-radius:15px;">
			<h5>NBA DOCUMENTS</h5>


			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="20%" class="">Uploader</th>
						<th width="30%" class="">File Description</th>
						<th width="30%" class="">Filename</th>
						<th width="20%" class="">Upload Date</th>
						
					</tr>


					<?php
					while ($row = $files->fetch_assoc()) :
						$name = explode(' ||', $row['name']);
						$name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
						$img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
						$doc_arr = array('doc', 'docx');
						$pdf_arr = array('pdf', 'ps', 'eps', 'prn');
						$icon = 'fa-file';
						if (in_array(strtolower($row['file_type']), $img_arr))
							$icon = 'fa-image';
						if (in_array(strtolower($row['file_type']), $doc_arr))
							$icon = 'fa-file-word';
						if (in_array(strtolower($row['file_type']), $pdf_arr))
							$icon = 'fa-file-pdf';
						if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
							$icon = 'fa-file-excel';
						if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
							$icon = 'fa-file-archive';

					?>


						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i><?php echo ucwords($row['uname']) ?></i></td>


							<td><?php echo $row['description'] ?></td>

							

							<td>
								<large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
								<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>

							<td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
						</tr>


					<?php endwhile; ?>
				</table>

			</div>
		</div>
	</div>

	<?php include('db_connect.php');

	$usr = $_SESSION['login_type'];
	if ($usr == 1) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_admin = 1) AND ftype = 3 order by date(f.date_updated) desc");
	} elseif ($usr == 2) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_dean = 1) AND ftype = 3 order by date(f.date_updated) desc");
	} else {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_hod = 1) AND ftype = 3 order by date(f.date_updated) desc");
	}

	?>

	<div class="row mt-3 ml-3 mr-3">
		<div class="card col-md-12" style="background-color:#fff ; padding:20px; border-radius:15px; ">
			<h5>FEEDBACK DOCUMENTS</h5>


			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="20%" class="">Uploader</th>
						<th width="30%" class="">File Description</th>
						<th width="30%" class="">Filename</th>
						<th width="20%" class="">Upload Date</th>
						
					</tr>

					<?php

					while ($row = $files->fetch_assoc()) :
						$name = explode(' ||', $row['name']);
						$name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
						$img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
						$doc_arr = array('doc', 'docx');
						$pdf_arr = array('pdf', 'ps', 'eps', 'prn');
						$icon = 'fa-file';
						if (in_array(strtolower($row['file_type']), $img_arr))
							$icon = 'fa-image';
						if (in_array(strtolower($row['file_type']), $doc_arr))
							$icon = 'fa-file-word';
						if (in_array(strtolower($row['file_type']), $pdf_arr))
							$icon = 'fa-file-pdf';
						if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
							$icon = 'fa-file-excel';
						if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
							$icon = 'fa-file-archive';

					?>


						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i><?php echo ucwords($row['uname']) ?></i></td>


							<td><?php echo $row['description'] ?></td>

							

							<td>
								<large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
								<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>

							<td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
						</tr>


					<?php endwhile; ?>
				</table>

			</div>
		</div>
	</div>

	
	<?php include('db_connect.php');

	$usr = $_SESSION['login_type'];
	if ($usr == 1) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_admin = 1) AND ftype = 4 order by date(f.date_updated) desc");
	} elseif ($usr == 2) {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_dean = 1) AND ftype = 4 order by date(f.date_updated) desc");
	} else {
		$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_hod = 1) AND ftype = 4 order by date(f.date_updated) desc");
	}

	?>

	<div class="row mt-3 ml-3 mr-3">
		<div class="card col-md-12" style="background-color:#fff ; padding:20px; width:100%;border-radius:15px;">
			<h5>OTHER DOCUMENTS</h5>


			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="20%" class="">Uploader</th>
						<th width="30%" class="">File Description</th>
						<th width="30%" class="">Filename</th>
						<th width="20%" class="">Upload Date</th>
						
					</tr>


					<?php
					while ($row = $files->fetch_assoc()) :
						$name = explode(' ||', $row['name']);
						$name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
						$img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
						$doc_arr = array('doc', 'docx');
						$pdf_arr = array('pdf', 'ps', 'eps', 'prn');
						$icon = 'fa-file';
						if (in_array(strtolower($row['file_type']), $img_arr))
							$icon = 'fa-image';
						if (in_array(strtolower($row['file_type']), $doc_arr))
							$icon = 'fa-file-word';
						if (in_array(strtolower($row['file_type']), $pdf_arr))
							$icon = 'fa-file-pdf';
						if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
							$icon = 'fa-file-excel';
						if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
							$icon = 'fa-file-archive';

					?>


						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i><?php echo ucwords($row['uname']) ?></i></td>


							<td><?php echo $row['description'] ?></td>

							

							<td>
								<large><span><i class="fa <?php echo $icon ?>"></i></span><b> <?php echo $name ?></b></large>
								<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

							</td>

							<td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
						</tr>


					<?php endwhile; ?>
				</table>

			</div>
		</div>
	</div>

</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
</div>
<script>
	//FILE
	$('.file-item').bind("contextmenu", function(event) {
		event.preventDefault();

		$('.file-item').removeClass('active')
		$(this).addClass('active')
		$("div.custom-menu").hide();
		var custom = $("<div class='custom-menu file'></div>")
		custom.append($('#menu-file-clone').html())
		custom.find('.download').attr('data-id', $(this).attr('data-id'))
		custom.appendTo("body")
		custom.css({
			top: event.pageY + "px",
			left: event.pageX + "px"
		});


		$("div.file.custom-menu .download").click(function(e) {
			e.preventDefault()
			window.open('download.php?id=' + $(this).attr('data-id'))
		})



	})
	$(document).bind("click", function(event) {
		$("div.custom-menu").hide();
		$('#file-item').removeClass('active')

	});
	$(document).keyup(function(e) {

		if (e.keyCode === 27) {
			$("div.custom-menu").hide();
			$('#file-item').removeClass('active')

		}
	})
</script>