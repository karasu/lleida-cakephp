<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Centre $centre
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="centres form content">
            <?= $this->Form->create() ?>
            <fieldset>
            <legend><?= __('Search Centre') ?></legend>
            <?php
                echo $this->Form->control('codi');
                echo $this->Form->control('denominacio_completa');
                echo $this->Form->control('naturalesa_id', ['options' => $naturaleses, 'empty' => true, 'label' => __('Naturalesa')]);
                echo $this->Form->control('titularitat_id', ['options' => $titularitats, 'empty' => true]);
                echo $this->Form->control('codi_postal');
                echo $this->Form->control('municipi_id', ['options' => $municipis, 'empty' => true]);
                echo $this->Form->control('districte_id', ['options' => $districtes, 'empty' => true]);
                echo $this->Form->control('localitat_id', ['options' => $localitats, 'empty' => true]);
                echo $this->Form->control('zona_educativa');
                echo $this->Form->control('email_centre');
                //echo $this->Form->control('estudis._ids', ['options' => $estudis]);
            ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
