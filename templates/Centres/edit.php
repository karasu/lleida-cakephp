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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $centre->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $centre->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="centres form content">
            <?= $this->Form->create($centre) ?>
            <fieldset>
                <legend><?= __('Edit Centre') ?></legend>
                <?php
                    echo $this->Form->control('codi');
                    echo $this->Form->control('denominacio_completa');
                    echo $this->Form->control('naturalesa_id', ['options' => $naturaleses]);
                    echo $this->Form->control('titularitat_id', ['options' => $titularitats]);
                    echo $this->Form->control('adreca');
                    echo $this->Form->control('codi_postal');
                    echo $this->Form->control('telefon');
                    echo $this->Form->control('fax');
                    echo $this->Form->control('municipi_id', ['options' => $municipis]);
                    echo $this->Form->control('districte_id', ['options' => $districtes, 'empty' => true]);
                    echo $this->Form->control('localitat_id', ['options' => $localitats, 'empty' => true]);
                    echo $this->Form->control('zona_educativa');
                    echo $this->Form->control('coordenades_utm_x');
                    echo $this->Form->control('coordenades_utm_y');
                    echo $this->Form->control('coordenades_geo_x');
                    echo $this->Form->control('coordenades_geo_y');
                    echo $this->Form->control('email_centre');
                    echo $this->Form->control('estudis._ids', ['options' => $estudis]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
