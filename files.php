<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@500&display=swap" rel="stylesheet">
</head>
<?php
include 'db_connect.php';
$folder_parent = isset($_GET['fid']) ? $_GET['fid'] : 0;
$folders = $conn->query("SELECT * FROM folders where parent_id = $folder_parent and user_id = '" . $_SESSION['login_id'] . "' and (name LIKE 'Feedback%' OR name LIKE 'NAAC%' OR name LIKE 'NBA%') order by name asc;");


$files = $conn->query("SELECT * FROM files where folder_id = $folder_parent and user_id = '" . $_SESSION['login_id'] . "'  order by name asc");

?>
<style>
	.folder-item {
		cursor: pointer;
	}

	.folder-item:hover {
		background: #eaeaea;
		color: black;
		box-shadow: 3px 3px #0000000f;
	}

	.folder-items {
		cursor: pointer;
	}

	.folder-items:hover {
		background: #eaeaea;
		color: black;
		box-shadow: 3px 3px #0000000f;
	}

	.custom-menu {
		z-index: 1000;
		position: absolute;
		background-color: #ffffff;
		border: 1px solid #0000001c;
		border-radius: 5px;
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
		margin-right: 5px
	}

	/*===========================================================*/
	.btnn {
		border: none;
		display: block;
		text-align: center;
		cursor: pointer;
		text-transform: uppercase;
		outline: none;
		overflow: hidden;
		position: relative;
		color: #fff;
		font-weight: 700;
		font-size: 15px;
		background-color: #2F3132;
		padding: 17px 60px;
		margin: 0 auto;
		box-shadow: 0 5px 15px rgba(0, 0, 0, 0.20);
		border-radius: 15px;

	}

	.btnn span {
		position: relative;
		z-index: 1;
	}

	.btnn:after {
		content: "";
		position: absolute;
		left: 0;
		top: 0;
		height: 490%;
		width: 140%;

		background: #05DC22;
		-webkit-transition: all .5s ease-in-out;
		transition: all .5s ease-in-out;
		-webkit-transform: translateX(-98%) translateY(-25%) rotate(45deg);
		transform: translateX(-98%) translateY(-25%) rotate(45deg);
	}

	.btnn:hover:after {
		-webkit-transform: translateX(-9%) translateY(-25%) rotate(45deg);
		transform: translateX(-9%) translateY(-25%) rotate(45deg);

	}

	/*=======================*/
	/*.bb {}*/

	.bb:hover {
		padding: 3px;
		transition: .5s;
	}
</style>
<nav aria-label="breadcrumb " style="margin:18px; ">
	<ol class="breadcrumb" style="background-color: #fff ;border-radius:15px; padding-left:30px;padding-right:30px;">

		<?php
		$id = $folder_parent;
		while ($id > 0) {

			$path = $conn->query("SELECT * FROM folders where id = $id  order by name asc")->fetch_array();
		?>
			<li class="breadcrumb-item text-success"><?php echo $path['name']; ?></li>
		<?php
			$id = $path['parent_id'];
		}
		?>
		<li class="breadcrumb-item"><a class="" href="index.php?page=files" style="color: #222; font-size:25px;"><b>FILES</b></a></li>
	</ol>
