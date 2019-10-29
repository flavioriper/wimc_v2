<script>
    let equipamentos = []

    $('#frm-envio').submit(function(ev) {
        ev.preventDefault()
        let envio = new Object()
        envio.id = $('#id').val()
        envio.embarcador = $('#embarcador').val()
        envio.referencia = $('#referencia').val()
        envio.dataEnvio = $('#data-envio').val()
        envio.dataEntrega = $('#data-entrega').val()
        envio.operador = $('#operador').val()
        envio.remessa = $('#remessa').val()
        envio.equipamentos = montarEquipamentos()
        envio = JSON.stringify(envio)
        $.ajax({
            url: "<?=base_url('embarcadores/update')?>",
            type: 'POST',
            data: {envio},
            success: function(data) {
                if (data == '200') {
                    $(window).scrollTop(0)
                    $('#alerta-sucesso').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-sucesso').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                } else {
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                        $('#enviar').prop('disabled', false)
                    }, 2500)
                }
            }
        })
    })

    function montarEquipamentos() {
        let resposta = []
        $.each($(".montar-equipamentos:checked"), function(){
            let equipamento = new Object()
            equipamento.id = $(this).attr('id')
            equipamento.numero_serie = $(this).attr('serie')
            resposta.push(equipamento)
        })
        return resposta
    }

    $(document).ready(function() {
        $('#tabela-equipamentos').dataTable({
            "language": idioma,
            "aaSorting": []
        })
    })
</script>