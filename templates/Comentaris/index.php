<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comentari[]|\Cake\Collection\CollectionInterface $comentaris
 */
?>
<div class="comentaris index content">
    <?= $this->Html->link(__('New Comentari'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Comentaris') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('centre_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comentaris as $comentari): ?>
                <tr>
                    <td><?= $this->Number->format($comentari->id) ?></td>
                    <td><?= $comentari->has('centre') ? $this->Html->link($comentari->centre->denominacio_completa, ['controller' => 'Centres', 'action' => 'view', $comentari->centre->id]) : '' ?></td>
                    <td><?= h($comentari->created) ?></td>
                    <td><?= h($comentari->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $comentari->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $comentari->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $comentari->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comentari->id)]) ?>
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
