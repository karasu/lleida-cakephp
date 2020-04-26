<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comarca[]|\Cake\Collection\CollectionInterface $comarques
 */
?>
<div class="comarques index content">
    <div class="float-right">
        <?= $this->Html->link(__('New Comarca'), ['action' => 'add'], ['class' => 'button']) ?>
        <?= $this->Html->link(__('Import'), ['action' => 'import'], ['class' => 'button button-outline']) ?>
    </div>
    
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
                <?php foreach ($comarques as $comarca): ?>
                <tr>
                    <td><?= $this->Number->format($comarca->id) ?></td>
                    <td><?= $comarca->has('delegacio') ? $this->Html->link($comarca->delegacio->id, ['controller' => 'Delegacions', 'action' => 'view', $comarca->delegacio->id]) : '' ?></td>
                    <td><?= h($comarca->nom) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $comarca->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comarca->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comarca->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comarca->id)]) ?>
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
