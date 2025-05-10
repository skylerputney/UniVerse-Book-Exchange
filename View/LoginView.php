<?php

class LoginView{
	private $model;

	public function __construct($model){
		$this->model = $model;
	} 

	public function display(){
		$html = '
		<!DOCTYPE html>
		<head>
			<title>UNIverse Book Exchange</title>
			<link rel="stylesheet" href="../Styles/styles.css">	
			<link rel="stylesheet" href="../Styles/warp-styles.css">
		</head>

		<body style="background-color:0;">
			<script>
			function togglePass() {
				var x = document.getElementById("password");
				var l1 = document.getElementById("Layer_1");
				var l2 = document.getElementById("Layer_2");
				if (x.type === "password") {
				  x.type = "text";
				  l1.setAttribute(\'hidden\', true);
				  l2.removeAttribute(\'hidden\');
				} else {
				  x.type = "password";
				  l1.removeAttribute(\'hidden\');
				  l2.setAttribute(\'hidden\', true);
				}
			  }
			</script>
			
			<div class="space stars1"></div>
			<div class="space stars2"></div>
			<div class="space stars3"></div>

			<div class ="header-bar" class= "flex-container">
				<div class = "title-header-bar">
					UNIverse Book Exchange 
				</div>
			</div>
		
			<div id = "login-box" class= "login-box">
				Log in to the UNIverse<br><br>
				<form method="POST">
					<input type="hidden" value="login" name="route">
					<input type="hidden" value="validateLogin" name="action">

					<input type="text" class="login-input" name="username" id="username" placeholder="Username" required><br><br>

					<div class="login-input flex-password password-group">
						<input type="password"  name="password" id="password" placeholder="Password" required><br>

						<svg onclick="togglePass()" hidden id="Layer_2" data-name="Layer 2" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><title>eye-glyph</title><path d="M320,256a64,64,0,1,1-64-64A64.07,64.07,0,0,1,320,256Zm189.81,9.42C460.86,364.89,363.6,426.67,256,426.67S51.14,364.89,2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.14,147.11,148.4,85.33,256,85.33s204.86,61.78,253.81,161.25A21.33,21.33,0,0,1,509.81,265.42ZM362.67,256A106.67,106.67,0,1,0,256,362.67,106.79,106.79,0,0,0,362.67,256Z"/></svg>
						<svg onclick="togglePass()"  id="Layer_1" data-name="Layer 1" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><title>eye-disabled-glyph</title><path d="M409.84,132.33l95.91-95.91A21.33,21.33,0,1,0,475.58,6.25L6.25,475.58a21.33,21.33,0,1,0,30.17,30.17L140.77,401.4A275.84,275.84,0,0,0,256,426.67c107.6,0,204.85-61.78,253.81-161.25a21.33,21.33,0,0,0,0-18.83A291,291,0,0,0,409.84,132.33ZM256,362.67a105.78,105.78,0,0,1-58.7-17.8l31.21-31.21A63.29,63.29,0,0,0,256,320a64.07,64.07,0,0,0,64-64,63.28,63.28,0,0,0-6.34-27.49l31.21-31.21A106.45,106.45,0,0,1,256,362.67ZM2.19,265.42a21.33,21.33,0,0,1,0-18.83C51.15,147.11,148.4,85.33,256,85.33a277,277,0,0,1,70.4,9.22l-55.88,55.88A105.9,105.9,0,0,0,150.44,270.52L67.88,353.08A295.2,295.2,0,0,1,2.19,265.42Z"/></svg>
					</div>
					<label for="log-in-button"></label><br><br>';

					//Conditional display
					$errors = $this->model->getStatusAry();
					if(!empty($errors)){
						if(in_array("accountCreated", $errors)){
							$html .= "
							<style>
								label[for=\"log-in-button\"]:after {
									color:green;
									content:'\A Account Created ';
									white-space:pre-line;
								}
							</style>
							";
						}
						if(in_array('invalidLogin', $errors)){
							$html .= "
								<style>
									label[for=\"log-in-button\"]:after {
										color: red;
										content:'\A Invalid Login ';
										white-space:pre-line;
								}
								</style>";
						}
						if(in_array('loggedOut', $errors)){
							$html .= "
								<style>
									label[for=\"log-in-button\"]:after {
										color: red;
										content:'\A Logged Out ';
										white-space:pre-line;
								}
								</style>";
							session_destroy();
							
						}
					}

					$html .= '
					<button type="submit" class="log-in-button button-animation" id = "log-in-button">
						<span class="button-animation-span">Log In</span>
					</button><br><br>
					<button type="reset" class="log-in-button button-animation" id="create-account-button" onclick="location.href=\'/signup\'">
						<span class="button-animation-span">Don\'t Have An Account? Sign Up</span>
					</button>
				</form>
			</div>

		</body>
		';

		return $html;
	}
}