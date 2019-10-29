<script>
    $('#atualizar-processo').submit(function(ev) {
        ev.preventDefault()
        let processo4 = new Object()
        processo4.id = $('#id').val()
        processo4.solicitacao_coleta = $('#solicitacao-coleta').val()
        processo4.data_retirada = $('#data-retirada').val()
        processo4.operador_logistico = $('#operador-logistico').val()
        processo4.data_chegada = $('#data-chegada').val()
        processo4.numero_remessa = $('#numero-remessa').val()
        processo4.condicoes_equipamento = $('#condicoes-equipamento').val()
        processo4.status_final = $('#status-final').val()
        processo4.localizacao_final = $('#localizacao-final').val()
        processo4.eventos = montarEventos()

        processo4 = JSON.stringify(processo4)
        $.ajax({
            url: "<?=base_url('processos/update')?>",
            type: 'POST',
            data: {processo4},
            success: function(data) {
                if (data == 'sucesso-200') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                } else if (data == 'sucesso-201') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        location.href = "<?=base_url('processos/gerenciar/'.$processo->id.'/2')?>"
                    }, 2500)
                } else {
                    console.log(data)
                    $(window).scrollTop(0)
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                }
            }
        })
    })

    function changeTab(tab) {
        if (tab != '<?=$fase?>') {
            location.href = `<?=base_url('processos/gerenciar/'.$processo->id.'/')?>${tab}`
        }
    }

    function removeStatus(elemento) {
        elemento.closest('tr').remove()
    }

    function removeEvento(elemento) {
        elemento.closest('tr').remove()
    }

    function montarEventos() {
        let resposta = []
        $.each($(".remove-evento"), function() {
            let evento = new Object()
            evento.id = $(this).attr('evento-id')
            evento.evento = $(this).attr('evento')
            evento.data = $(this).attr('data')
            resposta.push(evento)
        })
        return resposta
    }

    $('#adicionar-status').click(function() {
        let status = $('#status_add_text').val()
        let nome = $("#status_add_text option:selected").text()
        $('#status-body-table').prepend(`
            <tr>
                <td>${nome}</td>
                <td>Novo</td>
                <td>
                    <input 
                        type="button" 
                        status-id="0"
                        nome="${nome}"
                        codigo="${status}"
                        data=""
                        class="btn btn-danger float-right text-white remove-status"
                        onClick="removeStatus(this)" 
                        value="Remover"
                    >
                </td>
            </tr>
        `)
    })

    $('#adicionar-eventos').click(function() {
        let evento = $('#eventos_add_text').val()
        if (evento == '') {
            return
        }
        $('#eventos-body-table').prepend(`
            <tr>
                <td>${evento}</td>
                <td>Novo</td>
                <td>
                    <input 
                        type="button"
                        evento-id="0"
                        evento="${evento}"
                        data=""
                        class="btn btn-danger float-right text-white remove-evento"
                        onClick="removeEvento(this)" 
                        value="Remover"
                    >
                </td>
            </tr>
        `)
        $('#eventos_add_text').val('')
    })

    $(document).ready(function() {
        const faseAtual = '<?=$processo->fase?>'

        if (faseAtual == 5) {
            $('#botao-atualizar-processo').prop('disabled', true)
        }
        
        $('#tabela-equipamentos').dataTable({
            "language": idioma,
            "aaSorting": [],
            "bLengthChange" : false,
            "searching": false, 
            "info": false
        })

        if ('<?=count($equipamentos_escolhidos)?>' <= 10) {
            $('.dataTables_paginate').hide()
        }
    })
</script>