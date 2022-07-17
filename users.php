<style>
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
  background-color: #222;
  padding: 17px 60px;
  margin: 0 auto;
  box-shadow: 0 5px 15px rgba(0,0,0,0.20);
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
</style>
<nav aria-label="breadcrumb ">
  <ol class="breadcrumb" style="background-color: #fff ;margin-top: 20px; border-radius:15px;padding-left:30px;padding-right:30px;">
  <li class="breadcrumb-item "style="color: #222; font-size:25px; "><b>USER</b></li>
  </ol>
</nav>
<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btnn  float-right " id="new_user" style="background-color: #222; color:white;"><i class="fa fa-plus"></i><span> New user</span></button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12" style="background-color: #fff ;border-radius:15px;">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<center><?php echo $i++ ?></center>
				 	</td>
				 	<td>
				 		<center><?php echo $row['name'] ?></center>
				 	</td>
				 	<td>
				 		<center><?php echo $row['username'] ?></center>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn " style="margin-right:5px; background-color:#05DC22 ; color:white; border-radius: 10px;">Action</button>
								  <button type="button" style="border-radius: 15px;background-color: #252525; color:white;" class="btn  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})

</script>