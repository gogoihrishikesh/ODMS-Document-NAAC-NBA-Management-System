<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 5px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<nav class="navbar navbar-dark  fixed-top " style="background-color:#1e2530; height: 110px;"><!-- background-image: url('assets/22.png')-->
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			<img width="130px" src="assets/new1.png">
  		</div>
	  	<div class="col-md-2 mt-2 float-right" style="padding-top:11px; margin-right:-130px;">
	  		<a class="text-light" href="ajax.php?action=logout" ><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>