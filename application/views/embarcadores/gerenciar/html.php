<div id="alerta-sucesso" class="alert alert-success hide" role="alert">
    Dados salvos com sucesso! <a href="<?=base_url('embarcadores/listar')?>" class="alert-link">Voltar para listagem</a>.
</div>
<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Embarcadores <small class="text-muted">Gerenciar Envio</small></h1>
<hr>

<form id="frm-envio">
    <input value="<?=$envio->id?>" id="id" type="hidden">
    <div class="row rsw_camp">
        <div class="col-md-12"><br/></div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary text-white float-left">Salvar</button>
        </div>
        <div class="col-md-12"><br/></div>
        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Embarcador</label>
                </div>
                <select class="custom-select" name="embarcador" id="embarcador">
                <?php foreach($embarcadores as $embarcador): ?>
                    <option value="<?=$embarcador->id?>" <?=($envio->embarcador_id == $embarcador->id)?'selected':''?>><?=$embarcador->nome?></option>
                <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Referência de Envio</span>
                </div>
                <input type="text" class="form-control" name="referencia" value="<?=$envio->referencia?>" id="referencia">
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data de Envio</span>
                </div>
                <input type="date" class="form-control" name="data-envio" value="<?=date('Y-m-d', strtotime($envio->data_envio))?>" id="data-envio">
            </div>
        </div>

        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data de Entrega</span>
                </div>
                <input type="date" class="form-control" name="data-entrega" value="<?=date('Y-m-d', strtotime($envio->data_entrega))?>" id="data-entrega">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Operador Logistico</span>
                </div>
                <input type="text" class="form-control" name="operador" value="<?=$envio->operador?>" id="operador">
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Número Remessa</span>
                </div>
                <input type="text" class="form-control" name="remessa" value="<?=$envio->remessa?>" id="remessa">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mt-2">
            <h4 class="text-center">Equipamentos</h4>
            <table class="table-striped" id="tabela-equipamentos">
                <thead class="thead-dark">
                    <tr>
                        <th>Modelo</th>
                        <th>Nº Série</th>
                        <th>SimCard</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($equipamentos_escolhidos as $equipamento_escolhido):?>
                    <tr>
                        <td><?=$equipamento_escolhido->modelo?></td>
                        <td><?=$equipamento_escolhido->numero_serie?></td>
                        <td><?=$equipamento_escolhido->imei_sincard?></td>
                        <td>
                            <input type="checkbox" id="<?=$equipamento_escolhido->id?>" serie="<?=$equipamento_escolhido->numero_serie?>" class="form-control checkbox montar-equipamentos" checked>
                        </td>
                    </tr>
                <?php endforeach?>
                <?php foreach($equipamentos as $equipamento):?>
                    <tr>
                        <td><?=$equipamento->modelo?></td>
                        <td><?=$equipamento->numero_serie?></td>
                        <td><?=$equipamento->imei_sincard?></td>
                        <td>
                            <input type="checkbox" id="<?=$equipamento->id?>" serie="<?=$equipamento->numero_serie?>" class="form-control checkbox montar-equipamentos">
                        </td>
                    </tr>
                <?php endforeach?>
                </tbody>
            </table>
        <div class="col-md-12"><br/><br/></div>
    </div>
</form>

<div class="modal fade" id="modalAviso" tabindex="-1" role="dialog" aria-labelledby="modalAvisoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAvisoLabel">Atenção!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="texto-aviso"></div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>