</nav>
<div class="container-fluid">
	<div class="col-lg-12">

		<div class="row">
			<button class="btnn" id="new_folder"><i class="fa fa-plus"></i><span> New Folder</span></button>
			<button class="btnn" id="new_file"><i class="fa fa-upload"></i><span> Upload File</span></button>
		</div>
		<hr>
		<!--<div class="row">
			<div class="col-lg-12">
				<div class="col-md-4 input-group offset-4">

					<input type="text" class="form-control" id="search" aria-label="Small" style="background-color: #F9F3D6 ; border-radius:25px;" aria-describedby="inputGroup-sizing-sm" placeholder='Search here'>
					<div class="input-group-append">
						<span class="input-group-text" id="inputGroup-sizing-sm" style="margin-left:5px; border-radius:50px; background-color:#222;"><i class="fa fa-search" style="color:#5AC3F7;"></i></span>
					</div>
				</div>
			</div>
		</div>-->
		<div class="row">
			<div class="col-md-12" style="color:black;">
				<h4><b>DMS Folders</b></h4>
			</div>
		</div>
		<hr>
		<div class="row">
			<?php
			while ($row = $folders->fetch_assoc()) :
			?>
				<div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-items bb" style="border:3px solid #E7C800;background-color:#2F3132; border-radius:20px; color: #E7C800; font-size:20px; " data-id="<?php echo $row['id'] ?>">
					<div class="card-body">
						<div id="<?php echo $row['name'] ?>">
							<large><span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b></large>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<hr>

		<?php
		include 'db_connect.php';
		$folder_parent = isset($_GET['fid']) ? $_GET['fid'] : 0;
		$folderss = $conn->query("SELECT * FROM folders where parent_id = $folder_parent and user_id = '" . $_SESSION['login_id'] . "' and (name NOT LIKE 'Feedback%' AND name NOT LIKE 'NAAC%' AND name NOT LIKE 'NBA%') order by name asc;");


		$files = $conn->query("SELECT * FROM files where folder_id = $folder_parent and user_id = '" . $_SESSION['login_id'] . "'  order by name asc");

		?>

		<div class="row">
			<div class="col-md-12" style="color:black;">
				<h4><b>Your Folders</b></h4>
			</div>
		</div>
		<hr>
		<div class="row">
			<?php
			while ($row = $folderss->fetch_assoc()) :
			?>
				<div class="card col-md-3 mt-2 ml-2 mr-2 mb-2 folder-item bb" style="border:3px solid #E7C800;background-color:#2F3132; border-radius:20px; color: #E7C800; font-size:20px; " data-id="<?php echo $row['id'] ?>">
					<div class="card-body">
						<div id="<?php echo $row['name'] ?>">
							<large><span><i class="fa fa-folder"></i></span><b class="to_folder"> <?php echo $row['name'] ?></b></large>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<hr>


		<div class="row">
			<div class="card col-md-12" style="background-color: #fff ;">
				<div class="card-body">
					<table width="100%">
						<tr>
							<th width="40%" class="">Filename</th>
							<th width="20%" class="">Date</th>
							<th width="40%" class="">Description</th>
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
								<td>
									<large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
									<input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">

								</td>
								<td><i class="to_file"><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
								<td><i class="to_file"><?php echo $row['description'] ?></i></td>
							</tr>

						<?php endwhile; ?>
					</table>

				</div>
			</div>

		</div>
	</div>
</div>
<div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Delete</a>
</div>

