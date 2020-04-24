<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Naturalese $naturalese
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $naturalese->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $naturalese->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Naturaleses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="naturaleses form content">
            <?= $this->Form->create($naturalese) ?>
            <fieldset>
                <legend><?= __('Edit Naturalese') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
