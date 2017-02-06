<?php 
  ob_start();
	require_once 'core/init.php';
 	include 'includes/overall/header.php'; 
	DB::getinstance();

  $user = new User();
        
      if ($user->isLoggedIn()) {

          if ($user->hasPermission('admin')) {

              $vote = new Vote('Blondie or brunette?');
 
              $vote->setAnswers('blondie');
              $vote->setAnswers('brunette');
              $vote->setAnswers('FOXY!');

              if(isset($_GET['results']))
             
              {
                  $vote->displayResults();
              
              }
              else
              {
          
                   $vote->displayVote2();
              }
  
          }else{

              // Redirect::to("index.php");
              echo "its for creators";

          }
  
      } else {

            Redirect::to("index.php"); 
      }
?>

<html>

<head>
  <!-- <link rel="stylesheet" type="text/css" href="css/demo.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/form-builder.min.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/form-render.min.css">
  <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>jQuery formBuilder/formRender Demo</title>
</head>

<body>
  <div class="content">
    <h1>jQuery formBuilder</h1>
    <div class="build-wrap"></div>
    <div class="render-wrap"></div>
    <button id="edit-form">Edit Form</button>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/form-builder.min.js"></script>
  <script src="js/form-render.min.js"></script>
  <script src="js/demo.js"></script>
</body> -->

</html>
<?php include 'includes/overall/footer.php'; ?>


