<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Naturalesa $naturalesa
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Naturalesa'), ['action' => 'edit', $naturalesa->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Naturalesa'), ['action' => 'delete', $naturalesa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $naturalesa->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Naturaleses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Naturalesa'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="naturaleses view content">
            <h3><?= h($naturalesa->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($naturalesa->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($naturalesa->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
