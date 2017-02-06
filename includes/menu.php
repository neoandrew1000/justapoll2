<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="creators.php">Creators</a></li>
        <li><a href="customers.php">Customers</a></li>
        <?php $user = new User();
			if (!$user->isLoggedIn()) {
				echo "<li><a href='register.php'>Register</a></li>";
				echo "<li><a href='login.php'>Login</a></li>";
  		}
  		?>
    </ul>
</nav>