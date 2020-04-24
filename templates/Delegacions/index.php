<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacion[]|\Cake\Collection\CollectionInterface $delegacions
 */
?>
<div class="delegacions index content">
    <?= $this->Html->link(__('New Delegacion'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Delegacions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($delegacions as $delegacion): ?>
                <tr>
                    <td><?= $this->Number->format($delegacion->id) ?></td>
                    <td><?= h($delegacion->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $delegacion->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $delegacion->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $delegacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delegacion->id)]) ?>
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
