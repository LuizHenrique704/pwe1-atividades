# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**

Linha 9: As tags <p> e </p> são HTML, enquanto a instrução <?php echo "Este texto foi escrito pelo PHP."; ?> é PHP.

Linha 10: O trecho <p>Hora no servidor:  e </p> são HTML, mas a instrução <?= date('H:i:s') ?> é executada pelo PHP."

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**

A tag <?php echo ... ?> é a forma padrão de abrir o bloco PHP e usar o comando echo para imprimir um valor na tela. Já a tag <?= ... ?> é uma versão abreviada (short echo tag) que faz exatamente a mesma coisa de forma mais curta, substituindo o 'php echo' por um simples sinal de '='. Ambas geram o mesmo resultado, mas a segunda é mais prática para inserir variáveis no meio do HTML.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor (as linhas que apareceram no terminal do `php -S` ao abrir a página no navegador)**

[Tue Oct 13 17:11:29 2026] PHP 8.5.10 Development Server (http://localhost:8000) started
[Tue Oct 13 18:13:26 2026] [::1]:58940 Accepted
[Tue Oct 13 18:13:26 2026] [::1]:58940 [200]: GET /q01-primeiro-script/ola.php
[Tue Oct 13 18:13:26 2026] [::1]:58940 Closing

**Explicação linha por linha:**

[Tue Oct 13 17:11:29 2026] PHP 8.5.10 Development Server ... started: Confirma que o servidor ligou com sucesso. Mostra a data/hora exata da inicialização e a versão do PHP que você está usando (8.5.10).

[Tue Oct 13 18:13:26 2026] [::1]:58940 Accepted: O servidor detectou e aceitou uma nova conexão. O código [::1] é o endereço IP do seu próprio computador (localhost em formato IPv6), e 58940 é uma porta temporária que o seu navegador usou para fazer a conexão.

[Tue Oct 13 18:13:26 2026] [::1]:58940 [200]: GET /q01-primeiro-script/ola.php: Esta é a requisição principal. O navegador pediu para ler o arquivo (GET /q01-primeiro-script/ola.php). O número [200] é o código de status HTTP que significa "OK", ou seja, o servidor encontrou o arquivo e processou o pedido com sucesso.

[Tue Oct 13 18:13:26 2026] [::1]:58940 Closing: O servidor terminou de enviar o HTML gerado para o navegador e encerrou (fechou) essa conexão específica, pois o trabalho foi concluído.

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

HTTP/1.1 200 OK
Host: localhost:8000
Date: Tue, 13 Oct 2026 21:20:31 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Questão 01</title>
</head>
<body>
  <h1>Olá, turma!</h1>
  <p>Este texto foi escrito pelo PHP.</p>
  <p>Hora no servidor: 21:20:31</p>
</body>
</html>


**Explicação linha por linha:**

HTTP/1.1 200 OK: É a primeira linha da resposta. Indica que foi usado o protocolo HTTP na versão 1.1 e que o pedido foi bem-sucedido (código de status 200 OK).

Host: localhost:8000: Indica o endereço do servidor que processou e respondeu à requisição.

Date: Tue, 13 Oct 2026 21:20:31 GMT: A data e a hora exatas (no fuso horário GMT) em que o servidor gerou essa resposta.

Connection: close: Avisa ao cliente (o curl, neste caso) que a conexão de rede será encerrada assim que a transmissão desses dados terminar.

X-Powered-By: PHP/8.5.10: Um cabeçalho que o servidor envia para mostrar qual tecnologia e versão foram usadas nos bastidores para gerar o conteúdo.

Content-type: text/html; charset=UTF-8: Diz ao cliente o tipo de arquivo que está sendo enviado (um documento HTML em texto) e a codificação de caracteres (UTF-8, que suporta acentuação).

<!DOCTYPE html> ... </html>: É o corpo da resposta. Repare que as tags <?php ?> sumiram, e no lugar delas estão apenas o texto puro e a hora exata calculada pelo servidor.

## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

Na página, o horário exibido na tela é atualizado a cada F5. No log do terminal, aparecem três novas linhas registrando requisições GET aceitas com status [200]. Isso acontece porque, a cada atualização (F5), o navegador faz um novo pedido. O servidor processa o arquivo ola.php novamente desde o início, capturando a nova hora atual do sistema e enviando o HTML atualizado.

**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não aparece nenhum código PHP. Isso ocorre porque o PHP é uma linguagem Server-Side (lado do servidor). O servidor executa o código PHP, transforma os resultados em texto (HTML) e envia apenas esse resultado final pela rede. O navegador (cliente) nunca recebe as tags <?php ... ?>, apenas o que elas imprimiram

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**

Primeira linha (HTTP/1.1 200 OK): Indica o protocolo usado e confirma que a requisição teve sucesso (Status 200).

Content-type: Avisa ao navegador qual é o formato do arquivo recebido (neste caso, text/html), para que ele saiba como renderizar a tela.

X-Powered-By: É uma informação dos bastidores que revela qual tecnologia rodou no servidor para gerar aquela página (aqui, o PHP 8.5.10).
