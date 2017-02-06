<?php 
	
	ob_start();
	 require_once 'core/init.php';
 	 include 'includes/overall/header.php'; 
	DB::getinstance();

$user = new User();
if ($user->isLoggedIn()) {

  if (!$user->hasPermission('admin')) {

		$vote = new Vote('Blondie or brunette?');
 
		$vote->setAnswers('blondie');
		$vote->setAnswers('brunette');
		$vote->setAnswers('FOXY!');
 
		if(isset($_POST['vote']))
			{
    			$vote->insertVote($_POST['vote']);
    			echo "Thank you for voting!!";
			}
		else
			{
    			$vote->displayVote();
			}
  }else{

  // Redirect::to("index.php");
  echo	"it's for customers";
  }
  
} else {

  Redirect::to("index.php"); 
}
?>	

	<!-- <p>blablablah</p>  -->

<?	include 'includes/overall/footer.php'; 
?> 
