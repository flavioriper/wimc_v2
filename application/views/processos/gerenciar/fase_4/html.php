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
        <input id="tab4" type="radio" onClick="changeTab(3)" name="tabs" <?=($fase == 3)?'checked':''?>><label for="tab4" class="<?=($processo->fase < 3 || $processo->fase_espelhamento != 1)?'none':''?> label_tab">Espelhamento</label>
        <input id="tab5" type="radio" onClick="changeTab(4)" name="tabs" <?=($fase == 4)?'checked':''?>><label for="tab5" class="label_tab">Retorno de equipamento</label>

        <section id="content5">
            <form id="atualizar-processo" accept-charset="utf-8">
                <input type="hidden" id="id" value="<?=$processo->id ?>">
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
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Data de Retorno</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=(isset($ultimo_retorno->data))?$ultimo_retorno->data:''?>"
                                disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Cidade</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->cidade_destino ?>"
                                disabled="disabled">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">País</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->pais_destino ?>"
                                disabled="disabled">
                        </div>
                    </div>

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
                    
                    <div class="col-md-12">
                        <h4 class="row-title">Dados Gerais</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Solicitação de Coleta</span>
                            </div>
                            <input type="date" class="form-control" id="solicitacao-coleta" 
                            value="<?=($processo->solicitacao_coleta != '' && $processo->solicitacao_coleta != '0000-00-00')?date('Y-m-d', strtotime($processo->solicitacao_coleta)):''?>">
                        </div>
                    </div>		
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Data de Retirada</span>
                            </div>
                            <input type="date" class="form-control" id="data-retirada" 
                                value="<?=($processo->data_retirada != '' && $processo->data_retirada != '0000-00-00')?date('Y-m-d', strtotime($processo->data_retirada)):''?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Operador Logístico</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Operador Logístico" id="operador-logistico"
                                value="<?=$processo->operador_logistico ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Data de Chegada</span>
                            </div>
                            <input type="date" class="form-control" id="data-chegada" 
                                value="<?=($processo->data_chegada != '' && $processo->data_chegada != '0000-00-00')?date('Y-m-d', strtotime($processo->data_chegada)):''?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Número da Remessa</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Número da Remessa" id="numero-remessa"
                                value="<?=$processo->numero_remessa ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Condições do equipamento</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Condições do equipamento" id="condicoes-equipamento"
                            value="<?=$processo->condicoes_equipamento ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">							
                            <div class="col-md-12">
                                <h4 class="row-title">Status e Localizações</h4>
                            </div>					
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Status Final (Cliente Final)</label>
                                    </div>
                                    <select class="custom-select" id="status-final">
                                        <option selected disabled>Selecione o Status</option>
                                        <option value="3" <?=($processo->status_final == 3)?'selected':''?>>Indisponível</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row">							
                            <div class="col-md-12">
                                <h4 class="row-title">Localizações</h4>
                            </div>					
                            <div class="col-md-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Localização Final</label>
                                    </div>
                                    <select class="form-control" id="localizacao-final">
                                        <option selected disabled>Selecione a Localização</option>
                                        <option value="1" <?=($processo->localizacao == 1)?'selected':''?>>WIMC - EUA</option>
                                        <option value="2" <?=($processo->localizacao == 2)?'selected':''?>>WIMC - Brasil</option>
                                        <option value="3" <?=($processo->localizacao == 3)?'selected':''?>>WIMC - Paraguay</option>
                                        <option value="4" <?=($processo->localizacao == 4)?'selected':''?>>WIMC - Israel</option>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="row-title">Eventos</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" cols="30" rows="10" id="eventos_add_text"
                                            placeholder="Digite os detalhes do evento e clique em adicionar para salvar o novo evento" name=""></textarea>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="float-right">
                                        <a role="button" class="btn btn-dark text-white ml-1" id="adicionar-eventos" style="margin: 15px 0;">Adicionar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table id="table_eventos" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50%">Eventos adicionados</th>
                                            <th scope="col" width="50%">Data</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="eventos-body-table">
                                    <?php foreach($processo_eventos4 as $evento):?>
                                        <tr>
                                            <td><?=$evento->evento?></td>
                                            <td><?=$evento->data?></td>
                                            <td>
                                                <input
                                                    type="button"
                                                    evento-id="<?=$evento->id?>"
                                                    evento="<?=$evento->evento?>"
                                                    data="<?=$evento->data?>"
                                                    class="btn btn-danger float-right text-white remove-evento"
                                                    onClick="removeEvento(this)" 
                                                    value="Remover"
                                                >
                                            </td>
                                        </tr>
                                    <?php endforeach?>
                                    </tbody>
                                </table>
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