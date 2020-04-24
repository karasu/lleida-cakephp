<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Estudi $estudi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Estudis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudis form content">
            <?= $this->Form->create($estudi) ?>
            <fieldset>
                <legend><?= __('Add Estudi') ?></legend>
                <?php
                    echo $this->Form->control('codi');
                    echo $this->Form->control('nom');
                    echo $this->Form->control('centres._ids', ['options' => $centres]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
