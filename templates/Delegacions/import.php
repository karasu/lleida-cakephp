<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacio $delegacio
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Delegacions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="titularitats form content">
            <?= $this->Form->create(null, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Choose CSV file to import Delegacions') ?></legend>
                <input type="file" name="csv" />
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
