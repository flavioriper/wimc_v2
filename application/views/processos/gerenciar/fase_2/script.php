<script>
    $('#atualizar-processo').submit(function(ev) {
        ev.preventDefault()
        let processo2 = new Object()
        processo2.id = $('#id').val()
        processo2.porto_saida = $('#porto-saida').val()
        processo2.porto_destino = $('#porto-destino').val()
        processo2.navio = $('#navio').val()
        processo2.container = $('#container').val()
        processo2.data_chegada = $('#data-chegada').val()
        processo2.status = montarStatus()
        processo2.eventos = montarEventos()
        processo2.espelhamento = montarEspelhamento()

        processo2 = JSON.stringify(processo2)
        $.ajax({
            url: "<?=base_url('processos/update')?>",
            type: 'POST',
            data: {processo2},
            success: function(data) {
                if (data == 'sucesso-200') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        location.reload()
                    }, 2000)
                } else if (data == 'sucesso-201') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        location.href = "<?=base_url('processos/gerenciar/'.$processo->id.'/4')?>"
                    }, 2000)
                } else {
                    console.log(data)
                    $(window).scrollTop(0)
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2000)
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

    function checarStatus(status) {
        let resposta = false
        $.each($(".checar-status"), function() {
            status_id = $(this).attr('codigo')
            console.log(status)
            if (status_id == status) {
                resposta = true
            }
        })
        return resposta
    }

    function montarEspelhamento() {
        let resposta = 0
        if ($("#faseEspelhamento").is(":checked")) {
            resposta = 1
            $('#tab4label').removeClass('none')
        } else {
            $('#tab4label').addClass('none')
        }
        return resposta
    }

    function montarStatus() {
        let resposta = []
        $.each($(".remove-status"), function() {
            let status = new Object()
            status.id = $(this).attr('status-id')
            status.status_id = $(this).attr('codigo')
            status.nome = $(this).attr('nome')
            status.data = $(this).attr('data')
            resposta.push(status)
        })
        return resposta
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
        let verificador = false

        if (checarStatus(status)) {
            return
        }

        let fase = '<?=$processo->fase?>'
        if (status == 4 && fase < 4) {
            $('#texto-aviso').html('')
            $('#texto-aviso').html(`
                Você está finalizando o processo antes da fase de retorno. Todos os equipamentos vinculados ficarão indisponíveis 
                e sem localização. <br><strong>Essa ação não poderá ser desfeita após salvar.</strong>
            `)
            $('#modalAviso').modal()
            return
        } else if (status == 4 && fase == 4) {
            let localizacao = '<?=$processo->localizacao?>'
            let statusProcesso = '<?=$processo->status_final?>'
            if (localizacao > 0 && statusProcesso > 0) {
                $('#texto-aviso').html('')
                $('#texto-aviso').html(`
                    Você está finalizando o processo. <br><strong>Essa ação não poderá ser desfeita após salvar.</strong>
                `)
                $('#modalAviso').modal()
            } else {
                $('#texto-aviso').html('')
                $('#texto-aviso').html(`
                    Você precisa selecionar um status e uma localização na fase de 
                        <a href="<?=base_url('processos/gerenciar/'.$processo->id.'/4')?>">Retorno de Equipamentos</a> para finalizar o processo.
                `)
                $('#modalAviso').modal()
                return
            }
        }
        $('#status-body-table').prepend(`
            <tr class="checar-status" status-id="0" nome="${nome}" codigo="${status}" data="">
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