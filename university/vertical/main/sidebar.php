<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if an admin is logged in, redirect to login if not
if (!isset($_SESSION["admin_id"])) {
    header("Location: index.php");
    exit();
}
?>

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
		<div class="d-flex align-items-center logo-box justify-content-start d-md-block d-none">	
			<!-- Logo -->
			<a href="index.php" class="logo">
			  <!-- logo-->
			  <div class="logo">
				  <span class="light-logo"><img src="../../../images/logo/logo-1.jpg" alt="logo" style="height: 9rem;"></span>
			  </div>
			  
			</a>	
		</div> 
		<div class="user-profile my-15 px-20 py-10 b-1 rounded10 mx-15">
			<div class="d-flex align-items-center justify-content-between">			
				<div class="image d-flex align-items-center">
				<img src="<?php echo isset($_SESSION['photo']) ? $_SESSION['photo'] : '../../../images/default-avatar.jpg'; ?>" class="rounded-0 me-10" alt="Admin Image">					<div>
					<h4 class="mb-0 fw-600"><?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ''; ?></h4>
					<p class="mb-0"><?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ''; ?></p>
				</div>
			</div>
				<div class="info">
					<a class="dropdown-toggle p-15 d-grid" data-bs-toggle="dropdown" href="#"></a>
					<div class="dropdown-menu dropdown-menu-end">
					  <a class="dropdown-item" href="admin_profile.php"><i class="ti-user"></i> Profile</a>
					
					  <a class="dropdown-item" href="logout.php"><i class="ti-lock"></i> Logout</a>
					</div>
				</div>
			</div>
	    </div>
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 97%;">	
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">	
				
				<li>
				  <a href="dashboard.php">
					<i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
				  </a>
				</li>
				<li>
				  <a href="latestupdate.php">
					<i class="icon-Chat2"></i>
					<span>Latest Updates</span>
				  </a>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="icon-Globe"><span class="path1"></span><span class="path2"></span></i>
					  <span>Universities</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
					  <li><a href="add_university.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add University</a></li>
					  <li><a href="university_list.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>University List</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
						<i class="icon-Ticket"><span class="path1"></span><span class="path2"></span></i>
					  <span>Courses</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
					  <li><a href="add_courses.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Courses</a></li>
					  <li><a href="course_list.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Courses List</a></li>
					</ul>
				  </li>
				<li class="treeview">
				  <a href="#">
					<i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
					<span>Students</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-right pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li><a href="students_list.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Students List</a></li>
                    </ul>
                </li>
				<li class="treeview">
					<a href="#">
						<i class="icon-Address-card"><span class="path1"></span><span class="path2"></span></i>
					  <span>Staffs</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
					  <li><a href="add_staff.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Staffs</a></li>
					  <li><a href="staff_list.php"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Staff Lists</a></li>
					</ul>
				</li>
				 	     
			  </ul>
			  
			  <div class="sidebar-widgets">
				  <div class="mx-25 mb-30 pb-20 side-bx bg-primary-light rounded20">
					<div class="text-center">
						
						<h4 class="title-bx text-primary"></h4>
						<p><strong class="d-block">Lyzoo Technologies</strong> © <script>document.write(new Date().getFullYear())</script> All Rights Reserved</p>
					</div>
				  </div>
				<div class="copyright text-center m-25">
					
				</div>
			  </div>
		  </div>
		</div>
    </section>
  </aside>