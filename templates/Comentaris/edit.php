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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $comentari->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $comentari->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Comentaris'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comentaris form content">
            <?= $this->Form->create($comentari) ?>
            <fieldset>
                <legend><?= __('Edit Comentari') ?></legend>
                <?php
                    echo $this->Form->control('centre_id', ['options' => $centres]);
                    //echo $this->Form->control('created');
                    //echo $this->Form->control('modified');
                    echo $this->Form->control('text');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
