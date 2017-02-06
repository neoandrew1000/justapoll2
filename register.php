<?php 
	ob_start();
	require_once ('core/init.php');
	include 'includes/overall/header.php'; 

	$user = new User();
	if ($user->isLoggedIn()) {

		Redirect::to("index.php");

  	}

 	if (Input::exists()){
 	
 	      if (Token::check(Input::get('token'))){
 	
		 	$validate=new Validate();
		 	$validation = $validate->check($_POST, array(
					"usrnam" => array(
						"required" => true,
						"min" => 2,
						"max" => 20,
						"unique" => "usrs"
					),
					"password" => array(
						"required" => true,
						"min" => 6
					),
					"password_again" => array(
						"required" => true,
						"matches" => "password"
					),
					"frname" => array(
						"required" => true,
						"min" => 2,
						"max" => 50
					),
					"lsname" => array(
						"required" => true,
						"min" => 2,
						"max" => 50,
					),
					"eml" => array(
						"required" => true,
						"min" => 2,
						"max" => 100,
					    "unique" => "usrs"
					)
					
					// "phne" => array(
					// 	"required" => true,
					// 	"phone"=> true,
					// 	"min" => 8,
					// 	"max" => 12,
					//     "unique" => "usrs"
					// )
				));

	if ($validation->passed()) {
			$user = new user();

			try {

				// var_dump(array(
				// 	"usrnam" => Input::get("usrnam"),
				// 	"psswd" => password_hash(Input::get("password"), PASSWORD_BCRYPT),
				// 	"frst_nm" => Input::get("frname"),
				// 	"lst_nm" => Input::get("lsname"),
				// 	"eml" => Input::get("eml"),
				// 	"phne" => Input::get("phne"),
				// 	"joined" => date("Y-m-d H:i:s"),
				// 	"group_t" => 1
				// ));
				
				$user->create(array(
					"usrnam" => Input::get("usrnam"),
					"psswd" => password_hash(Input::get("password"), PASSWORD_BCRYPT),
					"frst_nm" => Input::get("frname"),
					"lst_nm" => Input::get("lsname"),
					"eml" => Input::get("eml"),
					"phne" => password_hash(Input::get("phne"), PASSWORD_BCRYPT),
					"joined" => date("Y-m-d H:i:s"),
					"group_t" => 1
				));

				Session::flash("home", "You have been registered and can now log in!");
				Redirect::to("index.php");
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error."<br>";
			}
		}
	}	
}
?>

<form action="" method ="POST">
	<div class="field">
		<label for = "usrnam">Username</label>
		<input type="text" name="usrnam" id="usrnam" value="<?php echo escape(Input::get("usrnam"))?>" autocomplete="off">
	</div>

	<div class="field">
		<label for ="password">Password</label>
		<input type ="password" name="password" id="password">
	<div>	
	
	<div class="field">
		<label for ="password_again">Password Again</label>
		<input type ="password" name="password_again" id="password_again">
	<div>	

	<div class="field">
		<label for ="frname">First name</label>
		<input type ="text" name="frname" id="frname" value="<?php echo escape(Input::get("frname"))?>">
	<div>	

	<div class="field">
		<label for ="lsname">Last name</label>
		<input type ="text" name="lsname" id="lsname" value="<?php echo escape(Input::get("lsname"))?>">
	<div>	

	<div class="field">
		<label for ="eml">Email</label>
		<input type ="text" name="eml" id="eml" value="<?php echo escape(Input::get("eml"))?>">
	</div>	

 	<div class="field">
		<label for ="phne">Phone</label>
		<input type ="text" name="phne" id="phne" value="<?php echo escape(Input::get("phne"))?>">
	</div>

		<input type = "hidden" name = "token" value="<?php echo Token::generate();?>">
		<input type = "submit" value="Register">
</form> 
<?php include 'includes/overall/footer.php'; 
