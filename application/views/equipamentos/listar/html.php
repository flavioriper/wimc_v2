<h1 class="header">Equipamentos <small class="text-muted">Gerenciamento de equipamentos</small></h1>
<hr>

<div class="row">
    <div class="col-12">
        <table class="table-striped" id="tabela-equipamentos">
            <thead class="thead-dark">
                <tr>
                    <th>Modelo</th>
                    <th>Nº de Série</th>
                    <th>Localização</th>
                    <th>Embarcador</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($equipamentos as $equipamento) {?>
                <tr>
                    <td><?=$equipamento->modelo?></td>
                    <td><?=$equipamento->numero_serie?></td>
                    <td>
                        <div class="form-group" style="margin-bottom: 0px;">                            
                            <select class="form-control" disabled>
                                <option selected><?=$equipamento->localizacao?></option> 
                            </select>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <div class="form-group" style="margin-bottom: 0px;">                            
                            <select class="form-control" disabled>
                                <option selected><?=$equipamento->status?></option> 
                            </select>
                        </div>
                    </td>
                    <td>
                        <a role="button" href="<?=base_url('equipamentos/gerenciar/'.$equipamento->id)?>" class="form-contol btn btn-info">Alterar</a>
                    </td>
                    <td>
                        <a role="button" class="btn btn-danger" onClick="deletarEquipamento('<?=$equipamento->id?>')" style="color:white;">Excluir</a>
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