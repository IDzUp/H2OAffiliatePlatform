<?php defined('H2O') or exit('Access denied') ?>

<ul>
<?php foreach ($this->oMods as $sMod): ?>
    <?php if (H2O\ModHelper::isModifiable($sMod)): ?>
        <li><?php echo ucfirst($sMod) ?> - <a href="<?php echo H2O\Application::getUri('module', 'manage', 'install', 'what='.$sMod) ?>"><?php echo trans('Install') ?></a></li>
    <?php endif ?>
<?php endforeach ?>
</ul>