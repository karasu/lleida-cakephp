<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Municipi $municipi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $municipi->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $municipi->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Municipis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="municipis form content">
            <?= $this->Form->create($municipi) ?>
            <fieldset>
                <legend><?= __('Edit Municipi') ?></legend>
                <?php
                    echo $this->Form->control('comarca_id', ['options' => $comarques]);
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
