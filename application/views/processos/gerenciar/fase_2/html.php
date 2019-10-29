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
        <input id="tab4" type="radio" onClick="changeTab(3)" name="tabs" <?=($fase == 3)?'checked':''?>><label for="tab4" id="tab4label" class="<?=($processo->fase < 3 || $processo->fase_espelhamento != 1)?'none':''?> label_tab">Espelhamento</label>
        <input id="tab5" type="radio" onClick="changeTab(4)" name="tabs" <?=($fase == 4)?'checked':''?>><label for="tab5" class="<?=($processo->fase < 4)?'none':''?> label_tab">Retorno de equipamento</label>

        <section id="content3">
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
                                <span class="input-group-text">Placa</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->placa?>"
                                disabled="disabled">
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">AWB</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->awb?>"
                                disabled="disabled">
                        </div>
                    </div>
    
                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Container</span>
                            </div>
                            <input type="text" class="form-control ref_env" value="<?=$processo->container?>"
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

                    
                    <div class="col-md-10">
                        <h4 class="row-title">Dados Gerais</h4>
                    </div>
                    <div class="col-md-2">
                        <label>Espelhamento
                        <input 
                            type="checkbox" 
                            class="form-control" 
                            id="faseEspelhamento" 
                            name="form2_faseEspelhamento" 
                            <?=($processo->fase_espelhamento == 1)?'checked':''?> 
                            value="1"
                        >
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Porto de Saida</span>
                            </div>
                            <input type="text" class="form-control" id="porto-saida" placeholder="Porto de Saída"
                            value="<?=$processo->porto_saida?>">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Porto de Destino</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Porto de Destino" id="porto-destino"
                                value="<?php echo $processo->porto_destino ?>">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nome do Navio</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nome do Navio" id="navio"
                                value="<?=$processo->navio?>">
                                
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nº do Container</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nº do Container" id="container" value="<?=$processo->container ?>">
                                
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Data Estim. de Chegada</span>
                            </div>
                            <input type="date" class="form-control" placeholder="Data Estimada de Chegada" id="data-chegada" 
                            value="<?=($processo->data_chegada_f != '' && $processo->data_chegada_f != '0000-00-00')?date('Y-m-d', strtotime($processo->data_chegada_f)):''?>">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="row-title">Status</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Novo Status:</span>
                                    </div>
                                        <select id="status_add_text" name="status_add" class="form-control">
                                            <option value="1">Pré Viagem</option>
                                            <option value="2">Em Viagem</option>
                                            <option value="3">Atenção Requerida</option>
                                            <option value="4">Finalizado</option>
                                            <option value="5" <?=(check_status($processo_status))?'':'disabled'?>>Retorno de Equipamento</option>
                                            <option value="6">Viagem Encerrada</option>
                                        </select>
                                    <a role="button" class="btn btn-dark text-white ml-1" id="adicionar-status">Adicionar</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table id="table_status" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50%">Status adicionados</th>
                                            <th scope="col" width="50%">Data</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="status-body-table">
                                    <?php foreach($processo_status as $status):?>
                                        <tr class="checar-status" status-id="<?=$status->id?>" nome="<?=$status->nome?>" codigo="<?=$status->status_id?>" data="<?=$status->data?>">
                                            <td><?=$status->nome?></td>
                                            <td><?=$status->data?></td>
                                            <td>
                                            <?php if ($status->status_id != 4 && $status->status_id != 5 && $status->status_id != 6){?>
                                                <input 
                                                    type="button"
                                                    status-id="<?=$status->id?>"
                                                    nome="<?=$status->nome?>"
                                                    codigo="<?=$status->status_id?>"
                                                    data="<?=$status->data?>"
                                                    class="btn btn-danger float-right text-white remove-status"
                                                    onClick="removeStatus(this)" 
                                                    value="Remover"
                                                >
                                            <?php }?>
                                            </td>
                                        </tr>
                                    <?php endforeach?>
                                    </tbody>
                                </table>
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
                                    <?php foreach($processo_eventos as $evento):?>
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