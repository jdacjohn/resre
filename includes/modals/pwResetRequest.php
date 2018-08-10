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
<!-- Password Reset Modal -->
<div id="pwResetModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; padding-bottom: 0px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="width: 50%; float: left">
                    <h6 style="font-weight: 500;"><strong>Password reset.</strong></h6>
                </div>
            </div>
            
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <p class="slate2025 modal-p">Please enter your email address below.  If it matches an email in our system, you will receive an email with instructions to reset your password shortly.</p>
                <!-- Form -->
                <form id="pwReset_form" method='post' action='' style="margin-bottom: 5px;">
                    <input type="hidden" name="postFrom" value="__pwreset__" />
                    <input type="hidden" name="pwreset-trigger" id="pwreset-trigger" value="<?php echo isset($pwResetTrigger) ? $pwResetTrigger : ''; ?>" />
                    <div class="col-md-12 fix-left"><label class="slate1640Bold" style="margin-bottom: 0px; " for="pw_input_email">Email</label></div>
                    <div class="col-md-12 fix-left fix-top">
                        <input type="email" required class="slate2025 form-mustard modal-form" name="pw_input_email" id="pw_input_email" value="<?php echo isset($_POST['pw_input_email']) ? $_POST['pw_input_email'] : ''; ?>" placeholder="you@yourdomain.com" />
                    </div>
                </form>
                <div class="col-12 modal-error"><p id="pwErrMsg"><?php echo isset($pwErrMsg) ? $pwErrMsg : '&nbsp;'; ?></p></div>
                <div class="col-xs-6 col-sm-3 col-md-3"><a href="#" class="mid-button-mustard modal-btn" id="pwResetModal-submit"><span class="slate2025 modal-btn-label"><strong>Submit</strong></span></a></div>
                <div class="clear"></div>
                
            </div>
        </div>
    </div>
</div>
<!-- End PW Reset Modal -->
<script>
    $("#pwResetModal-submit").click(function() {
        // Test if valid email address
        var emAddress = $(document.getElementById('pw_input_email')).val();
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        var emailOk = pattern.test(emAddress);
        console.log("emailOk = " + emailOk);
        console.log("email address = " + emAddress);
        if (emailOk === true) {
            console.log("Valid email address entered: " + emAddress);
            $("#pwReset_form").submit();        
        } else {
            console.log('Invalid email address: ' + emAddress);
            $("#pwErrMsg").text('Please enter a valid email address.');
        }
    });
</script>
