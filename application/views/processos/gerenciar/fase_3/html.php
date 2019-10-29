<div id="alerta-sucesso" class="alert alert-success hide" role="alert">
    Dados salvos com sucesso! <a href="<?=base_url('processos/listar')?>" class="alert-link">Voltar para listagem</a>.
</div>
<div id="alerta-erro" class="alert alert-danger hide" role="alert">
    Ocorreu um erro! Contate o administrador.
</div>

<h1 class="header">Processo - <?=$processo->id?> <small><?=($processo->fase == 5)?'Finalizado':''?></small></h1>
<hr>

<div class="form-row">
    <main>
        <input id="tab2" type="radio" onClick="changeTab(1)" name="tabs" <?=($fase == 1)?'checked':''?>><label for="tab2" class="label_tab">Abertura de viagem</label>
        <input id="tab3" type="radio" onClick="changeTab(2)" name="tabs" <?=($fase == 2)?'checked':''?>><label for="tab3" class="label_tab">Acompanhamento de viagens</label>
        <input id="tab4" type="radio" onClick="changeTab(3)" name="tabs" <?=($fase == 3)?'checked':''?>><label for="tab4" class="label_tab">Espelhamento</label>
        <input id="tab5" type="radio" onClick="changeTab(4)" name="tabs" <?=($fase == 4)?'checked':''?>><label for="tab5" class="<?=($processo->fase < 4)?'none':''?> label_tab">Retorno de equipamento</label>

        <section id="content4">
            <form id="atualizar-processo" accept-charset="utf-8">
                <input type="hidden" id="id" value="<?=$processo->id ?>">
                <input type="hidden" id="espelhamento-id" value="<?=$espelhamento->id ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cliente</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->cliente_nome?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Último Status adc.</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=(count($processo_status) > 0)?$processo_status[0]->nome:''?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <table class="table-striped" id="tabela-equipamentos">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Modelo</th>
                                    <th>Nº Série</th>
                                    <th>SimCard</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($equipamentos_escolhidos as $equipamento_escolhido):?>
                                <tr>
                                    <td><?=$equipamento_escolhido->modelo?></td>
                                    <td><?=$equipamento_escolhido->numero_serie?></td>
                                    <td><?=$equipamento_escolhido->imei_sincard?></td>
                                </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="row">							
                            <div class="col-md-12">
                                <h4 class="row-title">Rastreador</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Gerenciador</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Gerenciador" id="gerenciador" value="<?=$espelhamento->gerenciador?>">
                                </div>
                            </div>
                    
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">URL</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Link de rastreamento:" id="url" value="<?=$espelhamento->url?>">
                                </div>
                            </div>
                    
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Login</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Digite o Login do Rastreador:" id="login-rastreador" value="<?=$espelhamento->login_rastreador?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Senha</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Digite a senha do Rastreador:" id="senha-rastreador" value="<?=$espelhamento->senha_rastreador?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">							
                            <div class="col-md-12">
                                <h4 class="row-title">Motorista</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Nome do motorista</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome" id="motorista-nome"
                                        value="<?=$espelhamento->motorista_nome?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Documento</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Documento" id="motorista-documento"
                                        value="<?=$espelhamento->motorista_documento?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Caminhão</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Caminhão" id="motorista-caminhao"
                                        value="<?=$espelhamento->motorista_caminhao?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Escolta</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Escolta" id="escolta"
                                        value="<?=$espelhamento->escolta?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Transportadora</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Transportadora" id="transportadora"
                                        value="<?=$espelhamento->transportadora?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Alt. de Frequência?</span>
                                    </div>
                                    <div class="form-control">
                                        <input type="checkbox" style="display: block !important; margin: 4px 4px 0 0; float: left;"
                                            id="alteracao-frequencia" <?=($espelhamento->alteracao_frequencia == 1)?'checked':''?> value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">							
                            <div class="col-md-12">
                                <h4 class="row-title">E-mail</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E-mails</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Separe os e-mails usando ;" name="form4_email" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group mb-3">
                                    <input type="button" class="btn btn-primary" id="enviarEmailEspelhamento" value="Enviar E-mail">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3 text-right">
                        <button type="submit" class="btn btn-success text-white" id="botao-atualizar-processo">Salvar / Continuar</button>
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