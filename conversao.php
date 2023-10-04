<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESAFIO PHP</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <main>
         <h1>Conversor de moedas V02.0 </h1> <! titulo da página -> 
            <?php  

            // cotação vinda da IPI do banco central
            $início = date("m-d-Y", strtotime("-7 days")); // data de hj -7 dias
            $fim = date("m-d-Y"); // fim dia de hoje 

            $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''. $início .'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';

            // pq aspas simples ? pq se usar aspas duplas dentro do php é interpulação os $ vai procurar uma variavel 

            $dados = json_decode(file_get_contents($url), true);
            // função  para tratar dados em formato json
            //var_dump($dados);
            $cotação = $dados["value"][0]["cotacaoCompra"];

            // Quanto $s você tem ?

            $real = $_REQUEST["din"] ?? 0; // se n informar o valor retorna zero

            // Equivalente em dolar 
            $dólar = $real / $cotação;
            // Mostrar o Resultdo 
            // o $ pode ser interpulação >> nome de váriavel usasse o \ contra barra 
            // com conquatenado
            // number_format() para formatar em duas casas decimais
            //echo "Seus R\$". number_format($real, 2 ,"," , ".") . "Equivale a US\$". number_format($dólar, 2, ",", ".");
            //formatação de moedas com internacionalização
            // numfmt_create("pt_BR" que número eu quero formatar , NumverFormatter:: CURRENCY); [CURRENCY atributo interno em forma de constannte]
            // cuidado com sintaxe 
            //  BIBLIOTECA intl (internacional php)

            $padrão = numfmt_create("pt_BR", NumberFormatter::CURRENCY); 
            // TUDO QUE EU COLOCAR AQUI QUE USAR ESSE PADRÃO DE NÚMERO APRESENTADO PRA QUEM TEM IDIOMA PORTUGUES BRASIL 
            echo "<p>Seus " . numfmt_format_currency($padrão, $real, "BRL") . 
            "  Equivalem a <strong> " . numfmt_format_currency($padrão, $dólar, "USD")."</strong></p>";   
            //currency = valor monetario // o padrão que eu quero formatar // qual é a moeda // cigla internacional 
            ?>
            <button onclick="javascript:history.go(-1)">Voltar</button> <! butão para voltar uma página -> 
    </main> 
</body>
</html>