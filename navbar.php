<style>

.button {
  display: inline-flex;
  height: 50px;
  width: 200px;
  border: 3px solid #05DC22;
  margin: 20px 20px 20px 20px;
  color: #05DC22;
  padding-bottom: 13px;
  text-decoration: none;
  font-size: .9em;
  letter-spacing: 1.5px;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  border-radius: 20px;
}
/*_____________________*/
/* Second Button */

#button-2 {
  position: relative;
  overflow: hidden;
  cursor: pointer;
  border-radius: 20px;
}

#button-2 a {
  position: relative;
  transition: all .35s ease-Out;
  border-radius: 20px;
}

#slide {
  width: 100%;
  height: 100%;
  left: -200px;
  background: #05DC22;
  position: absolute;
  transition: all .35s ease-Out;
  bottom: 0;
  border-radius: 20px;
}

#button-2:hover #slide {
  left: 0;
  border-radius: 20px;
}

#button-2:hover a {
  color: #2D3142;
  border-radius: 20px;
}




</style>

<nav id="sidebar" class='mx-lt-5 ' style='padding-top:25px;background: #5d6879; font-size:18px;'>
		
		<div class="sidebar-list">

		<div class="button" id="button-2">
    		<div id="slide"></div>
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
		</div>
		<div class="button" id="button-2">
    		<div id="slide"></div>
				<a href="index.php?page=files" class="nav-item nav-files"><span class='icon-field'><i class="fa fa-file"></i></span> Files</a>
		</div>
		
				<?php if($_SESSION['login_type'] == 1): ?>
					<div class="button" id="button-2">
    		<div id="slide"></div>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
				</div>
			<?php endif; ?>
			
		</div>


</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>