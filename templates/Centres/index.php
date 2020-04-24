<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Centre[]|\Cake\Collection\CollectionInterface $centres
 */
?>
<div class="centres index content">
    <?= $this->Html->link(__('New Centre'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Centres') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('codi') ?></th>
                    <th><?= $this->Paginator->sort('denominacio_completa') ?></th>
                    <th><?= $this->Paginator->sort('naturalesa_id') ?></th>
                    <th><?= $this->Paginator->sort('titularitat_id') ?></th>
                    <th><?= $this->Paginator->sort('adreca') ?></th>
                    <th><?= $this->Paginator->sort('codi_postal') ?></th>
                    <th><?= $this->Paginator->sort('telefon') ?></th>
                    <th><?= $this->Paginator->sort('fax') ?></th>
                    <th><?= $this->Paginator->sort('municipi_id') ?></th>
                    <th><?= $this->Paginator->sort('districte_id') ?></th>
                    <th><?= $this->Paginator->sort('localitat_id') ?></th>
                    <th><?= $this->Paginator->sort('zona_educativa') ?></th>
                    <th><?= $this->Paginator->sort('coordenades_utm_x') ?></th>
                    <th><?= $this->Paginator->sort('coordenades_utm_y') ?></th>
                    <th><?= $this->Paginator->sort('coordenades_geo_x') ?></th>
                    <th><?= $this->Paginator->sort('coordenades_geo_y') ?></th>
                    <th><?= $this->Paginator->sort('email_centre') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($centres as $centre): ?>
                <tr>
                    <td><?= $this->Number->format($centre->id) ?></td>
                    <td><?= h($centre->codi) ?></td>
                    <td><?= h($centre->denominacio_completa) ?></td>
                    <td><?= $centre->has('naturalese') ? $this->Html->link($centre->naturalese->id, ['controller' => 'Naturaleses', 'action' => 'view', $centre->naturalese->id]) : '' ?></td>
                    <td><?= $centre->has('titularitat') ? $this->Html->link($centre->titularitat->id, ['controller' => 'Titularitats', 'action' => 'view', $centre->titularitat->id]) : '' ?></td>
                    <td><?= h($centre->adreca) ?></td>
                    <td><?= h($centre->codi_postal) ?></td>
                    <td><?= h($centre->telefon) ?></td>
                    <td><?= h($centre->fax) ?></td>
                    <td><?= $centre->has('municipi') ? $this->Html->link($centre->municipi->id, ['controller' => 'Municipis', 'action' => 'view', $centre->municipi->id]) : '' ?></td>
                    <td><?= $centre->has('districte') ? $this->Html->link($centre->districte->id, ['controller' => 'Districtes', 'action' => 'view', $centre->districte->id]) : '' ?></td>
                    <td><?= $centre->has('localitat') ? $this->Html->link($centre->localitat->id, ['controller' => 'Localitats', 'action' => 'view', $centre->localitat->id]) : '' ?></td>
                    <td><?= h($centre->zona_educativa) ?></td>
                    <td><?= $this->Number->format($centre->coordenades_utm_x) ?></td>
                    <td><?= $this->Number->format($centre->coordenades_utm_y) ?></td>
                    <td><?= $this->Number->format($centre->coordenades_geo_x) ?></td>
                    <td><?= $this->Number->format($centre->coordenades_geo_y) ?></td>
                    <td><?= h($centre->email_centre) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $centre->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $centre->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $centre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $centre->id)]) ?>
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