<?php 
	ob_start();
	require_once 'core/init.php';
    include 'includes/overall/header.php'; 
	
	// $user=DB::getInstance()->get('groups', array('name','=','Customer'));
	// if (!$user->count()){
	// 	echo 'No user';
	// }else{
	// 	echo 'Ok';
	// }

	// $userInsert = DB::getInstance()->insert('usrs', array(
	// 	'usrnam'=> 'blab',
	// 	'psswd'=>'password',
	// 	'frst_nm'=>'Harry',
	// 	'lst_nm'=>'Kane',
	// 	'salt'=>'salt'
	// 	));

	// $userUpd = DB::getInstance()->update('usrs', 2, array(

	// 	'psswd'=>'newspassword',
	// 	'frst_nm'=>'Ibra'

	// 	));


	if (Session::exists("home")) {
	echo "<p>";
	echo Session::flash("home");
	echo "</p>";
}

$user = new User();
if ($user->isLoggedIn()) {
	echo "<P><a href='profile.php?user=".escape($user->data()->usrnam)."'>".escape($user->data()->usrnam)."</a> is logged in</P>";
	echo "<ul>";
	echo "<li><a href='changepassword.php'>Change password</a></li>";
	echo "<li><a href='update.php'>Update profile</a></li>";
	echo "<li><a href='logout.php'>Log out</a></li>";
	echo "</ul>";
} else {
	echo "You need to <a href='login.php'>log in</a> or <a href='register.php'>register</a>";
}

if ($user->hasPermission('admin')) {
	echo "<p>You are an admin!</p>";
}

// if (!$user->hasPermission('moderator')) {
// 	echo "<p>You are a customer!</p>";
// }

?>	
<!-- 
	<p>blablablah</p>  -->

<?	include 'includes/overall/footer.php'; 





