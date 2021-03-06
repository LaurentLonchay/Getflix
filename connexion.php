<?php
 //verifie que mail et mdp correspondent a une entree de la bdd
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM user WHERE mail = ? ");
      $requser->execute(array($mailconnect));
      $requser1 = $bdd->prepare("SELECT * FROM mdp WHERE mdp = ? ");
      $requser1->execute(array( $mdpconnect));
      

      $userexist = $requser->rowCount();
      $mdpexist = $requser1->rowCount();

      if($userexist == 1 && $mdpexist==1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header('Location: home.php');
      } else {
         //Renvoie erreur 
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<?php
	include 'intro.php';
?>

<table width="100%">
    <tr>
        <td id="tdlogo">
            <a style="font-family: 'Londrina Shadow', cursive; font-size:3em" class="logo navbar-brand" href="index.php"><i class="fa fa-gamepad" style="font-size:1em"></i> <img src="https://fontmeme.com/permalink/200903/a5e3585f8b36c0d7384a137bc9d64a60.png" alt="netflix-font" border="0"> </a>        
        </td>
    </tr>
</table>

		<div class="container h-100" style="color:black">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="assets/img/helmet.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">

					<form method="POST" action="">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" name="mailconnect" class="form-control input_user" value="" placeholder="Email">
						</div>

						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="mdpconnect" class="form-control input_pass" value="" placeholder="Password">
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button type="submit" name="formconnexion" class="btn login_btn">Login</button>
				   </div>
               </form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="inscription.php" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="recuperation.php">Forgot your password?</a>
					</div>
					<div class="text-center" >
						<br><?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<?php
	include 'outro.php';
	?>