<?php
include 'header.php';
include 'sidebar.php';
?>
<div class="page-content">
<div class="container">
	<div>
		<a role="button" class="nav-burger burger" id="left-menu" aria-label="menu" aria-expanded="false">
	      <span aria-hidden="true"></span>
	      <span aria-hidden="true"></span>
	      <span aria-hidden="true"></span>
	    </a>
	</div>
	
	<section class="hero is-bold is-dark">
		<div class="hero-body page-title">
		    <div class="container">
		      	<div class="title">
					Dashboard
		      	</div>
		    </div>
		</div>
	</section>
	<section class="section is-small" style="background-color: #ccc;">
		<div class="content">
			<nav class="level">
				<div class="level-item">
				    <div class="box box-level">
				      	<div class="heading">A</div>
				      	<div class="title has-text-centered">3,456</div>
				      	<hr class="navbar-divider">
				      	<div class="has-text-right"><a>view...</a></div>
				    </div>
				</div>
				<div class="level-item">
				    <div class="box box-level">
				      	<div class="heading">B</div>
				      	<div class="title has-text-centered">123</div>
				      	<hr class="navbar-divider">
				      	<div class="has-text-right"><a>view...</a></div>
				    </div>
				</div>
				<div class="level-item">
				    <div class="box box-level">
				      	<div class="heading">C</div>
				      	<div class="title has-text-centered">456K</div>
				      	<hr class="navbar-divider">
				      	<div class="has-text-right"><a>view...</a></div>
				    </div>
				</div>
				<div class="level-item">
				    <div class="box box-level">
				      	<div class="heading">D</div>
				      	<div class="title has-text-centered">789</div>
				      	<hr class="navbar-divider">
				      	<div class="has-text-right"><a>view...</a></div>
				    </div>
				</div>
			</nav>
		</div>
	</section>
	<section class="section is-small">
		<div class="content">
			<table class="table is-bordered is-fullwidth">
				<thead>
					<th class="has-text-centered">A</th>
					<th class="has-text-centered">B</th>
					<th class="has-text-centered">C</th>
					<th class="has-text-centered">D</th>
				</thead>
				<tbody>
					<td>3,456</td>
					<td>123</td>
					<td>456K</td>
					<td>789</td>
				</tbody>
			</table>
		</div>	
	</section>
</div>
</div>
<?php
include 'footer.php';
?>