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
    strong {
        font-weight: 600;
    }
    .modal-p {
        font-size: 20px;
        line-height: 26px;
    }
</style>
<!-- Data Saved Modal -->
<div id="wbModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding-left: 50px; padding-top: 30px; padding-bottom: 0px; border-bottom: none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 style="font-weight: 500;"><strong><?php echo $wbHeader; ?></strong></h6>
                <p class="slate2025 modal-p" style="margin-bottom: 0px;"><?php echo $wbContent; ?></p>

            </div>
            <div class="modal-body" style="padding-left: 50px; padding-right: 50px; padding-top: 0px;">
                <!-- Form -->
                <form id="wbForm" method='post' action='' style="margin-bottom: 5px;">
                    <input type="hidden" name="postFrom" value="__self__" />
                    <input type="hidden" name="wb-trigger" id="wb-trigger" value="<?php echo $wbTrigger; ?>" />
                </form>
                <div class="col-xs-6 col-sm-3 col-md-3"><a href="#" id="wbOk" class="mid-button-sand modal-btn"><span class="slate2025 modal-btn-label"><strong>OK</strong></span></a></div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#wbOk").click(function() {
        $("#wbModal").modal('toggle');
    });
</script>
