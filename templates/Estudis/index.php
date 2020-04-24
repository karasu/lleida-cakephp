<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Estudi[]|\Cake\Collection\CollectionInterface $estudis
 */
?>
<div class="estudis index content">
    <?= $this->Html->link(__('New Estudi'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Estudis') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('codi') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudis as $estudi): ?>
                <tr>
                    <td><?= $this->Number->format($estudi->id) ?></td>
                    <td><?= h($estudi->codi) ?></td>
                    <td><?= h($estudi->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $estudi->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $estudi->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $estudi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudi->id)]) ?>
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
