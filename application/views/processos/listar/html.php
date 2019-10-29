<h1 class="header">Processos <small class="text-muted">Lista de Abertura de viagens</small></h1>
<hr>

<div class="row">
    <div class="col-12">
        <table class="table-striped" id="tabela-envios">
            <thead class="thead-dark">
                <tr>
                    <th>Nº Processo</th>
                    <th>Cliente</th>
                    <th>Série do(s) equipamento(s)</th>
                    <th>Data de Uso</th>
                    <th>Placa - AWB - Navio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($processos as $processo) {?>
                <tr>
                    <td><a href="<?=base_url('processos/gerenciar/'.$processo->id)?>"><?=$processo->id?></a></td>
                    <td><?=$processo->cliente_nome?></td>
                    <td>
                    <?php foreach($processo->equipamentos as $equipamento):
                        echo $equipamento->numero_serie.'<br>';
                    endforeach ?>
                    </td>
                    <td><?=($processo->data_uso != '0000-00-00' && $processo->data_uso != '')? date('d/m/Y', strtotime($processo->data_uso)):''?></td>
                    <td>
                    <?php
                        if ($processo->tipo == 'terrestre') {
                            echo $processo->placa;
                        } else if ($processo->tipo == 'aereoce' || $processo->tipo == 'see-air') {
                            echo $processo->awb;
                        } else if ($processo->tipo == 'maritmo' || $processo->tipo == 'see-air') {
                            echo $processo->navio;
                        }
                    ?>
                    </td>
                    <td>
                        <a role="button" href="<?=base_url('processos/gerenciar/'.$processo->id)?>" class="form-contol btn btn-info">Alterar</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>