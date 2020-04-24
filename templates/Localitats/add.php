<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Localitat $localitat
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Localitats'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="localitats form content">
            <?= $this->Form->create($localitat) ?>
            <fieldset>
                <legend><?= __('Add Localitat') ?></legend>
                <?php
                    echo $this->Form->control('municipi_id', ['options' => $municipis]);
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
