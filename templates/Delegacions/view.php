<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacio $delegacio
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delegacio'), ['action' => 'edit', $delegacio->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delegacio'), ['action' => 'delete', $delegacio->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delegacio->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Delegacions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delegacio'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegacions view content">
            <h3><?= h($delegacio->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($delegacio->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($delegacio->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
