<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comarque[]|\Cake\Collection\CollectionInterface $comarques
 */
?>
<div class="comarques index content">
    <?= $this->Html->link(__('New Comarque'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Comarques') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('delegacio_id') ?></th>
                    <th><?= $this->Paginator->sort('nom') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comarques as $comarque): ?>
                <tr>
                    <td><?= $this->Number->format($comarque->id) ?></td>
                    <td><?= $comarque->has('delegacion') ? $this->Html->link($comarque->delegacion->id, ['controller' => 'Delegacions', 'action' => 'view', $comarque->delegacion->id]) : '' ?></td>
                    <td><?= h($comarque->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $comarque->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comarque->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comarque->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comarque->id)]) ?>
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
