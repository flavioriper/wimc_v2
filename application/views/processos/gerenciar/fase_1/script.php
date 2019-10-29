<script>
    $('#atualizar-processo').submit(function(ev) {
        ev.preventDefault()
        let processo1 = new Object()
        processo1.id = $('#id').val()
        processo1.data_uso = $('#data-uso').val()
        processo1.cidade_origem = $('#cidade-origem').val()
        processo1.pais_origem = $('#pais-origem').val()
        processo1.cidade_destino = $('#cidade-destino').val()
        processo1.pais_destino = $('#pais-destino').val()
        processo1.endereco_inicial = $('#endereco-inicial').val()
        processo1.endereco_final = $('#endereco-final').val()
        processo1.tipo = $('#tipo').val()
        processo1.porto_saida = $('#porto-saida').val()
        processo1.porto_destino = $('#porto-destino').val()
        processo1.transportador = $('#transportador').val()
        processo1.placa = $('#placa').val()
        processo1.conhecimento = $('#conhecimento').val()
        processo1.terrestre_motorista = $('#terrestre-motorista').val()
        processo1.awb = $('#awb').val()
        processo1.companhias_aereas = $('#companhias-aereas').val()
        processo1.aereo_voos = $('#aereo-voos').val()
        processo1.container = $('#container').val()
        processo1.navio = $('#navio').val()
        processo1.booking = $('#booking').val()
        processo1.observacao_viagem = $('#observacao-viagem').val()
        processo1.porto_transbordo = construirPortos()
        processo1.equipamentos = montarEquipamentos()
        
        processo1 = JSON.stringify(processo1)
        $.ajax({
            url: "<?=base_url('processos/update')?>",
            type: 'POST',
            data: {processo1},
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

    function mostrarCampos(_this) {
        let campo = $(_this).val();
        $(".escCampos").css("display", "none");
        if (campo != '') {
            $("." + campo).css("display", "inline-block");
        }
    }

    function montarEquipamentos() {
        let resposta = []
        $.each($(".montar-equipamentos:checked"), function(){
            let equipamento = new Object()
            equipamento.id = $(this).attr('id')
            equipamento.numero_serie = $(this).attr('serie')
            equipamento.envio_id = $(this).attr('envio')
            resposta.push(equipamento)
        })
        return resposta
    }

    function construirPortos() {
        let lista = []
        $('.porto-transbordo').each(function() {
            let valor = $(this).text()
            lista.push(valor)
        })
        return lista
    }

    function removerPorto(elemento) {
        elemento.closest('tr').remove()
    }

    $('#adicionar_porto').click(function() {
        let porto = $("#porto_add_text").val()
        let listaPortos = construirPortos()
        if (porto != '' && !listaPortos.includes(porto)) {
            $('#corpo-table-porto').append(`
                <tr>
                    <td class="porto-transbordo">${porto}</td>
                    <td><button type="button" class="btn btn-danger float-right text-white" onClick="removerPorto(this)">Remover</button></td>
                </tr>
            `)
        }
    })

    $('#editar-equipamentos').click(function() {
        $(this).prop('disabled', true)
        $(this).prop('value', 'Editando...')
        $('.dataTables_length').show()
        $('.dataTables_filter').show()
    })

    $(document).ready(function() {
        let tipoEscolhido = $('#tipo')
        mostrarCampos(tipoEscolhido)
        const faseAtual = '<?=$processo->fase?>'

        if (faseAtual == 5) {
            $('#botao-atualizar-processo').prop('disabled', true)
            $('#tabela-equipamentos').dataTable({
                "language": idioma,
                "aaSorting": [],
                "bLengthChange" : false,
                "searching": false, 
                "info": false
            })
        } else {
            $('#tabela-equipamentos').dataTable({
                "language": idioma,
                "aaSorting": [],
                "info": false
            })
        }

        $('.dataTables_length').hide()
        $('.dataTables_filter').hide()

        if ('<?=count($equipamentos_escolhidos)?>' <= 10 && '<?=count($equipamentos)?>' <= 10) {
            $('.dataTables_paginate').hide()
        }
    })
</script>