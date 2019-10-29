<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Processo <small class="text-muted">Novo Processo</small></h1>
<hr>

<div class="form-row">
    <main>
        <input id="tab2" type="radio" name="tabs" checked><label for="tab2" class="label_tab">Criação de Processo</label>
        <section id="content2">
            <form id="criar-processo" accept-charset="utf-8">
                <div class="row">
                    <div class="col-md-12"><br/>
                        <h4>Dados Gerais</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="embarcador">Embarcador</label>
                            </div>
                            <select class="custom-select" name="embarcador" id="embarcador">
                                <?php foreach($embarcadores as $embarcador):?>
                                   <option value="<?=$embarcador->id?>"><?=$embarcador->nome?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="cliente">Cliente Final</label>
                            </div>
                            <select class="custom-select" name="cliente" id="cliente">
                                <?php foreach($clientes as $cliente):?>
                                    <option value="<?=$cliente->id?>"><?=$cliente->nome?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success text-white">Gerar</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
</div>

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