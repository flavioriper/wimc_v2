<script>
    $(document).ready(function() {
        $('#tabela-clientes').dataTable({
            "language": idioma
        })
    })

    function deletarCliente(id) {
        $('#deletarCliente').modal()
        $("#confirmar-exclusao").click(function() {
            $.ajax({
                url: '<?=base_url('clientes/excluir')?>',
                type: 'POST',
                data: { id },
                success: function(data) {
                    if (data != '') {
                        alert('Ocorreu um erro, contate o administrador')
                    }
                    location.reload()
                }
            })
        })
    }
</script>