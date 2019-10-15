<div id="alerta-sucesso" class="alert alert-success hide" role="alert">
    Cliente adicionado com sucesso! <a id="cliente-link" href="#" class="alert-link">Ver cliente</a>.
</div>
<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Clientes <small class="text-muted">Cadastro de cliente</small></h1>
<hr>

<form id="frm-cliente">
    <div class="form-row">
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nome da empresa</span>
                </div>
                <input type="text" class="form-control" id="nome" name="nome" type="text" class="form-control" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Nickname</span>
                </div>
                <input type="text" class="form-control" id="nickname" name="nickname" type="text" class="form-control" >
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-3">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">CNPJ</span>
                </div>
                <input name="cnpj" id="cnpj" type="text" class="form-control cnpj-mask"  required/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <span class="input-group-text">Data de Cadastro</span>
                </div>
                <input name="data_cadastro" id="data_cadastro" type="date" class="form-control" value="<?= date('Y-m-d'); ?>" required/>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <span class="input-group-text">Embarcador</span>
                    <input name="embarcador" id="embarcador" type="checkbox" class="form-control text-left"  value="1"  style="margin-top:10px;margin-right: 250px;">      
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
                    <input name="cep" id="cep" type="text" class="form-control" required />
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rua Nº e Complemento</span>
                    </div>
                    <input name="rua" id="rua" type="text" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Bairro</span>
                    </div>
                    <input name="bairro" id="bairro" type="text" class="form-control" required />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cidade</span>
                    </div>
                    <input name="cidade" id="cidade" type="text" class="form-control" required />
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Estado</span>
                    </div>
                    <input type="text" name="uf" class="form-control" id="uf" required>
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
        <div class="input-group mb-3">
            <input name="starcom[]" type="text" class="form-control starcom" />
        </div>
    </fieldset>
    <fieldset id="fieldset-contatos">
        <legend>CONTATO <button id="adicionar-contato" type="button" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button></legend>
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
    </fieldset>

    <div class="form-group">
        <label>Observação</label>
        <textarea name="obs" id="obs" class="form-control"></textarea>
    </div>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <span>Prospect</span>
        <label id="label_prospect_danger" class="btn btn-sm btn-danger active">
            <input type="radio" name="prospect" value="N" id="btn_prospect_danger" checked>
            <i class="fa fa-remove"></i>
        </label>
        <label id="label_prospect_sucesso" class="btn btn-sm btn-secondary">
            <input type="radio" name="prospect" value="Y" id="btn_prospect_success">
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