<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>BD STPL</title>
	<link rel="shortcut icon" type="image/png" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script type="text/javascript" language="javascript" src="./templates/script.js?<?=rand()?>"></script>
</head>
  
    <body id="body">
        <?php date_default_timezone_set('America/Sao_Paulo');?>
        <div id="dvEscopo">
            <!-- Relógio -->
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2">
                        <a class="btn btn-primary" id="relogio">00</a>
                    </div>
                </div>
            </div>
            <!-- / Relógio -->    

            <h1>Banco de dados de GPS do STPL</h1>

            <div>
            <span>Usuário: Rio Ônibus</span><br>
            <span>Developed by: Alex Perfeito</span></br>
            <span><a id="ultAtualizacao"></a><span><br>
            </div>
            <div class="fonte mb-4">
                <a id="fonte_empresa"></a>
            </div>
        </div>
        <div id="dvTabela">
            <table id="Tabela" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>dataHora</th>
                        <th>ordem</th>
                        <th>placa</th>
                        <th>linha</th>
                        <th>trajeto</th>
                        <th>latitude</th>
                        <th>longitude</th>
                        <th>velocidade</th>
                        <th>sentido</th>
                        <th>id_migracao_trajeto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($veiculos as $key => $veiculo): ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= date("d/m/Y h:i", intval($veiculo["dataHora"])/1000) ?>h</td>
                            <td><?= $veiculo["codigo"] ?></td>
                            <td><?= $veiculo["placa"] ?></td>
                            <td><?= $veiculo["linha"] ?></td>
                            <td><?= $veiculo["trajeto"] ?></td>
                            <td><?= $veiculo["latitude"] ?></td>
                            <td><?= $veiculo["longitude"] ?></td>
                            <td><?= $veiculo["velocidade"] ?></td>
                            <td><?= $veiculo["sentido"] ?></td>
                            <td><?= $veiculo["id_migracao_trajeto"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.bootstrap5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.colVis.min.js"></script>
    <script>
    $(document).ready(function() {
        
    var table = $('#Tabela').DataTable( {
        "language": {

            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 até 0 de 0 registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "infoThousands": ".",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "zeroRecords": "Nenhum registro encontrado",
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "aria": {
                "sortAscending": ": Ordenar colunas de forma ascendente",
                "sortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "1": "Selecionado 1 linha"
                },
                "cells": {
                    "1": "1 célula selecionada",
                    "_": "%d células selecionadas"
                },
                "columns": {
                    "1": "1 coluna selecionada",
                    "_": "%d colunas selecionadas"
                }
            },
            "buttons": {
                "copySuccess": {
                    "1": "Uma linha copiada com sucesso",
                    "_": "%d linhas copiadas com sucesso"
                },
                "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
                "colvis": "Visibilidade da Coluna",
                "colvisRestore": "Restaurar Visibilidade",
                "copy": "Copiar",
                "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
                "copyTitle": "Copiar para a Área de Transferência",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todos os registros",
                    "_": "Mostrar %d registros"
                },
                "pdf": "PDF",
                "print": "Imprimir"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Preencher todas as células com",
                "fillHorizontal": "Preencher células horizontalmente",
                "fillVertical": "Preencher células verticalmente"
            },
            "lengthMenu": "Exibir _MENU_ resultados por página",
            "searchBuilder": {
                "add": "Adicionar Condição",
                "button": {
                    "0": "Construtor de Pesquisa",
                    "_": "Construtor de Pesquisa (%d)"
                },
                "clearAll": "Limpar Tudo",
                "condition": "Condição",
                "conditions": {
                    "date": {
                        "after": "Depois",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vazio",
                        "equals": "Igual",
                        "not": "Não",
                        "notBetween": "Não Entre",
                        "notEmpty": "Não Vazio"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vazio",
                        "equals": "Igual",
                        "gt": "Maior Que",
                        "gte": "Maior ou Igual a",
                        "lt": "Menor Que",
                        "lte": "Menor ou Igual a",
                        "not": "Não",
                        "notBetween": "Não Entre",
                        "notEmpty": "Não Vazio"
                    },
                    "string": {
                        "contains": "Contém",
                        "empty": "Vazio",
                        "endsWith": "Termina Com",
                        "equals": "Igual",
                        "not": "Não",
                        "notEmpty": "Não Vazio",
                        "startsWith": "Começa Com"
                    },
                    "array": {
                        "contains": "Contém",
                        "empty": "Vazio",
                        "equals": "Igual à",
                        "not": "Não",
                        "notEmpty": "Não vazio",
                        "without": "Não possui"
                    }
                },
                "data": "Data",
                "deleteTitle": "Excluir regra de filtragem",
                "logicAnd": "E",
                "logicOr": "Ou",
                "title": {
                    "0": "Construtor de Pesquisa",
                    "_": "Construtor de Pesquisa (%d)"
                },
                "value": "Valor",
                "leftTitle": "Critérios Externos",
                "rightTitle": "Critérios Internos"
            },
            "searchPanes": {
                "clearMessage": "Limpar Tudo",
                "collapse": {
                    "0": "Painéis de Pesquisa",
                    "_": "Painéis de Pesquisa (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Nenhum Painel de Pesquisa",
                "loadMessage": "Carregando Painéis de Pesquisa...",
                "title": "Filtros Ativos"
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Próximo",
                "hours": "Hora",
                "minutes": "Minuto",
                "seconds": "Segundo",
                "amPm": [
                    "am",
                    "pm"
                ],
                "unknown": "-",
                "months": {
                    "0": "Janeiro",
                    "1": "Fevereiro",
                    "10": "Novembro",
                    "11": "Dezembro",
                    "2": "Março",
                    "3": "Abril",
                    "4": "Maio",
                    "5": "Junho",
                    "6": "Julho",
                    "7": "Agosto",
                    "8": "Setembro",
                    "9": "Outubro"
                },
                "weekdays": [
                    "Domingo",
                    "Segunda-feira",
                    "Terça-feira",
                    "Quarta-feira",
                    "Quinte-feira",
                    "Sexta-feira",
                    "Sábado"
                ]
            },
            "editor": {
                "close": "Fechar",
                "create": {
                    "button": "Novo",
                    "submit": "Criar",
                    "title": "Criar novo registro"
                },
                "edit": {
                    "button": "Editar",
                    "submit": "Atualizar",
                    "title": "Editar registro"
                },
                "error": {
                    "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
                },
                "multi": {
                    "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
                    "restore": "Desfazer alterações",
                    "title": "Multiplos valores",
                    "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
                },
                "remove": {
                    "button": "Remover",
                    "confirm": {
                        "_": "Tem certeza que quer deletar %d linhas?",
                        "1": "Tem certeza que quer deletar 1 linha?"
                    },
                    "submit": "Remover",
                    "title": "Remover registro"
                }
            },
            "decimal": ","

        },
        pageLength: 20,
        responsive: true,
        lengthChange: false,
        pagination: false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
 
    table.buttons().container()
        .appendTo( '#Tabela_wrapper .col-md-6:eq(0)' );
});



</script>
</body>
</html>