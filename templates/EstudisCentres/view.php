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
            <?= $this->Html->link(__('Edit Estudis Centre'), ['action' => 'edit', $estudisCentre->centre_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Estudis Centre'), ['action' => 'delete', $estudisCentre->centre_id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudisCentre->centre_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Estudis Centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Estudis Centre'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudisCentres view content">
            <h3><?= h($estudisCentre->centre_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Centre') ?></th>
                    <td><?= $estudisCentre->has('centre') ? $this->Html->link($estudisCentre->centre->id, ['controller' => 'Centres', 'action' => 'view', $estudisCentre->centre->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Estudi') ?></th>
                    <td><?= $estudisCentre->has('estudi') ? $this->Html->link($estudisCentre->estudi->id, ['controller' => 'Estudis', 'action' => 'view', $estudisCentre->estudi->id]) : '' ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
