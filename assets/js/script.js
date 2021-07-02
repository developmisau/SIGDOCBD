$(document).ready(function(){
 
//Recupera a URL atual e complementa para que seja possível
//obter os dados para montagem do gráfico
var url_data = window.location.href + "/sigdoc/dados";
//Define a variável que irá receber as tarefas a serem exibidas no gráfico
var tarefas;
//Define a variável que irá receber as opções de configuração do gráfico
var options;
 
//Requisição AJAX ao servidor para obtenção dos dados
$.ajax({
  type: 'GET',
  url: url_data,
  dataType: 'json',
  success: function(data) {
    tarefas = json2array(data.tarefas);
    options = data.opcoes;
  },
  error: function() {
    alert("Ocorreu um erro ao processar a solicitação.");
  }
});
 
//Define qual é o pacote de gráficos que será utilizado
google.charts.load('current', {'packages':['corechart']});
 
//Operações executadas ao iniciar o processamento da biblioteca
google.charts.setOnLoadCallback(function(){
  //Formata os dados para o padrão de exibição do gráfico
  data = google.visualization.arrayToDataTable(tarefas);
 
  //Estrutura o gráfico para exibição
  var chart = new google.visualization.PieChart(document.getElementById('mychart'));
 
  //Exibe o gráfico na tela
  chart.draw(data, options);
});
 
});
 
//Função para converter o json para array no padrão da biblioteca Google Charts
function json2array(json_data){
  var result = [];
  for(var i in json_data)
    result.push([i, json_data[i]]);
 
  return result;
}