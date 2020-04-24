<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Naturalese $naturalese
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Naturalese'), ['action' => 'edit', $naturalese->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Naturalese'), ['action' => 'delete', $naturalese->id], ['confirm' => __('Are you sure you want to delete # {0}?', $naturalese->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Naturaleses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Naturalese'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="naturaleses view content">
            <h3><?= h($naturalese->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($naturalese->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($naturalese->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