<script>
	$('#new_folder').click(function() {
		uni_modal('', 'manage_folder.php?fid=<?php echo $folder_parent ?>')
	})
	$('#new_file').click(function() {
		uni_modal('', 'manage_files.php?fid=<?php echo $folder_parent ?>')
	})
	$('.folder-item').dblclick(function() {
		location.href = 'index.php?page=files&fid=' + $(this).attr('data-id')
	})

	$('.folder-items').dblclick(function() {
		location.href = 'index.php?page=files&fid=' + $(this).attr('data-id')
	})

	$('.folder-items').bind("contextmenu", function(event) {
		event.preventDefault();
		$("div.custom-menu").hide();

		$("div.custom-menu").hide();


		$("div.custom-menu .edit").click(function(e) {
			e.preventDefault()
			uni_modal('Rename Folder', 'manage_folder.php?fid=<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'))
		})
		$("div.custom-menu .delete").click(function(e) {
			e.preventDefault()
			_conf("Are you sure to delete this Folder?", 'delete_folder', [$(this).attr('data-id')])
		})
	})

	$('.folder-item').bind("contextmenu", function(event) {
		event.preventDefault();
		$("div.custom-menu").hide();
		var custom = $("<div class='custom-menu'></div>")

		custom.append($('#menu-folder-clone').html())
		custom.find('.edit').attr('data-id', $(this).attr('data-id'))
		custom.find('.delete').attr('data-id', $(this).attr('data-id'))
		custom.appendTo("body")
		custom.css({
			top: event.pageY + "px",
			left: event.pageX + "px"
		});

		$("div.custom-menu .edit").click(function(e) {
			e.preventDefault()
			uni_modal('Rename Folder', 'manage_folder.php?fid=<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'))
		})
		$("div.custom-menu .delete").click(function(e) {
			e.preventDefault()
			_conf("Are you sure to delete this Folder?", 'delete_folder', [$(this).attr('data-id')])
		})
	})

	//FILE
	$('.file-item').bind("contextmenu", function(event) {
		event.preventDefault();

		$('.file-item').removeClass('active')
		$(this).addClass('active')
		$("div.custom-menu").hide();
		var custom = $("<div class='custom-menu file'></div>")
		custom.append($('#menu-file-clone').html())
		custom.find('.edit').attr('data-id', $(this).attr('data-id'))
		custom.find('.delete').attr('data-id', $(this).attr('data-id'))
		custom.find('.download').attr('data-id', $(this).attr('data-id'))
		custom.appendTo("body")
		custom.css({
			top: event.pageY + "px",
			left: event.pageX + "px"
		});

		$("div.file.custom-menu .edit").click(function(e) {
			e.preventDefault()
			$('.rename_file[data-id="' + $(this).attr('data-id') + '"]').siblings('large').hide();
			$('.rename_file[data-id="' + $(this).attr('data-id') + '"]').show();
		})
		$("div.file.custom-menu .delete").click(function(e) {
			e.preventDefault()
			_conf("Are you sure to delete this file?", 'delete_file', [$(this).attr('data-id')])
		})
		$("div.file.custom-menu .download").click(function(e) {
			e.preventDefault()
			window.open('download.php?id=' + $(this).attr('data-id'))
		})

		$('.rename_file').keypress(function(e) {
			var _this = $(this)
			if (e.which == 13) {
				start_load()
				$.ajax({
					url: 'ajax.php?action=file_rename',
					method: 'POST',
					data: {
						id: $(this).attr('data-id'),
						name: $(this).val(),
						type: $(this).attr('data-type'),
						folder_id: '<?php echo $folder_parent ?>'
					},
					success: function(resp) {
						if (typeof resp != undefined) {
							resp = JSON.parse(resp);
							if (resp.status == 1) {
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
							}
						}
					}
				})
			}
		})

	})
	//FILE


	$('.file-item').click(function() {
		if ($(this).find('input.rename_file').is(':visible') == true)
			return false;
		uni_modal($(this).attr('data-name'), 'manage_files.php?<?php echo $folder_parent ?>&id=' + $(this).attr('data-id'))
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

	});
	$(document).ready(function() {
		$('#search').keyup(function() {
			var _f = $(this).val().toLowerCase()
			$('.to_folder').each(function() {
				var val = $(this).text().toLowerCase()
				if (val.includes(_f))
					$(this).closest('.card').toggle(true);
				else
					$(this).closest('.card').toggle(false);


			})
			$('.to_file').each(function() {
				var val = $(this).text().toLowerCase()
				if (val.includes(_f))
					$(this).closest('tr').toggle(true);
				else
					$(this).closest('tr').toggle(false);


			})
		})
	})

	function delete_folder($id) {
		start_load();
		$.ajax({
			url: 'ajax.php?action=delete_folder',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Folder successfully deleted.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	}

	function delete_file($id) {
		start_load();
		$.ajax({
			url: 'ajax.php?action=delete_file',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Folder successfully deleted.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)
				}
			}
		})
	}
</script>

</html>