<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comarque $comarque
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Comarque'), ['action' => 'edit', $comarque->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Comarque'), ['action' => 'delete', $comarque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comarque->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Comarques'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Comarque'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comarques view content">
            <h3><?= h($comarque->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Delegacion') ?></th>
                    <td><?= $comarque->has('delegacion') ? $this->Html->link($comarque->delegacion->id, ['controller' => 'Delegacions', 'action' => 'view', $comarque->delegacion->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($comarque->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comarque->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
