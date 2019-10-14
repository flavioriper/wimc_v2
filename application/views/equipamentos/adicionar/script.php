<script>
    $('#frm-equipamento').submit(function(ev) {
        ev.preventDefault()
        $('#enviar').prop('disabled', true)
        let equipamento = new Object()
        equipamento.tipo_equipamento = $('#tipo_equipamento').val()
        equipamento.numero_serie = $('#numero_serie').val()
        equipamento.fabricante = $('#fabricante').val()
        equipamento.imei_sincard = $('#imei_sincard').val()
        equipamento.atualizacao_firmware = $('#atualizacao_firmware').val()
        equipamento.localizacao = $('#localizacao').val()
        equipamento.observacoes = $('#observacoes').val()
        equipamento = JSON.stringify(equipamento)
        $.ajax({
            url: "<?=base_url('equipamentos/add')?>",
            type: 'POST',
            data: {equipamento},
            success: function(data) {
                if (data == 'erro-500') {
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                } else if (data == 'erro-505') {
                    $('#alerta-numero-serie').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-numero-serie').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                } else {
                    $('#equipamento-link').attr("href", `<?=base_url('equipamentos/gerenciar/')?>${data}`)
                    $('#alerta-sucesso').removeClass('hide')
                    $('#frm-equipamento')[0].reset()
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                }
            }
        })
    })
</script>