<?php include '../include/head.php';?>
<?php include '../include/header.php';?>
    <div id = "centerTitle">
        <h2>Login</h2>
        </div>
	<div id="login">

		<style>
            table{
                width: 50%;
            }
            th{
                width: 50%;
                text-align: left;
                padding: 0px;
                margin: 0px;
            }
            td{
                width: 50%;
                text-align: right;
                padding: 0px;
                margin: 0px;
            }

        </style>
				<form method="post" action="Validatelogin.php">
					<table border="0" cellpadding="3" cellspacing="1">
						<tr>
							<th>
								<strong>Username:</strong>
							</th>
							<td>
								<strong>
									<input name="username" type="text" size="20">
								</strong>
							</td>
						</tr>
						<tr>
							<th>
								<strong>Password:</strong>
							</th>
							<td>
								<strong><input name="password" type="password" size="20"></strong>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center;">
								<strong><input type="submit" value="Log in"></strong>
							</td>
						</tr>
					</table>
				</form>
			</tr>
		</div>
<?php include '../include/footer.php';?>