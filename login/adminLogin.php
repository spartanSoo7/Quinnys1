<?php include '../include/head.php';?>
<?php include '../include/header.php';?>
		<div id="login">
			<h2>Login</h2>
				<form method="post" action="Validatelogin.php">
					<table border="0" cellpadding="3" cellspacing="1">
						<tr>
							<td>
								<strong>Username</strong>
							</td>
							<td width="6">
								<strong>:</strong>
							</td>
							<td>
								<strong>
									<input name="username" type="text">
								</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>Password</strong>
							</td>
							<td>
								<strong>:</strong>
							</td>
							<td>
								<strong><input name="password" type="password"></strong>
							</td>
						</tr>
						<tr>
							<td colspan="3" class="auto-style1">
								<strong><input type="submit" value="Log in"></strong>
							</td>
						</tr>
					</table>
				</form>
			</tr>
		</div>
<?php include '../include/footer.php';?>