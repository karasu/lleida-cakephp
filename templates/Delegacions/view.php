<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delegacion $delegacion
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Delegacion'), ['action' => 'edit', $delegacion->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Delegacion'), ['action' => 'delete', $delegacion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delegacion->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Delegacions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Delegacion'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="delegacions view content">
            <h3><?= h($delegacion->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($delegacion->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($delegacion->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
