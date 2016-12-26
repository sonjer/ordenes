
<div class="error">
        <div class="error-code m-b-10 m-t-20"><?php echo lang("ctn_133") ?></div>
        <h3 class="font-bold"><?php echo lang("ctn_134") ?></h3>

        <div class="error-desc">
            <?php echo $message ?><hr>
            <div>
                    <input type="button" class="btn btn-danger btn-lg" value="<?php echo lang("ctn_135") ?>" onclick="window.history.back()" class="btn btn-default btn-sm" />
            </div>
        </div>
</div>

<style>
 .error {
  margin: 0 auto;
  text-align: center;
}

.error-code {
  bottom: 60%;
  color: #2d353c;
  font-size: 96px;
  line-height: 100px;
}

.error-desc {
  font-size: 25px;
  color: #647788;
}




</style>