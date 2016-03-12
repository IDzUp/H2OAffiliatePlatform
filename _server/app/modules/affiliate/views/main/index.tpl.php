<?php defined('H2O') or exit('Access denied') ?>

<?php if (!empty($this->sErrMsg)): ?>
    <?php echo $this->sErrMsg ?>
<?php else: ?>

    <p class="bold"><?php echo trans('Your affiliate URL is: <em><a href="?m=affiliate&amp;c=router&amp;a=refer&amp;id=' . $this->iAffId . '">' . H2O_ROOT_URL . 'm=affiliate&amp;c=router&amp;a=refer&amp;id=' . $this->iAffId . '</a></em>') ?></p>

<?php endif ?>