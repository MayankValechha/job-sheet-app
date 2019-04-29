<?php 
		
		//Requiring Session Variables
    session_start();

    //Database Connect
    require 'config/database.php';

    if(isset($_SESSION['username'])) {

		$username = $_SESSION['username'];
        
        $query = "SELECT * FROM `shopkeepers` WHERE contact = '$username'";

        $results = mysqli_query($db_connect, $query); 

        $shop = mysqli_fetch_assoc($results);

        //Setting Shop ID and Name in SESSIONS for Dashboard and Other pages
        $_SESSION['shop_id'] = $shop['shop_id'];
        $_SESSION['shop_name'] = $shop['name'];
		
		$username = $_SESSION['username'];
		$shop_name = $_SESSION['shop_name'];
		$shop_id = $_SESSION['shop_id'];

		/* 
			First Query for getting total number of phones 
		*/
		$query = "SELECT * FROM `jobsheet` where shop_id = '$shop_id'";
    
    	$result = mysqli_query($db_connect, $query);
			
    	$total_phones = mysqli_num_rows($result);

		$totalNumberOfPhonesRecieved = $total_phones;

		/* 
			Second Query for getting Total Number of Phones Repaired 
		*/
		$query = "SELECT * FROM `jobsheet` where isRepaired=1 AND isDelivered=1 AND shop_id = '$shop_id'";
    
    	$result = mysqli_query($db_connect, $query);

    	$total_phones_repaired = mysqli_num_rows($result);

		$totalNumberOfPhonesRepaired = $total_phones_repaired;

		/* 
			Third Query for getting Total Number of Phones Returned without Repair 
		*/
		$query = "SELECT * FROM `jobsheet` where isRepaired=0 AND isDelivered=1 AND shop_id = '$shop_id'";
    
    	$result = mysqli_query($db_connect, $query);

    	$total_phones_returned = mysqli_num_rows($result);

		$totalNumberOfPhonesReturned = $total_phones_returned;

		/* 
			Fourth Query for getting Total Revenue Generated 
		*/
		$query = "SELECT SUM(estimated_amount) AS revenue FROM `jobsheet` where isRepaired=1 AND isDelivered=1 AND shop_id = '$shop_id'";
    
    	$result = mysqli_query($db_connect, $query);

    	$revenue = mysqli_fetch_assoc($result);

		$totalRevenueGenerated = $revenue['revenue'];

		/* 
			Fifth Query for getting Pending Mobiles
		*/
		$query = "SELECT recieving_date, customer_name, customer_contact, model, problem_description FROM `jobsheet` where isRepaired=0 AND isDelivered=0 AND shop_id = '$shop_id' ORDER BY recieving_date DESC";
    
    	$result = mysqli_query($db_connect, $query);

		//Storing Total Number of Pending Jobs in $totalPendingJobRows
		$totalPendingJobRows = mysqli_num_rows($result);
		
		/* 
			With $totalPendingJobRows variable if greater than 0 then,
			Looping $pending_jobs Down in the table and outputting data.
		*/
		$pending_jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		
		/* 
			Checking for Errors in Query 
		*/
		if(!mysqli_query($db_connect, $query)) {
			echo "Got Error" .mysqli_error($db_connect);
		}
		
    }

?>

<!DOCTYPE html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
  <!-- Bootswatch Yeti theme -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">    

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <title>Dashboard | Job Sheet Application</title>
</head>

<style>
	/* Styling for Dynamic Data */
	.data {
		font-size:20px;
		font-weight:bold;
	}

	/* Overwriting Original Styles */
	.card-body-icon {
		top:0px;
		right:0px;
		opacity:0.8;
		font-size:70px;
	}

	.navbar-nav .nav-item.active .nav-link {
		text-align:center;
	}
</style>

