<?php 

$início = date("m-d-Y", strtotime("-7 days")); // data de hj -7 dias
$fim = date("m-d-Y"); // fim dia de hoje 

 $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $início .'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

 // pq aspas simples ? pq se usar aspas duplas dentro do php é interpulação os $ vai procurar uma variavel 

$dados = json_decode(file_get_contents($url), true);
// função  para tratar dados em formato json
//var_dump($dados);
$cotação = $dados["value"][0]["cotacaoCompra"];

echo "A cotação foi $cotação";

?>
</pre>