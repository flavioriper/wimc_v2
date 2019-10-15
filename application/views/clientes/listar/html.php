<h1 class="header">Clientes <small class="text-muted">Gerenciamento de clientes</small></h1>
<hr>

<div class="row">
    <div class="col-12">
        <table class="table-striped" id="tabela-clientes">
            <thead class="thead-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Nickname</th>
                    <th>Cidade</th>
                    <th>País</th>
                    <th>Embarcador</th>
                    <th>Prospect</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($clientes as $cliente) {?>
                <tr>
                    <td><?=$cliente->nome?></td>
                    <td><?=$cliente->nickname?></td>
                    <td><?=$cliente->cidade?></td>
                    <td><?=$cliente->uf?></td>
                    <td><?=($cliente->embarcador == 1) ? 'Sim' : 'Não'?></td>
                    <td><?=($cliente->prospect == 'Y') ? 'Sim' : 'Não'?></td>
                    <td>
                        <a role="button" href="<?=base_url('clientes/gerenciar/'.$cliente->id)?>" class="form-contol btn btn-info">Alterar</a>
                    </td>
                    <td>
                        <a role="button" class="btn btn-danger" onClick="deletarCliente('<?=$cliente->id?>')" style="color:white;">Excluir</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="deletarCliente" tabindex="-1" role="dialog" aria-labelledby="deletarClienteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletarClienteLabel">Atenção!</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Deseja realmente excluir este cliente?
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="confirmar-exclusao" type="button">Excluir</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>