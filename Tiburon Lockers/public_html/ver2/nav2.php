<div id="nav">
	<nav class="navbar navbar-default navbar-static-top">
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<?php 
						$url = htmlspecialchars($_SERVER['HTTP_REFERER']);
						echo "<a href='$url'>Back</a>";
					?>
				</li>

				<li>
					<a>Sections:
					<select class="form-inline" name="Database" onchange="window.location=this.value">
					<option value = '#'> Sections List </option>
					<option value = 'atstud.php'> Anti-Theft Stud </option>
					<option value = 'magnet.php'> Magnet </option>
					<option value = 'reed.php'> Reed Swtich </option>
					<option value = 'linkage.php'> Linkage </option>
					<option value = 'servo.php'> Servo Mounting </option>
					<option value = 'rework.php'> Metal Rework</option>
					<option value = 'compmnt.php'> Compartments </option>
					<option value = 'circuit.php'> PCB </option>
					<option value = '#j8'> J8 </option>
					<option value = '12vps.php'> 12V Power Supply  </option>
					<option value = '5vps.php'> 5V Power Supply </option>
					<option value = 'mainac.php'> Main AC Wiring </option>
					<option value = 'chassis.php'> Chassis Assembly </option>
					<option value = 'quad.php'> Quad Assembly </option>
					</select>
					</a>
				</li>			
			</ul>
		</div>
	</nav>
</div>		


