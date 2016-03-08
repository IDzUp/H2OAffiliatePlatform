<?php defined('H2O') or exit('Access denied') ?>

<ul>
<?php foreach ($this->oMods as $sMod): ?>
    <?php if (H2O\ModHelper::isModifiable($sMod) && !$this->_oModModel->isActivated($sMod) && !$this->_oModModel->isDisabled($sMod)): ?>
        <li><a href="<?php echo H2O\Application::getUri('module', 'manage', 'install', 'what='.$sMod) ?>"><?php echo ucfirst($sMod) ?></a></li>
    <?php endif ?>
<?php endforeach ?>