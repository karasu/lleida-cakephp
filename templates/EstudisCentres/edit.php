<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EstudisCentre $estudisCentre
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $estudisCentre->centre_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $estudisCentre->centre_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Estudis Centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudisCentres form content">
            <?= $this->Form->create($estudisCentre) ?>
            <fieldset>
                <legend><?= __('Edit Estudis Centre') ?></legend>
                <?php
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
