<?php 
?>
            <div class="row ccSave" id="continueButton">
                    <div class="col-xs-12 stories-upload slate2025 hidden-md hidden-lg">
                        <?php echo (!$response == 0) ? $response : 'Have an Image of your selection? <a data-toggle="modal" data-target="#uploadModal" id="uploadLink">Upload Now</a>'; ?>
                    </div>
                    <div class='col-xs-5 col-md-2 col-md-offset-1 ccButtons ccButton-first'>                    
                        <a class='mid-button-mustard' onclick="document.getElementById('<?php echo $formId; ?>').submit();"><span class="blue2228Bold">Continue</span></a>
                    </div>
                    <div class='col-md-6 hidden-sm hidden-xs ccButtons ccUpload slate2025'>
                        <?php echo (!$response == 0) ? $response : 'Have an Image of your selection? <a data-toggle="modal" data-target="#uploadModal" id="uploadLink">Upload Now</a>'; ?>
                    </div>
                    <div class='col-xs-3 col-sm-4 col-md-1 ccButtons ccButton-middle'>
                        <a id="moveBack" class='mid-button-sand'><span class="blue2228Bold">Back</span></a>
                    </div>
                    <div class='col-xs-3 col-sm-2 ccButtons ccButton-last'>
                        <a class='mid-button-sand' id="saveBtn"><span class="blue2228Bold">Save</span></a>
                    </div>
            </div>
