<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comentari $comentari
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Comentaris'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comentaris form content">
            <?= $this->Form->create($comentari) ?>
            <fieldset>
                <legend><?= __('Add Comentari') ?></legend>
                <?php
                    echo $this->Form->control('centre_id', ['options' => $centres]);
                    echo $this->Form->control('timestamp');
                    echo $this->Form->control('text');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
