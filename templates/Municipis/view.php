<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Municipi $municipi
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Municipi'), ['action' => 'edit', $municipi->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Municipi'), ['action' => 'delete', $municipi->id], ['confirm' => __('Are you sure you want to delete # {0}?', $municipi->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Municipis'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Municipi'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="municipis view content">
            <h3><?= h($municipi->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($municipi->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Comarca') ?></th>
                    <td><?= $municipi->has('comarca') ? $this->Html->link($municipi->comarca->id, ['controller' => 'Comarques', 'action' => 'view', $municipi->comarca->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($municipi->nom) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Centres') ?></h4>
                <?php if (!empty($municipi->centres)) : ?>
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
                        <?php foreach ($municipi->centres as $centres) : ?>
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
            <div class="related">
                <h4><?= __('Related Districtes') ?></h4>
                <?php if (!empty($municipi->districtes)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Municipi Id') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($municipi->districtes as $districtes) : ?>
                        <tr>
                            <td><?= h($districtes->id) ?></td>
                            <td><?= h($districtes->municipi_id) ?></td>
                            <td><?= h($districtes->nom) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Districtes', 'action' => 'view', $districtes->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Districtes', 'action' => 'edit', $districtes->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Districtes', 'action' => 'delete', $districtes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $districtes->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Localitats') ?></h4>
                <?php if (!empty($municipi->localitats)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Municipi Id') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($municipi->localitats as $localitats) : ?>
                        <tr>
                            <td><?= h($localitats->id) ?></td>
                            <td><?= h($localitats->municipi_id) ?></td>
                            <td><?= h($localitats->nom) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Localitats', 'action' => 'view', $localitats->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Localitats', 'action' => 'edit', $localitats->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Localitats', 'action' => 'delete', $localitats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $localitats->id)]) ?>
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
