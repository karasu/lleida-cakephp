<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Municipi[]|\Cake\Collection\CollectionInterface $municipis
 */
?>
<div class="municipis index content">
    <div class="float-right">
        <?= $this->Html->link(__('New Municipi'), ['action' => 'add'], ['class' => 'button']) ?>
        <?= $this->Html->link(__('Import'), ['action' => 'import'], ['class' => 'button button-outline']) ?>
    </div>
    <h3><?= __('Municipis') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('comarca_id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($municipis as $municipi): ?>
                <tr>
                    <td><?= h($municipi->id) ?></td>
                    <td><?= $municipi->has('comarque') ? $this->Html->link($municipi->comarque->id, ['controller' => 'Comarques', 'action' => 'view', $municipi->comarque->id]) : '' ?></td>
                    <td><?= h($municipi->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $municipi->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $municipi->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $municipi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $municipi->id)]) ?>
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
