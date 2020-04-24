<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Centre $centre
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Centre'), ['action' => 'edit', $centre->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Centre'), ['action' => 'delete', $centre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $centre->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Centre'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="centres view content">
            <h3><?= h($centre->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Codi') ?></th>
                    <td><?= h($centre->codi) ?></td>
                </tr>
                <tr>
                    <th><?= __('Denominacio Completa') ?></th>
                    <td><?= h($centre->denominacio_completa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Naturalese') ?></th>
                    <td><?= $centre->has('naturalese') ? $this->Html->link($centre->naturalese->id, ['controller' => 'Naturaleses', 'action' => 'view', $centre->naturalese->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Titularitat') ?></th>
                    <td><?= $centre->has('titularitat') ? $this->Html->link($centre->titularitat->id, ['controller' => 'Titularitats', 'action' => 'view', $centre->titularitat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Adreca') ?></th>
                    <td><?= h($centre->adreca) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codi Postal') ?></th>
                    <td><?= h($centre->codi_postal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telefon') ?></th>
                    <td><?= h($centre->telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fax') ?></th>
                    <td><?= h($centre->fax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Municipi') ?></th>
                    <td><?= $centre->has('municipi') ? $this->Html->link($centre->municipi->id, ['controller' => 'Municipis', 'action' => 'view', $centre->municipi->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Districte') ?></th>
                    <td><?= $centre->has('districte') ? $this->Html->link($centre->districte->id, ['controller' => 'Districtes', 'action' => 'view', $centre->districte->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Localitat') ?></th>
                    <td><?= $centre->has('localitat') ? $this->Html->link($centre->localitat->id, ['controller' => 'Localitats', 'action' => 'view', $centre->localitat->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Zona Educativa') ?></th>
                    <td><?= h($centre->zona_educativa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email Centre') ?></th>
                    <td><?= h($centre->email_centre) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($centre->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coordenades Utm X') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_utm_x) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coordenades Utm Y') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_utm_y) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coordenades Geo X') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_geo_x) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coordenades Geo Y') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_geo_y) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Estudis') ?></h4>
                <?php if (!empty($centre->estudis)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Codi') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($centre->estudis as $estudis) : ?>
                        <tr>
                            <td><?= h($estudis->id) ?></td>
                            <td><?= h($estudis->codi) ?></td>
                            <td><?= h($estudis->nom) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Estudis', 'action' => 'view', $estudis->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Estudis', 'action' => 'edit', $estudis->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Estudis', 'action' => 'delete', $estudis->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudis->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>