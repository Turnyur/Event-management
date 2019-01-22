<?php
if(isset($_SESSION['user'])){

$string=<<<EOD
				<div id="manage" class="dropdown">
					<button class="dropbtn">Manage 
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="admin.php">Create Event</a>
						<a href="index.php?event-target=edit">Edit Event</a>
						<a href="index.php?event-target=delete">Delete Event</a>
					</div>
				</div> 
				<!-- Dropdown Menu Button Ends here -->
EOD;
		echo $string;	
}

?>