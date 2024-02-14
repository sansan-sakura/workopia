<?php if(isset($errors)):?>
              <?php foreach($errors as $error):?>
                <div class="bg-red-100 message my-3"><?=$error?></div>
              <?php endforeach;?>
              <?php endif;?>