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
        <input id="tab3" type="radio" onClick="changeTab(2)" name="tabs" <?=($fase == 2)?'checked':''?>><label for="tab3" class="<?=($processo->fase < 2)?'none':''?> label_tab">Acompanhamento de viagens</label>
        <input id="tab4" type="radio" onClick="changeTab(3)" name="tabs" <?=($fase == 3)?'checked':''?>><label for="tab4" class="<?=($processo->fase < 3 || $processo->fase_espelhamento != 1)?'none':''?> label_tab">Espelhamento</label>
        <input id="tab5" type="radio" onClick="changeTab(4)" name="tabs" <?=($fase == 4)?'checked':''?>><label for="tab5" class="<?=($processo->fase < 4)?'none':''?> label_tab">Retorno de equipamento</label>

        <section id="content2">
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
                    <div class="col-md-8"><br/>
                        <h4 class="row-title">Equipamentos</h4>
                    </div>
                    <div class="col-md-4">
                    <?php if ($processo->fase == 1) {?>
                        <input type="button" class="btn btn-primary" id="editar-equipamentos" value="Editar Equip.">
                    <?php }?>
                    </div>
                    <div class="col-md-12 mt-2">
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
                                    <?php if ($processo->fase == 1) {?>
                                        <input type="checkbox" 
                                            id="<?=$equipamento_escolhido->id?>" 
                                            serie="<?=$equipamento_escolhido->numero_serie?>" 
                                            envio="<?=$equipamento_escolhido->envio_id?>"
                                            class="form-control checkbox montar-equipamentos" checked
                                            <?=($processo->fase > 1) ? 'disabled' : ''?>
                                        >
                                    <?php }?>
                                    </td>
                                </tr>
                            <?php endforeach?>
                            <?php foreach($equipamentos as $equipamento_escolhido):?>
                                <tr>
                                    <td><?=$equipamento_escolhido->modelo?></td>
                                    <td><?=$equipamento_escolhido->numero_serie?></td>
                                    <td><?=$equipamento_escolhido->imei_sincard?></td>
                                    <td>
                                        <input type="checkbox" 
                                            id="<?=$equipamento_escolhido->id?>" 
                                            serie="<?=$equipamento_escolhido->numero_serie?>" 
                                            envio="<?=$equipamento_escolhido->envio_id?>"
                                            class="form-control checkbox montar-equipamentos"
                                            <?=($processo->fase > 1) ? 'disabled' : ''?>
                                        >
                                    </td>
                                </tr>
                            <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12"><br/>
                        <h4 class="row-title">Dados Gerais</h4>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Data de Uso</span>
                            </div>
                            <input type="date" class="form-control" id="data-uso" name="data_uso" value="<?=$processo->data_uso_f?>">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="embarcador">Embarcador</label>
                            </div>
                            <select class="custom-select" name="embarcador" id="embarcador" disabled>
                                <?php foreach($embarcadores as $embarcador):?>
                                   <option value="<?=$embarcador->id?>" <?=($processo->embarcador_id == $embarcador->id)?'selected':''?>><?=$embarcador->nome?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12"><br/>
                        <h4 class="row-title">Endereços</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Origem</span>
                            </div>
                            <input type="text" class="form-control" id="cidade-origem" name="form2_cidade_origem" placeholder="Cidade Origem"
                                value="<?php echo $processo->cidade_origem ?>">
                            <input type="text" class="form-control" id="pais-origem" name="form2_pais_origem" placeholder="País Origem"
                                value="<?php echo $processo->pais_origem ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Destino</span>
                            </div>
                            <input type="text" class="form-control" id="cidade-destino" name="form2_cidade_destino" placeholder="Cidade Destino"
                                value="<?php echo $processo->cidade_destino ?>">
                            <input type="text" class="form-control" id="pais-destino" name="form2_pais_destino" placeholder="País Destino"
                                value="<?php echo $processo->pais_destino ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                                <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Endereço Inicial</span>
                                    </div>
                                    <input type="text" class="form-control" id="endereco-inicial" name="form2_enderecoInicial" value="<?php echo $processo->endereco_inicial ?>" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Endereço Final</span>
                                    </div>
                                    <input type="text" class="form-control" id="endereco-final" name="form2_enderecoFinal" value="<?php echo $processo->endereco_final ?>"  >                                  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Tipo</label>
                                    </div>
                                    <select class="custom-select" id="tipo" name="form2_tipo" onchange="mostrarCampos(this)">
                                        <option value="" selected>Selecionar...</option>
                                        <option value="terrestre" <?=($processo->tipo == 'terrestre')?'selected':''?>>Terrestre</option>
                                        <option value="aereoce" <?=($processo->tipo == 'aereoce')?'selected':''?>>Aéreo</option>
                                        <option value="maritmo" <?=($processo->tipo == 'maritmo')?'selected':''?>>Marítimo</option>
                                        <option value="see-air" <?=($processo->tipo == 'see-air')?'selected':''?>>SEE-AIR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 terrestre " style="">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Embarque</span>
                                    </div>
                                    <input type="text" class="form-control" id="porto-saida" name="form2_porto_saida" placeholder="Embarque"
                                    value="<?php echo $processo->porto_saida ?>">
                                </div>
                            </div>							
                            <div class="col-md-4 terrestre " style="">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Desembarque </span>
                                    </div>
                                    <input type="text" class="form-control" id="porto-destino" placeholder="Desembarque " name="form2_porto_destino"
                                    value="<?php echo $processo->porto_destino ?>">
                                </div>
                            </div>
                            <div class="col-md-4 terrestre see-air maritmo aereoce aereose escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Transportador </span>
                                    </div>
                                    <input type="text" class="form-control" id="transportador" placeholder="Transportador " name="form2_transportador"
                                    value="<?php echo $processo->transportador ?>">
                                </div>
                            </div>
                            <div class="col-md-4 terrestre escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Placa</span>
                                    </div>
                                    <input type="text" class="form-control" id="placa" name="form2_placa" placeholder="Placa"
                                        value="<?php echo $processo->placa ?>">
                                </div>
                            </div>
                            <div class="col-md-4 terrestre see-air escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Conhecimento</span>
                                    </div>
                                    <input type="text" class="form-control" id="conhecimento" name="form2_terrestre_conhecimento" placeholder="Booking"
                                        value="<?php echo $processo->terrestre_conhecimento ?>">
                                </div>
                            </div>
                            <div class="col-md-4 terrestre escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Motorista</span>
                                    </div>
                                    <input type="text" class="form-control" id="terrestre-motorista" name="form2_terrestre_motorista" placeholder="Motorista"
                                        value="<?php echo $processo->terrestre_motorista ?>">
                                </div>
                            </div>

                            <div class="col-md-4 see-air aereoce aereose escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">AWB</span>
                                    </div>
                                    <input type="text" class="form-control" id="awb" name="form2_awb" placeholder="AWB"
                                        value="<?php echo $processo->awb ?>">
                                </div>
                            </div>
                            <div class="col-md-4 see-air aereoce aereose escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Companhia(s) Aérea(s)</span>
                                    </div>
                                    <input type="text" class="form-control" id="companhias-aereas" name="form2_companhias_aereas"
                                        placeholder="Companhia(s) Aérea(s)" value="<?php echo $processo->companhias_aereas ?>">
                                </div>
                            </div>
                            <div class="col-md-4 see-air aereoce aereose escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Vôo(s)</span>
                                    </div>
                                    <input type="text" class="form-control" id="aereo-voos" name="form2_aereo_voos"
                                        placeholder="Vôo(s)" value="<?php echo $processo->aereo_voos ?>">
                                </div>
                            </div>

                            <div class="col-md-4 maritmo see-air escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Container</span>
                                    </div>
                                    <input type="text" class="form-control" id="container" name="form2_container" placeholder="Container"
                                        value="<?php echo $processo->container ?>">
                                </div>
                            </div>
                            <div class="col-md-4 maritmo see-air escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Navio</span>
                                    </div>
                                    <input type="text" class="form-control" id="navio" name="form2_navio" placeholder="Navio"
                                        value="<?php echo $processo->navio ?>">
                                </div>
                            </div>
                            <div class="col-md-4 maritmo escCampos" style="display:none;">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Booking</span>
                                    </div>
                                    <input type="text" class="form-control" id="booking" name="form2_maritmo_booking" placeholder="Booking"
                                        value="<?php echo $processo->maritmo_booking ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="row-title">Transbordo</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Novo Porto</span>
                                            </div>
                                            <input type="text" class="form-control" id="porto_add_text" placeholder="Digite o nome Porto que deseja adicionar:"
                                                name="">
                                            <?php if ($processo->status_final != '3' || ($processo->localizacao == 0 || $processo->localizacao == null || $processo->localizacao == '')) { ?>
                                                <a role="button" class="btn btn-dark text-white ml-1" id="adicionar_porto">Adicionar</a>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" width="100%">Portos Adicionados</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="corpo-table-porto">
                                            <?php foreach(json_decode($processo->porto_transbordo) as $porto):?>
                                                <tr>
                                                    <td class="porto-transbordo"><?=$porto?></td>
                                                    <td><button type="button" class="btn btn-danger float-right text-white" onClick="removerPorto(this)">Remover</button></td>
                                                </tr>
                                            <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="row-title">Observações</h4>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" rows="10" id="observacao-viagem"  name="form2_observacaoViagem"><?php echo trim($processo->observacao_viagem); ?></textarea>
                                        </div>
                                    </div>					
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h4 class="row-title">Enviar E-mail</h4>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">E-mails</span>
                                    </div>
                                    <input type="text" class="form-control" id="emailViagem" placeholder="Separe os e-mails usando ;" name="form2_email"
                                    value="<?php echo $processo->email ?>">
                                </div>
                            </div>								
                            <div class="col-md-3">
                                <div class="float-left">
                                    <input type="button" class="btn btn-primary" id="enviarEmail" value="Enviar E-mail">
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