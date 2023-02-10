<h2 class="dashboard__heading"><?php echo $titulo ?></h2>

<div class="dashboard__contenedor">
    <?php if(!empty($configuracion)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <td scope="col" class="table__th">Concepto</td>
                    <td scope="col" class="table__th table__th-detalle">Detalle</td>
                    <td scope="col" class="table__th">Acciones</td>
                </tr>
            </thead>
            <tbody class="table__tbody">
                <?php foreach($configuracion as $config) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $config->concepto ?>
                        </td>
                        <td class="table__td table__td-detalle">
                            <?php echo $config->detalle ?>
                        </td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/configuracion/editar?id=<?php echo $config->id; ?>">
                                <i class="fa-solid fa-user-pen"></i> 
                                Editar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</div>