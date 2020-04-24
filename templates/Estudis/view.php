<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Estudi $estudi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Estudi'), ['action' => 'edit', $estudi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Estudi'), ['action' => 'delete', $estudi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $estudi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Estudis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Estudi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="estudis view content">
            <h3><?= h($estudi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Codi') ?></th>
                    <td><?= h($estudi->codi) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($estudi->nom) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($estudi->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Centres') ?></h4>
                <?php if (!empty($estudi->centres)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Codi') ?></th>
                            <th><?= __('Denominacio Completa') ?></th>
                            <th><?= __('Naturalesa Id') ?></th>
                            <th><?= __('Titularitat Id') ?></th>
                            <th><?= __('Adreca') ?></th>
                            <th><?= __('Codi Postal') ?></th>
                            <th><?= __('Telefon') ?></th>
                            <th><?= __('Fax') ?></th>
                            <th><?= __('Municipi Id') ?></th>
                            <th><?= __('Districte Id') ?></th>
                            <th><?= __('Localitat Id') ?></th>
                            <th><?= __('Zona Educativa') ?></th>
                            <th><?= __('Coordenades Utm X') ?></th>
                            <th><?= __('Coordenades Utm Y') ?></th>
                            <th><?= __('Coordenades Geo X') ?></th>
                            <th><?= __('Coordenades Geo Y') ?></th>
                            <th><?= __('Email Centre') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($estudi->centres as $centres) : ?>
                        <tr>
                            <td><?= h($centres->id) ?></td>
                            <td><?= h($centres->codi) ?></td>
                            <td><?= h($centres->denominacio_completa) ?></td>
                            <td><?= h($centres->naturalesa_id) ?></td>
                            <td><?= h($centres->titularitat_id) ?></td>
                            <td><?= h($centres->adreca) ?></td>
                            <td><?= h($centres->codi_postal) ?></td>
                            <td><?= h($centres->telefon) ?></td>
                            <td><?= h($centres->fax) ?></td>
                            <td><?= h($centres->municipi_id) ?></td>
                            <td><?= h($centres->districte_id) ?></td>
                            <td><?= h($centres->localitat_id) ?></td>
                            <td><?= h($centres->zona_educativa) ?></td>
                            <td><?= h($centres->coordenades_utm_x) ?></td>
                            <td><?= h($centres->coordenades_utm_y) ?></td>
                            <td><?= h($centres->coordenades_geo_x) ?></td>
                            <td><?= h($centres->coordenades_geo_y) ?></td>
                            <td><?= h($centres->email_centre) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Centres', 'action' => 'view', $centres->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Centres', 'action' => 'edit', $centres->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Centres', 'action' => 'delete', $centres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $centres->id)]) ?>
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
