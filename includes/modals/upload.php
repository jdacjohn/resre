<style>
    body.modal-open {
        overflow: visible;
    }
    .inputFile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .modal-btn {
        padding: 4px 15px 2px;
        margin-left: -25px;
    }
    .modal-btn-label {
        font-weight: 500;
    }
</style>
<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 style="font-weight: 500;"><strong>Upload.</strong></h6>
                <p class="slate2025" style="margin-bottom: 0px;">Have a picture of this characteristic?  Send it to us.  Images must be in PNG or JPG format and not be larger than 5MB.</p>

            </div>
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <!-- Form -->
                <form id="uploadForm" method='post' action='' enctype="multipart/form-data" style="margin-bottom: 5px;">
                    <input type="hidden" name="uploadDir" value="<?php echo $imgFolder; ?>" />
                    <input type="hidden" name="postFrom" value="__self__" />
                    <label for="file"><span class="slate1640Bold" id="inputLabel">Choose a file</span></label><br />
                    <input type='file' name='file' id='file' class='form-control inputFile' />
                </form>
                <div class="col-xs-6 col-sm-3 col-md-3"><a href="#" class="mid-button-mustard modal-btn" id="modalUpload"><span class="slate2025 modal-btn-label"><strong>Send</strong></span></a></div>
                <div class="col-xs-6 col-sm-3 col-md-3"><a href="#" id="modalCancel" class="mid-button-sand modal-btn"><span class="slate2025 modal-btn-label"><strong>Cancel</strong></span></a></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#modalCancel").click(function() {
        $("#uploadModal").modal('toggle');
    });
    $("#modalUpload").click(function() {
        $("#uploadForm").submit();
    });
    $("#uploadLink").click(function(e) {
        e.preventDefault();
    });
    $("#file").change(function() {
        $(document.getElementById('inputLabel')).text($(this).val().split(/(\\|\/)/g).pop());
    });

</script>

<!-- End Modal for Upload -->

