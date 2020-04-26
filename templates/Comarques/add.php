<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comarca $comarca
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Comarques'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comarques form content">
            <?= $this->Form->create($comarca) ?>
            <fieldset>
                <legend><?= __('Add Comarca') ?></legend>
                <?php
                    echo $this->Form->control('delegacio_id', ['options' => $delegacions]);
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
