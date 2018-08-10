<style>
    body.modal-open {
        overflow: visible;
    }
    .modal-btn {
        padding: 4px 15px 2px;
        margin-left: -25px;
    }
    .modal-btn-label {
        font-weight: 500;
    }
    .modal-form {
        margin-left: 0px;
        margin-bottom: 15px;
        width: 100%;
    }
    .modal-error {
        color: #F00;
        font-weight: 600;
    }
    .modal-link {}
    .modal-link a {
        text-decoration: underline;
    }
    .modal-link a:hover {
        color: var(--berry);
        color: #B31231;
    }
    strong {
        font-weight: 600;
    }
    .modal-p {
        font-size: 20px;
        line-height: 26px;
    }
</style>
<!-- Login Modal -->
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; padding-bottom: 0px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="width: 50%; float: left">
                    <h6 style="font-weight: 500;"><strong>Login.</strong></h6>
                </div>
                <div style="width: 50%; float: left; text-align: right; margin-top: -12px; padding-right: 50px;">
                    <a href="#" class="mid-button-sand modal-btn" id='loginModal-signup'><span class="slate2025 modal-btn-label"><strong>Sign up</strong></span></a>
                </div>
            </div>
            
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <p class="slate2025 modal-p">Don't have an account?  Sign up today.</p>
                <!-- Form -->
                <form id="login_form" method='post' action='' style="margin-bottom: 5px;">
                    <input type="hidden" name="postFrom" value="__login__" />
                    <input type="hidden" name="login-trigger" id="login-trigger" value="<?php echo isset($loginTrigger) ? $loginTrigger : ''; ?>" />
                    <div class="col-md-12 fix-left"><label class="slate1640Bold" style="margin-bottom: 0px; " for="input_email">Email</label></div>
                    <div class="col-md-12 fix-left fix-top">
                        <input type="email" required class="slate2025 form-mustard modal-form" name="login_input_email" id="login_input_email" value="<?php echo isset($_POST['login_input_email']) ? $_POST['login_input_email'] : ''; ?>" placeholder="you@yourdomain.com" />
                    </div>
                    <div class="col-md-12 fix-left" style="margin-top: 10px; margin-bottom: 20px;">
                        <input type="password" required class="slate2025 form-blue modal-form" name="login_input_password" id="login_input_password" value="<?php echo isset($_POST['login_input_password']) ? $_POST['login_input_password'] : ''; ?>" placeholder="PASSWORD" />
                    </div>
                </form>
                <div class="col-12 modal-error"><p id="loginErrMsg"><?php echo isset($loginErrMsg) ? $loginErrMsg : '&nbsp;'; ?></p></div>
                <div class="col-xs-6 col-sm-3 col-md-3"><a class="mid-button-mustard modal-btn" id="loginModal-submit"><span class="slate2025 modal-btn-label"><strong>Submit</strong></span></a></div>
                <div class="col-xs-6 col-sm-3 col-md-3" style="text-align: center;"><a class="mid-button-sand modal-btn" id="loginModal-cancel"><span class="slate2025 modal-btn-label"><strong>Cancel</strong></span></a></div>
                <div class="col-xs-12 col-sm-6 col-md-6 modal-link" style="text-align: right; padding-top: 10px;"><a href="<?php echo HOME_LINK . 'us/index.php?postFrom=pwr'; ?>" class="slate2025" id="loginModal-lostpw">Lost Password</a></div>
                <div class="clear"></div>
                
            </div>
        </div>
    </div>
</div>
<!-- End Login Modal -->
<script>
    $("#loginModal-cancel").click(function() {
        $("#loginModal").modal('toggle');
    });
    $("#loginModal-signup").click(function() {
        $("#loginModal").modal("toggle");
        $("#signupModal").modal("toggle");
    });
    $("#loginModal-submit").click(function() {
        // Test if valid email address
        var emAddress = $(document.getElementById('login_input_email')).val();
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var emailOk = pattern.test(emAddress);
        console.log("emailOk = " + emailOk);
        console.log("email address = " + emAddress);
        if (emailOk === true) {
            console.log("Valid email address entered: " + emAddress);
            $("#login_form").submit();        
        } else {
            console.log('Invalid email address: ' + emAddress);
            $("#loginErrMsg").text('Please enter a valid email address.');
        }
    });
</script>
