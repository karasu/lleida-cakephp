<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Districte[]|\Cake\Collection\CollectionInterface $districtes
 */
?>
<div class="districtes index content">
    <div class="float-right">
        <?= $this->Html->link(__('New Districte'), ['action' => 'add'], ['class' => 'button']) ?>
        <?= $this->Html->link(__('Import'), ['action' => 'import'], ['class' => 'button button-outline']) ?>
    </div>
    <h3><?= __('Districtes') ?></h3>
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
                <?php foreach ($districtes as $districte): ?>
                <tr>
                    <td><?= h($districte->id) ?></td>
                    <td><?= $districte->has('municipi') ? $this->Html->link($districte->municipi->id, ['controller' => 'Municipis', 'action' => 'view', $districte->municipi->id]) : '' ?></td>
                    <td><?= h($districte->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $districte->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $districte->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $districte->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districte->id)]) ?>
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
