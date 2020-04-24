<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Naturalese[]|\Cake\Collection\CollectionInterface $naturaleses
 */
?>
<div class="naturaleses index content">
    <?= $this->Html->link(__('New Naturalese'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Naturaleses') ?></h3>
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
                <?php foreach ($naturaleses as $naturalese): ?>
                <tr>
                    <td><?= $this->Number->format($naturalese->id) ?></td>
                    <td><?= h($naturalese->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $naturalese->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $naturalese->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $naturalese->id], ['confirm' => __('Are you sure you want to delete # {0}?', $naturalese->id)]) ?>
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
