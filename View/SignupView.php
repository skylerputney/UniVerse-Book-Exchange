<?php

class SignupView{
	private $model;

	public function __construct($model){
		$this->model = $model;
	}

	public function display(){
		$html = '
		<head>
			<title>UNIverse Book Exchange</title>
			<link rel="stylesheet" href="../Styles/styles.css">
			<link rel="stylesheet" href="../Styles/warp-styles.css">
		</head>
		
		<body style="background-color:0;">

		<div class="space stars1"></div>
		<div class="space stars2"></div>
		<div class="space stars3"></div>

			<div class ="header-bar" class= "flex-container">
				<div class = "title-header-bar">
					UNIverse Book Exchange 
				</div>	
			</div>

			<div id = "signup-box" class = "login-box">
				Sign Up To The UNIverse<br><br>
				<form method="POST">
					<input type="hidden" value="signup" name="route">
					<input type="hidden" value="validateSignup" name="action">

					<input type="text" class="login-input" name="username" id="username" placeholder="Username" required><br><br>
					<input type="text" class="login-input" name="email" class="login-input" placeholder="Email Address" required><br><br>
					<input type="text" class="login-input" name="password" placeholder="Password" required><br><br>
     				<input type="text" class="login-input" name="university" placeholder="University" required><br>
		'; 
				//Conditional display
				$errors = $this->model->getErrors();
				if(!empty($errors)){
						//Account already exists
						if(in_array('accountDupe', $errors)){
							$html .=
								"<style>
									label[for=\"log-in-button\"]:after {
									content:'\A Username/Email is already taken \A';
									white-space:pre-line;
									}
								</style>";
						}
						//Password doesn't meet requirements
						else if(in_array('invalidPass', $errors)){
							$html .= 
								"<style>
									label[for=\"log-in-button\"]::after {
										font-size:0.7em;
										float:left;
										text-align:left;
										padding-left:20px;
										padding-bottom:1em;
										content:'\A Password Must Contain:\A \\2022  8-16 Characters \A \\2022  At Least 1 Uppercase Character (A-Z) \A \\2022  At Least 1 Lowercase Character (a-z) \A \\2022  At Least 1 Number (0-9) \A \\2022  At Least 1 Special Character ($, %, #, *, &, -, ., !) \A';
										white-space:pre-line;
									}
								 </style>";
						}
				}

				$html .= '
					<label for="log-in-button"></label><br><br>
					<button type="submit" class = "log-in-button button-animation" id = "create-account-button">
						<span class = "button-animation-span"> Sign Up</span>
					</button><br><br>
					<button type="reset" class = "log-in-button button-animation" id="login-button" onclick="location.href=\'/login\'">
						<span class = "button-animation-span">Already Have An Account? Log In</span>
					</button>
				</form>	
			</div>
		</body>
		';

	return $html;
	}
}
