<script>
    $('#atualizar-processo').submit(function(ev) {
        ev.preventDefault()
        let processo3 = new Object()
        processo3.id = $('#id').val()
        processo3.espelhamento_id = $('#espelhamento-id').val()
        processo3.gerenciador = $('#gerenciador').val()
        processo3.login_rastreador = $('#login-rastreador').val()
        processo3.senha_rastreador = $('#senha-rastreador').val()
        processo3.motorista_nome = $('#motorista-nome').val()
        processo3.motorista_documento = $('#motorista-documento').val()
        processo3.motorista_caminhao = $('#motorista-caminhao').val()
        processo3.escolta = $('#escolta').val()
        processo3.transportadora = $('#transportadora').val()
        processo3.alteracao_frequencia = montarFrequencia()

        processo3 = JSON.stringify(processo3)
        $.ajax({
            url: "<?=base_url('processos/update')?>",
            type: 'POST',
            data: {processo3},
            success: function(data) {
                if (data == 'sucesso-200') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        $('#enviar').prop('disabled', false)
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

    function montarFrequencia() {
        let resposta = 0
        if ($("#alteracao-frequencia").is(':checked')) {
            resposta = 1
        }
        return resposta
    }

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