<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comentari $comentari
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Comentari'), ['action' => 'edit', $comentari->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Comentari'), ['action' => 'delete', $comentari->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comentari->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Comentaris'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Comentari'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comentaris view content">
            <h3><?= h($comentari->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Centre') ?></th>
                    <td><?= $comentari->has('centre') ? $this->Html->link($comentari->centre->id, ['controller' => 'Centres', 'action' => 'view', $comentari->centre->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comentari->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Timestamp') ?></th>
                    <td><?= h($comentari->timestamp) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($comentari->text)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
