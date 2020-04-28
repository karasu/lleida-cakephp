<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Naturalesa $naturalesa
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $naturalesa->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $naturalesa->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Naturaleses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="naturaleses form content">
            <?= $this->Form->create($naturalesa) ?>
            <fieldset>
                <legend><?= __('Edit Naturalesa') ?></legend>
                <?php
                    echo $this->Form->control('nom');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
