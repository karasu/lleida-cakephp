<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comarca $comarca
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Comarca'), ['action' => 'edit', $comarca->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Comarca'), ['action' => 'delete', $comarca->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comarca->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Comarques'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Comarca'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comarques view content">
            <h3><?= h($comarca->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Delegació') ?></th>
                    <td><?= $comarca->has('delegacio') ? $this->Html->link($comarca->delegacio->id, ['controller' => 'Delegacions', 'action' => 'view', $comarca->delegacio->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($comarca->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comarca->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
