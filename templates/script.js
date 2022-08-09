
	const SIXTH = 60;
	let cont = SIXTH;
	
	
	function relogio(){
		cont = cont - 1;
		if (cont<10){cont = '0' + cont}
		document.getElementById("relogio").innerHTML = cont;
		if(cont <= 1) {
			cont = SIXTH;
		}
	}
	function dvTabela()
	{
		document.getElementById("dvTabela").style.width = (window.innerWidth) + "px";
		document.getElementById("dvTabela").style.height = (window.innerHeight) + "px";
	}
	function alimentarRelatorio()
	{
		url = (".");
		
		var respPost = callApi(url, 'POST');

		Promise.resolve(respPost).then(function(g) {
			console.log(g.message);
		});
	}
	function coletarDados()
	{
		dvTabela();
		tabela = [];
		data = new Date();
		formatoData(data);
		//hoje = dia + '' + mes + '' + ano;
		name = 'Api Stpl Riocard ' + ano.toString() + mes.toString() + dia.toString() + hora.toString() + min.toString() + seg.toString() + '.csv';
		
		document.getElementById("ultAtualizacao").innerHTML = "Última atualização: " + dia + "/" + mes + "/" + ano + " " + hora + ":" + min + ":" + seg;;
		document.getElementById("fonte_empresa").innerHTML = "Fonte: Riocard";
		
		url = ("./?format=json");
		
		var respGet = callApi(url, 'GET');
		
		Promise.resolve(respGet).then(function(g) {
			array = g.veiculos;
			dados = [];
			d = 0;
			for (ws = 0; ws < array.length; ws++)
			{
				formatoData(new Date(parseInt(array[ws].dataHora))); //GMT-03:00 (new Date em javascript já coloca em GMT-03:00)//
				//if ((dia + '' + mes + '' + ano) == hoje){
					array_novo = [];
					array_novo[0] = dia + '-' + mes + '-' + ano + ' ' + hora + ':' + min + ':' + seg;
					array_novo[1] = array[ws].codigo;
					array_novo[2] = array[ws].placa;
					array_novo[3] = array[ws].linha;
					array_novo[4] = array[ws].trajeto;
					array_novo[5] = array[ws].latitude;
					array_novo[6] = array[ws].longitude;
					array_novo[7] = array[ws].velocidade;
					array_novo[8] = array[ws].sentido;
					array_novo[9] = array[ws].id_migracao_trajeto;
					dados[d] = array_novo;
					d = d + 1;
				//}
			}
			dados.sort();
			if (dados==null){
				alert(" Desculpe! Não encontramos dados de GPS =( ");
			} else {
				for (x = 0; x < Object.keys(dados).length; x++)
				{
					i = (Object.keys(dados).length - 1) - x;
					tabela[x+1] = '<tr>' +
								  '<td value="">' + (x+1) + '</td>' +
								  '<td value="">' + dados[i][0] + '</td>' +
								  '<td value="">' + dados[i][1] + '</td>' +
								  '<td value="">' + dados[i][2] + '</td>' +
								  '<td value="">' + dados[i][3] + '</td>' +
								  '<td value="">' + dados[i][4] + '</td>' +
								  '<td value="">' + dados[i][5] + '</td>' +
								  '<td value="">' + dados[i][6] + '</td>' +
								  '<td value="">' + dados[i][7] + '</td>' +
								  '<td value="">' + dados[i][8] + '</td>' +
								  '<td value="">' + dados[i][9] + '</td>' +
								  '</tr>';
				}
				tabela[0] = '<tr>' +
							'<th>id</th>' +
							'<th>dataHora</th>' +
							'<th>ordem</th>' +
							'<th>placa</th>' +
							'<th>linha</th>' +
							'<th>trajeto</th>' +
							'<th>latitude</th>' +
							'<th>longitude</th>' + 
							'<th>velocidade</th>' +
							'<th>sentido</th>' +
							'<th>id_migracao_trajeto</th>' +
							'</tr>';
			}
			document.getElementById("Tabela").innerHTML = tabela.join("");
			
			//if (data.getHours() > 19 || data.getHours() < 9){
			//if (data.getDate() > 20 && data.getDate() < 28){
				formatoData(new Date())
				if (hora + ':' + min == '23:59'){
					CSV(name, data);
				}
			//}
			cont = 60;
		});
	}
	async function callApi(url, method)
	{
		try {
			const response = await fetch(url, {
				method: method,
				headers: {
					"Content-Type": "application/json",
				}
			});

			return await response.json();
		} catch (error) {
			console.log("Erro: ", error);
			return error;
		}
	}

	function formatoData(data){
		//hora atual do sistema//
		if (data.getHours() < 10){
			hora = '0' + data.getHours();
		}else{
			hora = data.getHours();
		}
		//minuto atual do sistema//
		if (data.getMinutes() < 10){
			min = '0' + data.getMinutes();
		}else{
			min = data.getMinutes();
		}
		//segundo atual do sistema//
		if (data.getSeconds() < 10){
			seg = '0' + data.getSeconds();
		}else{
			seg = data.getSeconds();
		}
		//mes atual do sistema//
		if (data.getMonth() < 9){
			mes = '0' + (data.getMonth()+1);
		}else{
			mes = (data.getMonth()+1);
		}
		//dia atual do sistema//
		if (data.getDate() < 10){
			dia = '0' + data.getDate();
		}else{
			dia = data.getDate();
		}
		//ano atual do sistema//
		ano = data.getFullYear();

		return dia, mes, ano, hora, min, seg;
	}
	function CSV(name, data){
		var td = '<td value="">';
		var tabelaCSV = [];
		
		for (var x = 0; x < tabela.length; x++){
			linhaINI = replaceAll(tabela[x], "<tr>", "");
			linhaFIM = replaceAll(linhaINI, "</tr>", "");
			
			if(x==0){
				colunaINI = replaceAll(linhaFIM, "<th>", "");
				colunaFIM = replaceAll(colunaINI, "</th>", ",");
				colunaFIM = colunaFIM + "timestamp_captura,";
			} else {
				colunaINI = replaceAll(linhaFIM, td, "");
				colunaFIM = replaceAll(colunaINI, "</td>", ",");
				colunaFIM = colunaFIM + data + ",";
			}
		
			tabelaCSV[x] = colunaFIM;
		}		
		exportToCsv(name, tabelaCSV);
	}
	function replaceAll(string, token, newtoken) {
		while (string.indexOf(token) != -1) {
			string = string.replace(token, newtoken);
		}
		return string;
	}
	function exportToCsv(filename, rows) {
        var processRow = function (row) {
            var finalVal = '';
            for (var j = 0; j < row.length; j++) {
                var innerValue = row[j] === null ? '' : row[j].toString();
                if (row[j] instanceof Date) {
                    innerValue = row[j].toLocaleString();
                };
                var result = innerValue.replace(/"/g, '""');
                finalVal += result;
            }
            return finalVal + '\n';
        };

        var csvFile = '';
        for (var i = 0; i < rows.length; i++) {
            csvFile += processRow(rows[i]);
        }

        var universalBOM = "\uFEFF";
		var blob = new Blob([csvFile]);
        if (navigator.msSaveBlob) {
            navigator.msSaveBlob(blob, filename);
        } else {
            var link = document.createElement("a");
            if (link.download !== undefined) {
                var url = URL.createObjectURL(blob);
                link.setAttribute("href", url);
				link.setAttribute('href', 'data:text/csv; charset=utf-8,' + encodeURIComponent(universalBOM + csvFile));
                link.setAttribute("download", filename);
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    }
	function refresh(){
		//Atualizando a pagina//
		hora_refresh = ('0:0,6:0,12:0,18:0').split(",");
		for (r = 0; r < hora_refresh.length; r++){
			if (new Date().getHours() + ':' + new Date().getMinutes() == hora_refresh[r]){
				document.location.reload(true);
				break;
			}
		}
	}
	window.addEventListener('load', function() {dvTabela(); /*coletarDados();*/ relogio();});
	setInterval(function(){dvTabela(); refresh(); /*alimentarRelatorio(); coletarDados();*/}, 60000);
	setInterval(function(){relogio();}, 1000);
