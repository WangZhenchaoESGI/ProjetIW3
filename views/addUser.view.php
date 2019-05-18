<style>
    #logreg-forms{
        width:420px;
        margin:10vh auto;
        background-color:#f3f3f3;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    #logreg-forms form {
        width: 100%;
        max-width: 410px;
        padding: 15px;
        margin: auto;
    }
    #logreg-forms .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    #logreg-forms .form-control:focus { z-index: 2; }
    #logreg-forms .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    #logreg-forms .form-signin input[type="password"] {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    #logreg-forms .social-login{
        width:390px;
        margin:0 auto;
        margin-bottom: 14px;
    }
    #logreg-forms .social-btn{
        font-weight: 100;
        color:white;
        width:190px;
        font-size: 0.9rem;
    }

    #logreg-forms a{
        display: block;
        padding-top:10px;
        color:lightseagreen;
    }

    #logreg-form .lines{
        width:200px;
        border:1px solid red;
    }


    #logreg-forms button[type="submit"]{ margin-top:10px; }

    #logreg-forms .facebook-btn{  background-color:#3C589C; }

    #logreg-forms .google-btn{ background-color: #DF4B3B; }

    #logreg-forms .form-reset, #logreg-forms .form-signup{ display: none; }

    #logreg-forms .form-signup .social-btn{ width:210px; }

    #logreg-forms .form-signup input { margin-bottom: 2px;}

    .form-signup .social-login{
        width:210px !important;
        margin: 0 auto;
    }

    /* Mobile */

    @media screen and (max-width:500px){
        #logreg-forms{
            width:300px;
        }

        #logreg-forms  .social-login{
            width:200px;
            margin:0 auto;
            margin-bottom: 10px;
        }
        #logreg-forms  .social-btn{
            font-size: 1.3rem;
            font-weight: 100;
            color:white;
            width:200px;
            height: 56px;

        }
        #logreg-forms .social-btn:nth-child(1){
            margin-bottom: 5px;
        }
        #logreg-forms .social-btn span{
            display: none;
        }
        #logreg-forms  .facebook-btn:after{
            content:'Facebook';
        }

        #logreg-forms  .google-btn:after{
            content:'Google+';
        }

    }
</style>

<div id="login">
    <div id="logreg-forms">

        <div class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center;color: #1d2124"> INSCRIPTION</h1>
            <div class="social-login">
                <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> &nbsp; Facebook </span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> &nbsp; Google+ </span> </button>
            </div>
            <p style="text-align:center"> OR  </p>

            <?php $this->addModal("form", $form);?>

            <a href="#" id="forgot_pswd">Forgot password?</a>
        </div>

        <form action="/reset/password/" class="form-reset">
            <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
        </form>

    </div>
</div>

<fb:login-button
        scope="public_profile,email"
        onlogin="checkLoginState();">
</fb:login-button>

<button class="btn btn-warning" onclick="logout()">Log out FB</button>


<script>
    function logout() {
        FB.logout(function(response) {
            // Person is now logged out
        });
    }
    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            testAPI();
        } else {
            // The person is not logged into your app or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '539129156491498',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.3'
        });

        // Now that we've initialized the JavaScript SDK, we call
        // FB.getLoginStatus().  This function gets the state of the
        // person visiting this page and can return one of three states to
        // the callback you provide.  They can be:
        //
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        //
        // These three cases are handled in the callback function.

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });

    };

    // Load the SDK asynchronously
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function(response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
        });
    }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>

