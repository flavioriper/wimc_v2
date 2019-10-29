<h1 class="header">Embarcadores <small class="text-muted">Lista de Equipamentos Disponíveis</small></h1>
<hr>

<div class="row">
    <div class="col-12">
        <table class="table-striped" id="tabela-envios">
            <thead class="thead-dark">
                <tr>
                    <th>Nº Envio</th>
                    <th>Embarcador</th>
                    <th>Série dos equipamentos</th>
                    <th>Referência Envio</th>
                    <th>Data Envio</th>
                    <th>Data Entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($envios as $envio) {?>
                <tr>
                    <td><?=$envio->id?></td>
                    <td><?=$envio->nome?></td>
                    <td>
                    <?php foreach($envio->equipamentos as $equipamento):
                        echo $equipamento->numero_serie.'<br>';
                    endforeach ?>
                    </td>
                    <td><?=$envio->referencia?></td>
                    <td><?=($envio->data_envio != '0000-00-00')? date('d/m/Y', strtotime($envio->data_envio)):''?></td>
                    <td><?=($envio->data_entrega != '0000-00-00')? date('d/m/Y', strtotime($envio->data_entrega)):''?></td>
                    <td>
                        <a role="button" href="<?=base_url('embarcadores/gerenciar/'.$envio->id)?>" class="form-contol btn btn-info">Alterar</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="deletarEquipamento" tabindex="-1" role="dialog" aria-labelledby="deletarEquipamentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletarEquipamentoLabel">Atenção!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Deseja realmente excluir este equipamento?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="confirmar-exclusao" type="button">Excluir</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>