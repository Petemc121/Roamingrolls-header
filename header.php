<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 

<?php
wp_head();



  
?>




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

</head>



<header class="fixed-top">

  <div class="navbar bg-custom " id ="nav">
      <a href="https://roamingrolls.com" class="navbar-brand d-flex align-items-center">
     <img class="logo" src="https://roamingrolls.com/wp-content/uploads/2020/07/RR-2.svg" alt="alt text" />
    <strong id="title2">ROAMINGROLLS</strong>
      </a>
      <div>
      <div class="text-right">
	
	  <!-- <button id = "currencyButton" type="button" class="btn btn-outline-light " data-toggle="tooltip" >
                <span><h5><?php 
// $ip =  $_SERVER['REMOTE_ADDR'];
// echo $location = file_get_contents("http://api.hostip.info/country.php?ip=$ip");
?></h5></span>
      </button>   -->
	  <button id="loginbtn" data-placement="bottom" title="Sign in/sign up" class="btn btn-outline-light my-2 my-sm-0 bg-#1E3163" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
	  <i id="tick" class="fas fa-check fa-xs"></i>
      <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-file-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm6 7a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 11.825 10.623 11 8 11s-4.146.826-5 1.755V13a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
</svg>
      </button>
      <button id = "sidebarbtn" type="button" id="sidebarCollapse" class="btn btn-outline-light btn-info" data-toggle="tooltip" data-placement="bottom" title="Menu">
                <span><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-layout-text-sidebar-reverse" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M2 1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm12-1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/>
  <path fill-rule="evenodd" d="M5 15V1H4v14h1zm8-11.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5zm0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5z"/>
</svg></span>
	  </button>  
</div>
</div>
  </div>
</div>
</div> 



<div id = "signpop"  class="container h-100">
<div id = "block" class = "blocker"><div Id="logAddGymMsg" class="alert alert-danger" role="alert">
  Please log in/verify your account to add a gym.
</div></div>

		<div class="d-flex justify-content-center h-100">
		<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://roamingrolls.com/wp-content/uploads/2020/07/RR-2.svg" class="sign_logo" alt="Logo">
					</div>
				</div>
				<div id="wpLogCon" class="d-flex justify-content-center form_container">
					<!-- <span class="input-group-text sign-icon"><i class="fas fa-user"></i></span>
								<span class="input-group-text sign-icon"><i class="fas fa-key"></i></span>
						 -->
					<?php

function custom_login() {
    if (isset($_POST['loginform-custom'])) {
        $login_data = array();
        $login_data['user_login'] = sanitize_user($_POST['user_login']);
        $login_data['user_pass'] = esc_attr($_POST['user_pass']);

		$user = wp_signon( $login_data, false );
		

        if ( is_wp_error($user) ) {
            echo $user->get_error_message();
        } else {    
            wp_clear_auth_cookie();
            do_action('wp_login', $user->ID);
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);
            $redirect_to = $_SERVER['REQUEST_URI'];
			wp_safe_redirect($redirect_to);
			exit;
			
        }
    }
}

add_action( 'after_setup_theme', 'custom_login' );
	
if ( ! is_user_logged_in() ) { // Display WordPress login form:
    $args = array(
        'redirect' => "https://www.roamingrolls.com", 
        'form_id' => 'loginform-custom',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log in' ),
        'remember' => true
    );
	wp_login_form( $args );
	
} else { // If logged in:
	echo "<p>";
	wp_loginout( home_url() ); // Display "Log Out" link.
	echo "<p>";
	echo "<style> .links {display:none !important;}
				  #tick{display:block !important;}	
			</style>";
	echo "<style>#logSuccess{display:block;}</style>";
}
?>
				</div>
		
				<div class="mt-4">
       
					<div class="d-flex justify-content-center links">
						Don't have an account?
            <!-- <input id="clicked" name="clicked" value="clicked"></input> <button id ="signBtn" name="signUp" type="submit" > --->
            <div id="signClick"><a href="https://www.roamingrolls.com/sign-up/" id="signClick" class="ml-2">Sign up</a></div>
					</div>
        
				</div>
        		<div class="mt-4">
       
					<div id ="forgotPassword" class="d-flex justify-content-center links">
						Forgot your password?
            <!-- <input id="clicked" name="clicked" value="clicked"></input> <button id ="signBtn" name="signUp" type="submit" > --->
            <div id="passResetClick"><a href=<?php 
            $resetURL = wp_lostpassword_url();
            echo $resetURL;
            ?> class="ml-2">Click here</a></div>
					</div>
        
				</div>
			</div>
		</div>
	</div>

