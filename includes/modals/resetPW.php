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
<div id="resetModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; padding-bottom: 0px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div style="width: 50%; float: left">
                    <h6 style="font-weight: 500;"><strong>Reset password.</strong></h6>
                </div>
            </div>
            
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <p class="slate2025 modal-p">Please enter your new password below.</p>
                <!-- Form -->
                <form id="reset_form" method='post' action='' style="margin-bottom: 5px;">
                    <input type="hidden" name="postFrom" value="__reset__" />
                    <input type="hidden" name="user-id" id="user-id" value="<?php echo (isset($userId)) ? $userId : 0; ?>" />
                    <input type="hidden" name="reset-trigger" id="reset-trigger" value="<?php echo isset($resetTrigger) ? $resetTrigger : ''; ?>" />
                    <div class="col-md-12 fix-left" style="margin-top: 10px; margin-bottom: 5px;">
                        <input type="password" minlength="8" required class="slate2025 form-mustard modal-form" name="reset_input_password" id="reset_input_password" value="<?php echo isset($_POST['signup_input_password']) ? $_POST['signup_input_password'] : ''; ?>" placeholder="PASSWORD" />
                    </div>
                    <div class="col-md-12 fix-left" style="margin-top: 10px; margin-bottom: 5px;">
                        <input type="password" minlength="8" required class="slate2025 form-blue modal-form" name="reset_input_password2" id="reset_input_password2" value="<?php echo isset($_POST['signup_input_password2']) ? $_POST['signup_input_password2'] : ''; ?>" placeholder="REPEAT PASSWORD" />
                    </div>
                </form>
                <div class="col-12 modal-error"><p id="resetErrMsg"><?php echo isset($resetErrMsg) ? $resetErrMsg : ''; ?></p></div>
                <div class="col-xs-6 col-sm-3 col-md-3"><a href="#" class="mid-button-mustard modal-btn" id="resetModal-submit"><span class="slate2025 modal-btn-label"><strong>Submit</strong></span></a></div>
                <div class="col-xs-6 col-sm-3 col-md-3" style="text-align: center;"><a href="#" class="mid-button-sand modal-btn" id="resetModal-cancel"><span class="slate2025 modal-btn-label"><strong>Cancel</strong></span></a></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#resetModal-cancel").click(function() {
        $("#resetModal").modal('toggle');
    });
    
    $("#resetModal-submit").click(function() {
        $("#resetErrMsg").text('');
        // Test if valid email address
        var pw1 = $("#reset_input_password").val();
        var pw2 = $("#reset_input_password2").val();
        var passwordsMatch = (pw1 === pw2);
        var pwLongEnough = false;
        if (passwordsMatch) {
            pwLongEnough = (pw1.length >= 8);
        }
        if (passwordsMatch && pwLongEnough) {
            console.log("Input Good");
            $("#reset_form").submit();        
        } else {
            if (!passwordsMatch) {
                console.log('Mismatched passwords');
                if ($("#resetErrMsg").text() === ' ') {
                    $("#resetErrMsg").text('&bull; Your passwords do not match.');
                } else {
                    $("#resetErrMsg").html($("#resetErrMsg").text() + '<br />&bull; Your passwords do not match');
                }
            }
            if (!pwLongEnough) {
                console.log('Password too short');
                if ($("#resetErrMsg").text() === ' ') {
                    $("#resetErrMsg").text('&bull; Password must be at least 8 characters.');
                } else {
                    $("#resetErrMsg").html($("#resetErrMsg").text() + '<br />&bull; Password must be at least 8 characters.');
                }
            }
        }
    });
</script>
