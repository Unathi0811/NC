<?php include_once "./head.php"; 
Head("nannies");
?>
<?php include_once "./sideBar.php"; ?>

<div class="box-container">

	<div class="box box1">
		<div class="text">
			<h2 class="topic-heading">
				<?php
				try {
					$sql = "SELECT * FROM `users_profile`;";
					$results = mysqli_query($db, $sql);
					echo mysqli_num_rows($results);
				} catch (\Throwable $th) {
					echo 0;
				}
				?>
			</h2>
			<h2 class="topic">Nanny Active</h2>
		</div>
		<box-icon type='solid' name='show'></box-icon>
	</div>

	<div class="box box2">
		<div class="text">
			<h2 class="topic-heading">
				<?php
				try {
					$sql = "SELECT * FROM `bookings` WHERE active = 1;";
					$results = mysqli_query($db, $sql);
					echo mysqli_num_rows($results);
				} catch (\Throwable $th) {
					echo 0;
				}
				?>
			</h2>
			<h2 class="topic">Active Bookings</h2>
		</div>
		<box-icon name='like'></box-icon>
	</div>

	<div class="box box3">
		<div class="text">
			<h2 class="topic-heading">
			<?php
				try {
					$sql = "SELECT * FROM `bookings`;";
					$results = mysqli_query($db, $sql);
					echo mysqli_num_rows($results);
				} catch (\Throwable $th) {
					echo 0;
				}
				?>
			</h2>
			<h2 class="topic">Total Bookings</h2>
		</div>
		<box-icon name='chat'></box-icon>
	</div>

	<div class="box box4">
		<div class="text">
			<h2 class="topic-heading">
				<?php
				try {
					$sql = "SELECT * FROM `users_profile` WHERE `verified` = 1;";
					$results = mysqli_query($db, $sql);
					echo mysqli_num_rows($results);
				} catch (\Throwable $th) {
					echo 0;
				}
				?>
			</h2>
			<h2 class="topic">Verified Nannies</h2>
		</div>
		<box-icon name='check-circle'></box-icon>
	</div>
</div>

<div class="report-container">
	<div class="report-header">
		<h1 class="recent-Articles">Recent Nannies</h1>
		<button class="view">View All</button>
	</div>

	<?php
	try {
	?>
		<table class="w-full text-sm text-left rtl:text-right mt-5">
			<thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th scope="col" class="px-6 py-3">
						Name</th>
					<th scope="col" class="px-6 py-3">
						Email</th>
					<th scope="col" class="px-6 py-3">
						Phone</th>
					<th scope="col" class="px-6 py-3">
						Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = "SELECT * FROM `users_profile` LIMIT 5;";
				$results = mysqli_query($db, $sql);
				if (mysqli_num_rows($results) > 0) {
					while ($row = mysqli_fetch_assoc($results)) {
				?>
						<tr class="even:bg-gray-50 even:dark:bg-gray-800">
							<td class="px-6 py-4">
								<?php echo $row['name'] . " " .  $row['surname']; ?></td>
							<td class="px-6 py-4">
								<?php echo $row['email']; ?></td>
							<td class="px-6 py-4">
								<?php echo $row['phone']; ?></td>
							<?php
							if ($row["verified"]) {
							?>
								<td class='t-op-nextlvl'>
									<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-<?php echo $row['id'] ?>" class="text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="background-color: var(--primary-color);" type="button">
										Verified
									</button>
								</td> <?php
									} else {
										?>

								<td class="t-op-nextlvl">
									<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-<?php echo $row['id'] ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Action <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
											<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
										</svg>
									</button>

									<!-- Dropdown menu -->
									<div id="dropdown-<?php echo $row['id'] ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
										<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
											<li>
												<a href="../server/verify_nanny.php?id=<?php echo $row['id'] ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Verify</a>
											</li>
										</ul>
									</div>
								</td>


							<?php
									}
							?>
						</tr>
				<?php
					}
				}
				?>
			</tbody>
		</table>
	<?php
	} catch (\Throwable $th) {
	?>
		<p>Failed fetching data</p>
	<?php
	}
	?>
</div>

<?php
include_once "./footer.php";
