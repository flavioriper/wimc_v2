<div id="alerta-sucesso" class="alert alert-success hide" role="alert">
    Dados salvos com sucesso! <a href="<?=base_url('equipamentos/listar')?>" class="alert-link">Voltar para listagem</a>.
</div>
<div id="alerta-numero-serie" class="alert alert-danger hide" role="alert">
    O número de série já está cadastrado.
</div>
<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Equipamentos <small class="text-muted">Cadastro de equipamento</small></h1>
<hr>

<form id="frm-equipamento">
    <input value="<?=$equipamento->id?>" id="id" name="id" type="hidden">
    <div class="form-row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="tipo_equipamento">Tipo de Equipamento</label>
                </div>
                <select class="custom-select" id="tipo_equipamento" name="tipo_equipamento" required>
                    <?php foreach($modelos as $modelo): ?>                    
                        <option value="<?=$modelo->id?>" <?=($modelo->id == $equipamento->tipo_equipamento)?'selected':''?>><?=$modelo->nome?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="status">Status</label>
                </div>
                <select class="custom-select" id="status" name="status" <?=($equipamento->status_id != 4 && $equipamento->status_id != 6)? 'disabled':''?>>
                <?php foreach($status as $status): ?>
                
                    <?php if ($equipamento->status_id == 4 && ($status->id == 4 || $status->id == 6)) { ?>
                        <option 
                            value="<?=$status->id?>"
                            <?=($status->id == $equipamento->status_id)?'selected disabled':''?>
                        >
                            <?=$status->descricao?>
                        </option>
                    <?php } else if ($equipamento->status_id != 4 && $equipamento->status_id != 6 && $status->id == $equipamento->status_id) {?>
                        <option 
                            value="<?=$status->id?>"
                            <?=($status->id == $equipamento->status_id)?'selected':''?>
                        >
                            <?=$status->descricao?>
                        </option>
                    <?php } else if ($equipamento->status_id == 6 && ($status->id == 6 || $status->id == 1 || $status->id == 7 || $status->id == 8)) {?>
                        <option 
                            value="<?=$status->id?>"
                            <?=($status->id == $equipamento->status_id)?'selected disabled':''?>
                        >
                            <?=$status->descricao?>
                        </option>
                    <?php }?>
                <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Nº de Série</span>
                </div>                        
                <input name="numero_serie" id="numero_serie" value="<?=$equipamento->numero_serie?>" type="text" class="form-control" required />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Imei / SimCard</span>
                </div>                        
                <input name="imei_sincard" id="imei_sincard" value="<?=$equipamento->imei_sincard?>" type="text" class="form-control" required />
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Atualização de Firmware</span>
                </div>
                <input name="atualizacao_firmware" id="atualizacao_firmware" value="<?=$equipamento->atualizacao_firmware?>" type="date" class="form-control" required />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="localizacao">Localização</label>
                </div>
                <select class="custom-select" id="localizacao" name="localizacao" <?=($equipamento->tipo_localizacao == 1)?'disabled':''?>>
                    <?php foreach($localizacoes as $localizacao): ?>
                        <option 
                            value="<?=$localizacao->id?>" 
                            <?=($localizacao->id == $equipamento->id_localizacao)?'selected':''?>
                            <?=($localizacao->tipo == 1)?'disabled':''?>
                        >
                            <?=$localizacao->descricao?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Fabricante</span>
                </div>
                <input name="fabricante" id="fabricante" value="<?=$equipamento->fabricante?>" type="text" class="form-control" required />
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-sm-12">
            <label>Observação</label>
            <textarea name="observacoes" id="observacoes" class="form-control" ><?=$equipamento->observacoes?></textarea>
        </div>
    </div>
    <div class="form-group">
        <button id="enviar" type="submit" class="btn btn-primary pull-right">Enviar</button>
    </div>
</form>