<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" style="right:0">
<div id = "blockSide" class = "blocker"></div>
<div id="socialMediaCon">     

<a href="https://www.facebook.com/RoamingRolls/?__xts__[0]=68.ARCWMIg9E_eD7KNw4cZJ6m47vrklgTUIC2fJCzZynHUw3q_2SEtChTgpnvwBf8bnaAT7luYAeO9Ybg269Tvl2eLwQO96aNtde92gv5Uo7LaPu1wzvsjIDl-MF1dtARnE_uEUsEbIG-tghNQvnCytSDi66k772nWSIjB1pq_mGSgIL3OVzPXDFBD9KH4-HfAIJEVyoeTGDmT69cLYVb4KgBMBnaa7xw3gjBOQ3VtlY78wWFDyc2BBS0VRIz97xx6pFEwTSkE2oDPNlKoA0ABEm4EfTasN0IWz1AQZa8EdxCCib3ugEoHgAwkZqsSrM-kpSb06GHNczcqSSdIIol_2v-DtB7Yn"><i id="facebookSideIcon" title="Facebook page" class="fab fa-facebook-square fa-2x topIcon"></i></a>

<a href="https://www.instagram.com/roamingrolls/"><img id="instagramIcon" src="https://www.roamingrolls.com/wp-content/uploads/2021/04/instagram-logo-icon-png-13582-2.png">
</a>


</div>

      <div id = "nav-contain">
  <a href="https://www.roamingrolls.com/"><p class="nav-item">Home</p></a>
  <a href="https://www.roamingrolls.com/about-roamingrolls/"><p class="nav-item">About RR</a>
 <p class="nav-item">Account</p>
  <a href="
  <?php
  if (is_user_logged_in())
  {
 $current_user = wp_get_current_user();
  echo 'https://www.roamingrolls.com/Profiles/'.$current_user->user_login;
  }
  ?>
  "><p class="nav-sub-item">Profile</a>
  <a href="https://www.roamingrolls.com/account-settings"><p class="nav-sub-item">Settings</a>
  <a href="https://www.roamingrolls.com/?s=&post_type=gyms"><p class="nav-item">Find a Gym</a>
  <a
  <?php
   if ( ! is_user_logged_in() ){
    echo "";} else {
    echo "href ='https://www.roamingrolls.com/add%20your%20gym/'";}
    ?>><p id ="addGymSlide" class="nav-item">Add a Gym</p></a>
  <a href="https://www.roamingrolls.com/articles/"><p class="nav-item">Articles</a>
      </div>

<script>

function logGymShow() { 
  
  addGymMsg.style.display = "block";
}


<?php

$currentUser = wp_get_current_user();
$id = $currentUser->ID;
$status = get_user_meta ($id, 'user_status',true);

if ( ! is_user_logged_in() ||  $status !== 1  ) {
  echo " addgym2 = document.getElementById('addGymSlide');
                addgym2.addEventListener('click', function() { showpopup()
                logGymShow()
                setTimeout(function(){fade(addGymMsg)}, 1000);})";
}

?>


  </script>

    <?php

// dynamic_sidebar('sidebar-1');

?>

   <?php


// wp_nav_menu(

//   array(

//     'menu' => 'primary',
//     'container' => '',
//     'theme_location' => 'primary',
//     'items-wrap' => '<ul id="" class="list-unstyled components">%3$s</ul>'
//   )


// );

?>


    </nav>
</div>



</header>






