<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Localitat[]|\Cake\Collection\CollectionInterface $localitats
 */
?>
<div class="localitats index content">
    <?= $this->Html->link(__('New Localitat'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Localitats') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('municipi_id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($localitats as $localitat): ?>
                <tr>
                    <td><?= h($localitat->id) ?></td>
                    <td><?= $localitat->has('municipi') ? $this->Html->link($localitat->municipi->id, ['controller' => 'Municipis', 'action' => 'view', $localitat->municipi->id]) : '' ?></td>
                    <td><?= h($localitat->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $localitat->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $localitat->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $localitat->id], ['confirm' => __('Are you sure you want to delete # {0}?', $localitat->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
