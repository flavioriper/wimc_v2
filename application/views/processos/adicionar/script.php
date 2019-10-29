<script>
    $('#criar-processo').submit(function(ev) {
        ev.preventDefault()
        let processo = new Object()
        processo.embarcador = $('#embarcador').val()
        processo.cliente = $('#cliente').val()
        processo = JSON.stringify(processo)
        if (processo.embarcador == '') {
            $('#texto-aviso').html('Campo <strong>Embarcador</strong> obrigatório!')
            $('#modalAviso').modal()
            return
        }
        if (processo.cliente == '') {
            $('#texto-aviso').html('Campo <strong>Cliente Final</strong> obrigatório!')
            $('#modalAviso').modal()
            return
        }
        $.ajax({
            url: "<?=base_url('processos/add')?>",
            type: 'POST',
            data: {processo},
            success: function(data) {
                if (data == 'erro-500') {
                    $('#alerta-erro').removeClass('hide')
                    setTimeout(() => {
                        $('#alerta-erro').addClass('hide')
                    }, 2500)
                } else {
                    location.href = `<?=base_url('processos/gerenciar/')?>${data}`
                }
            }
        })
    })

    $(document).ready(function() {
        
    })
</script>