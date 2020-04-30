<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Centre[]|\Cake\Collection\CollectionInterface $centres
 */
?>
<div class="centres index content">
    <div class="float-right">
        <?= $this->Html->link(__('Cerca'), ['action' => 'search'], ['class' => 'button']) ?>
        <?= $this->Html->link(__('Afegeix Centre'), ['action' => 'add'], ['class' => 'button button-outline']) ?>
        <?= $this->Html->link(__('Importa CSV'), ['action' => 'import'], ['class' => 'button button-outline']) ?>
    </div>
    <h3><?= __('Centres') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <!--<th><?= $this->Paginator->sort('id') ?></th>-->
                    <th><?= $this->Paginator->sort('codi') ?></th>
                    <th><?= $this->Paginator->sort('denominacio_completa', __('Denominació completa')) ?></th>
                    <th><?= $this->Paginator->sort('naturalesa_id') ?></th>
                    <th><?= $this->Paginator->sort('titularitat_id') ?></th>
                    <th><?= $this->Paginator->sort('adreca', __('Adreça')) ?></th>
                    <th><?= $this->Paginator->sort('codi_postal', __('Codi postal')) ?></th>
                    <th><?= $this->Paginator->sort('telefon', __('Telèfon')) ?></th>
                    <th><?= $this->Paginator->sort('fax') ?></th>
                    <th><?= $this->Paginator->sort('municipi_id') ?></th>
                    <th><?= $this->Paginator->sort('districte_id') ?></th>
                    <th><?= $this->Paginator->sort('localitat_id') ?></th>
                    <th><?= $this->Paginator->sort('zona_educativa') ?></th>
                    <th><?= $this->Paginator->sort('coordenades_utm_x', __('Utm X')) ?></th>
                    <th><?= $this->Paginator->sort('coordenades_utm_y', __('Utm Y')) ?></th>
                    <th><?= $this->Paginator->sort('coordenades_geo_x', __('Geo X')) ?></th>
                    <th><?= $this->Paginator->sort('coordenades_geo_y', __('Geo Y')) ?></th>
                    <th><?= $this->Paginator->sort('email_centre', __('Correu electrònic')) ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($centres as $centre): ?>
                <tr>
                    <!--<td><?= $this->Number->format($centre->id) ?></td>-->
                    <td><?= h($centre->codi) ?></td>
                    <td><?= $this->Html->link(h($centre->denominacio_completa), ['action' => 'view', $centre->id]) ?></td>
                    <td><?= $centre->has('naturalesa') ? $this->Html->link($centre->naturalesa->nom, ['controller' => 'Naturaleses', 'action' => 'view', $centre->naturalesa->id]) : '' ?></td>
                    <td><?= $centre->has('titularitat') ? $this->Html->link($centre->titularitat->nom, ['controller' => 'Titularitats', 'action' => 'view', $centre->titularitat->id]) : '' ?></td>
                    <td><?= h($centre->adreca) ?></td>
                    <td><?= h($centre->codi_postal) ?></td>
                    <td><?= h($centre->telefon) ?></td>
                    <td><?= h($centre->fax) ?></td>
                    <td><?= $centre->has('municipi') ? $this->Html->link($centre->municipi->nom, ['controller' => 'Municipis', 'action' => 'view', $centre->municipi->id]) : '' ?></td>
                    <td><?= $centre->has('districte') ? $this->Html->link($centre->districte->nom, ['controller' => 'Districtes', 'action' => 'view', $centre->districte->id]) : '' ?></td>
                    <td><?= $centre->has('localitat') ? $this->Html->link($centre->localitat->nom, ['controller' => 'Localitats', 'action' => 'view', $centre->localitat->id]) : '' ?></td>
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
