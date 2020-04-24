<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacion $delegacion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $delegacion->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $delegacion->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Delegacions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegacions form content">
            <?= $this->Form->create($delegacion) ?>
            <fieldset>
                <legend><?= __('Edit Delegacion') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