<body>

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
        <a class="navbar-brand mr-1 font-weight-bold" href="dashboard.php">Job Sheet Application</a>
    </nav>
	

    <!-- SIDEBAR -->
    <div id="wrapper">
    <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
      <li class="nav-item active">
				<a class="nav-link" href="dashboard.php">
					<span>Dashboard</span>
				</a>
      </li>
			<br>
			<br>
			<br>
			<li class="nav-item active">
              	<a class="nav-link" href="createJobsheet.php">
                	<span>Create Jobsheet</span>
              	</a>
          	</li>
				<li class="nav-item active">
              	<a class="nav-link" href="viewJobsheets.php">
                  <span>View Jobsheet</span>
              	</a>
          	</li>
			<li class="nav-item active">
              	<a class="nav-link" href="createJobsheet.php">
                  	<span>Create Jobsheet</span>
              	</a>
          	</li>
			<li class="nav-item active">
              	<a class="nav-link" href="logout.php">
                  	<i class="fa fa-sign-out"></i>
                  	<span>Logout</span>
              	</a>
          	</li>
      	</ul>

		
    <div id="content-wrapper">
      	<div class="container-fluid">
			<?php if(isset($_SESSION['username'])): ?>
					<h3>Welcome, <?php echo $_SESSION['shop_name']; ?>!</h3>
					<br>
				<!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-info o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-mobile-alt"></i>
                </div>
                <div class="mr-5"><b>TOTAL NUMBER OF PHONES RECIEVED TILL DATE : </b><br><span class="data"><?php echo $totalNumberOfPhonesRecieved; ?></span></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-toolbox"></i>
                </div>
					<div class="mr-5"><b>TOTAL NUMBER OF PHONES REPAIRED  : </b><br><span class="data"><?php echo $totalNumberOfPhonesRepaired; ?></span></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-undo-alt"></i>
                </div>
                <div class="mr-5"><b>TOTAL NUMBER OF PHONES RETURNED WITHOUT REPAIRING : </b><br><span class="data"><?php echo $totalNumberOfPhonesReturned; ?></span></div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-warning o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-rupee-sign"></i>
                </div>
                <div class="mr-5"><b>TOTAL REVENUE GENERATED : </b><br><span class="data"><?php echo $totalRevenueGenerated; ?> &#8377; </span></div>
              </div>
            </div>
          </div>
		</div>
		<br>
		<hr>
		<br>
		<!-- Pending Work and Last Work -->
		<h4>Pending Mobiles</h4>
		<br>
		<?php if($totalPendingJobRows >  0): ?>
			<table class="table table-responsive table-hover table-bordered">
				<thead>
					<tr>
						<th>Receiving Date and Time</th>
						<th>Customer Name</th>
						<th>Customer Contact</th>
						<th>Model</th>
						<th>Problem</th>
						<th>Status</th>
					</tr>
				</thead>
				<?php foreach($pending_jobs as $pending_job): ?>
					<tbody>
						<tr>
							<td><?php echo date('d/M/Y h:i A', strtotime($pending_job['recieving_date']));?></td>
							<td><?php echo $pending_job['customer_name']; ?></td>
							<td><?php echo $pending_job['customer_contact']; ?></td>
							<td><?php echo $pending_job['model']; ?></td>
							<td><?php echo $pending_job['problem_description']; ?></td>
							<td class="bg-warning font-weight-bold">Repairing</td>
						</tr>
					</tbody>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p class="lead bg-success text-white font-weight-bold">No Pending Phones!!! &#128516;</p>
		<?php endif; ?>


		<?php endif; ?>
      <!-- /.container-fluid -->

      
      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span><b>Job Sheet Application &copy; <?php echo date('Y'); ?></b></span>
          </div>
        </div>
      </footer>
    </div>
    <!-- /.content-wrapper -->

    
  </div>
  <!-- /#wrapper -->

	<!-- All Scripts Files -->
	<?php include 'includes/scripts.php'; ?>
	
</body>
</html>
