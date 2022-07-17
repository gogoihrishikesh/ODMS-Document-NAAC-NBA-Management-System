<?php
include('db_connect.php');
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM files where id=" . $_GET['id']);
	if ($qry->num_rows > 0) {
		foreach ($qry->fetch_array() as $k => $v) {
			$meta[$k] = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-files">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
		<input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] : '' ?>">
		<!-- <div class="form-group">
			<label for="name" class="control-label">File Name</label>
			<input type="text" name="name" id="name" value="<?php echo isset($meta['name']) ? $meta['name'] : '' ?>" class="form-control">
		</div> -->
		<?php if (!isset($_GET['id']) || empty($_GET['id'])) : ?>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Upload</span>
				</div>
				<div class="custom-file">
					<input type="file" class="custom-file-input" name="upload" id="upload" onchange="displayname(this,$(this))">
					<label class="custom-file-label" for="upload">Choose file</label>
				</div>
			</div>

			<div class="form-group">
				<label for="ftype">File Type</label>
				<select name="ftype" id="ftype">
					<option value="1" <?php echo isset($meta['ftype']) && $meta['ftype'] == 1 ? 'selected' : '' ?>>NAAC</option>
					<option value="2" <?php echo isset($meta['ftype']) && $meta['ftype'] == 2 ? 'selected' : '' ?>>NBA</option>
					<option value="3" <?php echo isset($meta['ftype']) && $meta['ftype'] == 3 ? 'selected' : '' ?>>FEEDBACK</option>
					<option value="4" <?php echo isset($meta['ftype']) && $meta['ftype'] == 4 ? 'selected' : '' ?>>OTHERS</option>
				</select>
			</div>


		<?php endif; ?>
		<div class="form-group">
			<label for="" class="control-label">Description</label>
			<p style="font-size: 10px;"><i>* Please provide a description to identify the document easily</i></p>
			<textarea name="description" id="" cols="30" rows="10" class="form-control" required><?php echo isset($meta['description']) ? $meta['description'] : '' ?></textarea>
		</div>



		<div class="form-group">
			<label for="is_public" class="control-label"><input type="radio" name="is_public" id="is_public"><i> Share to All Users</i></label> <br>
			<label for="is_admin" class="control-label"><input type="radio" name="is_admin" id="is_admin"><i> Share to Admin</i></label> <br>
			<label for="is_dean" class="control-label"><input type="radio" name="is_dean" id="is_dean"><i> Share to Deans</i></label><br>
			<label for="is_hod" class="control-label"><input type="radio" name="is_hod" id="is_hod"><i> Share to HoDs</i></label>
		</div>
		<div class="form-group" id="msg"></div>

	</form>

</div>
<script>
	$(document).ready(function() {
		$('#manage-files').submit(function(e) {
			e.preventDefault()
			start_load();
			$('#msg').html('')
			$.ajax({
				url: 'ajax.php?action=save_files',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				success: function(resp) {
					if (typeof resp != undefined) {
						resp = JSON.parse(resp);
						if (resp.status == 1) {
							alert_toast("New File successfully added.", 'success')
							setTimeout(function() {
								location.reload()
							}, 1500)
						} else {
							$('#msg').html('<div class="alert alert-danger">' + resp.msg + '</div>')
							end_load()
						}
					}
				}
			})
		})
	})

	function displayname(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				_this.siblings('label').html(input.files[0]['name'])

			}

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>