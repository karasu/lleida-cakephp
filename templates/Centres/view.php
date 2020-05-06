<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Centre $centre
 */
?>
<?= $this->Html->css("https://unpkg.com/leaflet@1.6.0/dist/leaflet.css") ?>
<?= $this->Html->script("https://unpkg.com/leaflet@1.6.0/dist/leaflet.js") ?>


<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Accions') ?></h4>
            <?= $this->Html->link(__('Edita centre'), ['action' => 'edit', $centre->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Esborra centre'), ['action' => 'delete', $centre->id], ['confirm' => __('Are you sure you want to delete # {0}?', $centre->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Llista els centres'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nou centre'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="centres view content">
            <h3><?= h($centre->codi) ?> - <?= h($centre->denominacio_completa)?></h3>
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
                    <th><?= __('Naturalesa') ?></th>
                    <td><?= $centre->has('naturalesa') ? $this->Html->link($centre->naturalesa->nom, ['controller' => 'Naturaleses', 'action' => 'view', $centre->naturalesa->id]) : '--' ?></td>
                </tr>
                <tr>
                    <th><?= __('Titularitat') ?></th>
                    <td><?= $centre->has('titularitat') ? $this->Html->link($centre->titularitat->nom, ['controller' => 'Titularitats', 'action' => 'view', $centre->titularitat->id]) : '--' ?></td>
                </tr>
                <tr>
                    <th><?= __('Adreça') ?></th>
                    <td><?= h($centre->adreca) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codi Postal') ?></th>
                    <td><?= h($centre->codi_postal) ?></td>
                </tr>
                <tr>
                    <th><?= __('Telèfon') ?></th>
                    <td><?= h($centre->telefon) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fax') ?></th>
                    <td><?= h($centre->fax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Municipi') ?></th>
                    <td><?= $centre->has('municipi') ? $this->Html->link($centre->municipi->nom, ['controller' => 'Municipis', 'action' => 'view', $centre->municipi->id]) : '--' ?></td>
                </tr>
                <tr>
                    <th><?= __('Districte') ?></th>
                    <td><?= $centre->has('districte') ? $this->Html->link($centre->districte->id, ['controller' => 'Districtes', 'action' => 'view', $centre->districte->id]) : '--' ?></td>
                </tr>
                <tr>
                    <th><?= __('Localitat') ?></th>
                    <td><?= $centre->has('localitat') ? $this->Html->link($centre->localitat->nom, ['controller' => 'Localitats', 'action' => 'view', $centre->localitat->id]) : '--' ?></td>
                </tr>
                <tr>
                    <th><?= __('Zona Educativa') ?></th>
                    <td><?= h($centre->zona_educativa) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email Centre') ?></th>
                    <td><?= h($centre->email_centre) ?></td>
                </tr>
                <!--
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($centre->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coord Utm X') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_utm_x) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coord Utm Y') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_utm_y) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coord Geo X') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_geo_x) ?></td>
                </tr>
                <tr>
                    <th><?= __('Coord Geo Y') ?></th>
                    <td><?= $this->Number->format($centre->coordenades_geo_y) ?></td>
                </tr>
                -->
            </table>
            <br />
            <div class="related">
                <h4><?= __('Estudis') ?></h4>
                <?php if (!empty($centre->estudis)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <!-- <th><?= __('Id') ?></th> -->
                            <th><?= __('Codi') ?></th>
                            <th><?= __('Nom') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($centre->estudis as $estudis) : ?>
                        <tr>
                            <!-- <td><?= h($estudis->id) ?></td> -->
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

            <br />
            <div class="related">
            <h4><?= __('Mapa') ?></h4>

            <div id="openstreetmap"></div>
            <script>
                var geo_x = '<?= $this->Number->format($centre->coordenades_geo_y) ?>'.replace(',', '.');
                var geo_y = '<?= $this->Number->format($centre->coordenades_geo_x) ?>'.replace(',', '.');
                var zoom = 17;

                var mymap = L.map('openstreetmap').setView([geo_x, geo_y], zoom);

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);
                
                var marker = L.marker([geo_x, geo_y]).addTo(mymap);
                // marker.bindPopup("<?= h($centre->denominacio_completa) ?>").openPopup();
            </script>
            </div>
        </div>
    </div>
</div>
