<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Districte $districte
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $districte->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $districte->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Districtes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="districtes form content">
            <?= $this->Form->create($districte) ?>
            <fieldset>
                <legend><?= __('Edit Districte') ?></legend>
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
