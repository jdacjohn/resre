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
<!-- Modal -->
<div id="signupModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; padding-bottom: 0px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="width: 50%; float: left">
                    <h6 style="font-weight: 500;"><strong>Sign up.</strong></h6>
                </div>
            </div>
            
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <p class="slate2025 modal-p">It takes just a couple of minutes to get started.</p>
                <!-- Form -->
                <form id="signup_form" method='post' action='' style="margin-bottom: 5px;">
                    <input type="hidden" name="postFrom" value="__signup__" />
                    <input type="hidden" name="signup-trigger" id="signup-trigger" value="<?php echo isset($signupTrigger) ? $signupTrigger : ''; ?>" />
                    <div class="col-md-12 fix-left"><label class="slate1640Bold" style="margin-bottom: 0px; " for="input_email">Email</label></div>
                    <div class="col-md-12 fix-left fix-top">
                        <input type="email" required class="slate2025 form-mustard modal-form" name="signup_input_email" id="signup_input_email" value="<?php echo isset($_POST['signup_input_email']) ? $_POST['signup_input_email'] : ''; ?>" placeholder="you@yourdomain.com" />
                    </div>
                    <div class="col-md-12 fix-left" style="margin-top: 10px; margin-bottom: 5px;">
                        <input type="password" minlength="8" required class="slate2025 form-blue modal-form" name="signup_input_password" id="signup_input_password" value="<?php echo isset($_POST['signup_input_password']) ? $_POST['signup_input_password'] : ''; ?>" placeholder="PASSWORD" />
                    </div>
                    <div class="col-md-12 fix-left" style="margin-top: 10px; margin-bottom: 5px;">
                        <input type="password" minlength="8" required class="slate2025 form-blue modal-form" name="signup_input_password2" id="signup_input_password2" value="<?php echo isset($_POST['signup_input_password2']) ? $_POST['signup_input_password2'] : ''; ?>" placeholder="REPEAT PASSWORD" />
                    </div>
                </form>
                <div class="col-12 modal-error"><p id="signupErrMsg"><?php echo isset($signupErrMsg) ? $signupErrMsg : ''; ?></p></div>
                <div class="col-xs-6 col-sm-3 col-md-3"><a class="mid-button-mustard modal-btn" id="signupModal-submit"><span class="slate2025 modal-btn-label"><strong>Submit</strong></span></a></div>
                <div class="col-xs-6 col-sm-3 col-md-3" style="text-align: center;"><a class="mid-button-sand modal-btn" id="signupModal-cancel"><span class="slate2025 modal-btn-label"><strong>Cancel</strong></span></a></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#signupModal-cancel").click(function() {
        $("#signupModal").modal('toggle');
    });
    
    $("#signupModal-submit").click(function() {
        $("#signupErrMsg").text('');
        // Test if valid email address
        var emAddress = $(document.getElementById('signup_input_email')).val();
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var emailOk = pattern.test(emAddress);
        console.log("emailOk = " + emailOk);
        console.log("email address = " + emAddress);
        var pw1 = $("#signup_input_password").val();
        var pw2 = $("#signup_input_password2").val();
        var passwordsMatch = (pw1 === pw2);
        var pwLongEnough = false;
        if (passwordsMatch) {
            pwLongEnough = (pw1.length >= 8);
        }
        if (emailOk && passwordsMatch && pwLongEnough) {
            console.log("Input Good");
            $("#signup_form").submit();        
        } else {
            if (emailOk === false) {
                console.log('Invalid email address: ' + emAddress);
                $("#signupErrMsg").html('&bull; Please enter a valid email address.');
            }
            if (!passwordsMatch) {
                console.log('Mismatched passwords');
                if ($("#signupErrMsg").text() === ' ') {
                    $("#signupErrMsg").text('&bull; Your passwords do not match.');
                } else {
                    $("#signupErrMsg").html($("#signupErrMsg").text() + '<br />&bull; Your passwords do not match');
                }
            }
            if (!pwLongEnough) {
                console.log('Password too short');
                if ($("#signupErrMsg").text() === ' ') {
                    $("#signupErrMsg").text('&bull; Password must be at least 8 characters.');
                } else {
                    $("#signupErrMsg").html($("#signupErrMsg").text() + '<br />&bull; Password must be at least 8 characters.');
                }
            }
        }
    });
</script>
