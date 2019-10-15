<div id="alerta-sucesso" class="alert alert-success hide" role="alert">
    Dados salvos com sucesso! <a href="<?=base_url('clientes/listar')?>" class="alert-link">Voltar para listagem</a>.
</div>
<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Clientes <small class="text-muted">Cadastro de cliente</small></h1>
<hr>

<form id="frm-cliente">
    <input value="<?=$cliente->id?>" id="id" name="id" type="hidden">
    <div class="form-row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nome da empresa</span>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" type="text" class="form-control" value="<?=$cliente->nome?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nickname</span>
                </div>
                <input type="text" class="form-control" id="nickname" name="nickname" type="text" value="<?=$cliente->nickname?>" class="form-control" >
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">CNPJ</span>
                </div>
                <input name="cnpj" id="cnpj" type="text" class="form-control cnpj-mask" value="<?=$cliente->cnpj?>" required/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data de Cadastro</span>
                </div>
                <input name="data_cadastro" id="data_cadastro" type="date" class="form-control" value="<?=$cliente->data_inserido?>" required/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <span class="input-group-text">Embarcador</span>
                    <input name="embarcador" id="embarcador" type="checkbox" class="form-control text-left"  value="1"
                        <?=($cliente->embarcador == 1) ? 'checked':''?>
                        style="margin-top:10px;margin-right: 250px;">      
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">País</label>
                </div>
                <select class="custom-select" name="pais" id="pais">
                </select>
            </div>
        </div>
    </div>
    <fieldset>
        <legend>ENDEREÇO</legend>
        <div class="form-row">
            <div class="col-sm-3">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">CEP</span>
                    </div>
                    <input name="cep" id="cep" type="text" value="<?=$cliente->cep?>" class="form-control" required />
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rua Nº e Complemento</span>
                    </div>
                    <input name="rua" id="rua" type="text" class="form-control" value="<?=$cliente->rua?>" required />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bairro</span>
                    </div>
                    <input name="bairro" id="bairro" type="text" class="form-control" value="<?=$cliente->bairro?>" required />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cidade</span>
                    </div>
                    <input name="cidade" id="cidade" type="text" class="form-control" value="<?=$cliente->cidade?>" required />
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Estado</span>
                    </div>
                    <input type="text" name="uf" class="form-control" id="uf" value="<?=$cliente->uf?>" required>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="produto">Produto</label>
            </div>

            <select class="custom-select" id="produto" name="produto">
                <option value="">Escolher</option>
            </select>
        </div>
    </fieldset>
    <fieldset id="fieldset-starcom">
        <legend>Sistemas <button id="adicionar-starcom" type="button" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button></legend>
        <?php if (is_array(json_decode($cliente->starcom)) && count(json_decode($cliente->starcom)) > 0) {?>
            <?php foreach(json_decode($cliente->starcom) as $starcom): ?>
                <div class="input-group mb-3">
                    <input name="starcom[]" type="text" value="<?=$starcom?>" class="form-control starcom" />
                </div>
            <?php endforeach?>
        <?php } else {?>
            <div class="input-group mb-3">
                <input name="starcom[]" type="text" class="form-control starcom" />
            </div>
        <?php }?>
    </fieldset>
    <fieldset id="fieldset-contatos">
        <legend>CONTATO <button id="adicionar-contato" type="button" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button></legend>
        <?php if (is_array(json_decode($cliente->contato)) && count(json_decode($cliente->contato)) > 0) {?>
            <?php foreach(json_decode($cliente->contato) as $contato): ?>
                <div class="contato-grupo">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Contato</span>
                        </div>
                        <input name="contato[nome][]" type="text" value="<?=$contato->nome?>" class="form-control nome-contato" required/>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Telefone</span>
                                </div>
                                <input name="contato[telefone][]" type="text" value="<?=$contato->telefone?>" class="form-control telefone-contato"/>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">E-mail</span>
                                </div>
                                <input name="contato[email][]" type="email" value="<?=$contato->email?>" class="form-control email-contato" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Cargo / Função</span>
                                </div>
                                <input name="contato[cargo][]" type="text" value="<?=$contato->cargo?>" class="form-control cargo-contato" />
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
        <?php } else { ?>
            <div class="contato-grupo">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Contato</span>
                    </div>
                    <input name="contato[nome][]" type="text" class="form-control nome-contato" required/>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Telefone</span>
                            </div>
                            <input name="contato[telefone][]" type="text" class="form-control telefone-contato"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">E-mail</span>
                            </div>
                            <input name="contato[email][]" type="email" class="form-control email-contato" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cargo / Função</span>
                            </div>
                            <input name="contato[cargo][]" type="text" class="form-control cargo-contato" />
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </fieldset>

    <div class="form-group">
        <label>Observação</label>
        <textarea name="obs" id="obs" class="form-control"><?=$cliente->obs?></textarea>
    </div>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <span>Prospect</span>
        <label id="label_prospect_danger" class="btn btn-sm btn-danger <?=($cliente->prospect == 'N')? 'active' : ''?>">
            <input type="radio" name="prospect" value="N" id="btn_prospect_danger" <?=($cliente->prospect == 'N')? 'checked' : ''?>>
            <i class="fa fa-remove"></i>
        </label>
        <label id="label_prospect_sucesso" class="btn btn-sm btn-secondary <?=($cliente->prospect == 'Y')? 'active' : ''?>">
            <input type="radio" name="prospect" value="Y" id="btn_prospect_success" <?=($cliente->prospect == 'Y')? 'checked' : ''?>>
            <i class="fa fa-check"></i>
        </label>
    </div>
    <div class="form-group">
        <button id="enviar" type="submit" class="btn btn-primary pull-right">Enviar</button>
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