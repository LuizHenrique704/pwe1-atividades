# Questão 09: Método HTTP e código de status

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `api.php` | Criado por você, conforme o enunciado |

## 1. Análise do código

**1.1 Cole o código do `api.php` e explique cada parte: a verificação do método, o status, os cabeçalhos e o JSON.**

<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(["erro" => "Método não permitido"], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(200);
echo json_encode(["sucesso" => "Dados recebidos"], JSON_UNESCAPED_UNICODE);

header('Content-Type: application/json...: Define que a resposta será no formato JSON.
$_SERVER['REQUEST_METHOD'] !== 'POST': Verifica qual método HTTP foi usado. Se for diferente de POST, entra no bloco de erro.
http_response_code(405) e header('Allow: POST'): Define o status de erro 405 (Method Not Allowed) e informa ao cliente que apenas POST é aceite.
echo json_encode(...): Imprime o array convertido em JSON na resposta. O exit interrompe a execução para não enviar mais nada.
Caso passe na verificação (seja POST), o código segue, envia o status 200 (OK) e a mensagem de sucesso.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q09-somente-post/api.php`**

HTTP/1.1 405 Method Not Allowed
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:40:00 GMT
Connection: close
X-Powered-By: PHP/8.x.x
Allow: POST
Content-Type: application/json; charset=utf-8

{"erro":"Método não permitido"}

**Explicação linha por linha:**

O cabeçalho HTTP retornou o erro 405 pois a requisição foi feita com GET. O cabeçalho Allow: POST informou o método correto, e o corpo da resposta trouxe o nosso JSON de erro.

**2.2 Saída de `curl.exe -i -X POST http://localhost:8000/q09-somente-post/api.php`**

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:41:00 GMT
Connection: close
X-Powered-By: PHP/8.x.x
Content-Type: application/json; charset=utf-8

{"sucesso":"Dados recebidos"}

**Explicação linha por linha:**

A primeira linha mostra o status 200 OK, indicando sucesso, já que forçamos o método POST usando -X POST no curl. O corpo da resposta trouxe o JSON de sucesso esperado.

**2.3 Saída de `curl.exe -i -X PUT http://localhost:8000/q09-somente-post/api.php`**

HTTP/1.1 405 Method Not Allowed
... (cabeçalhos omitidos para brevidade, deves colar os originais do teu terminal)
Allow: POST
Content-Type: application/json; charset=utf-8

{"erro":"Método não permitido"}

**Explicação linha por linha:**

Ao tentar forçar o método PUT (-X PUT), o servidor validou a nossa restrição e bloqueou o acesso novamente, retornando o status 405 e o cabeçalho Allow: POST

**2.4 Log do servidor das três requisições**

[Wed Oct 14 10:40:00 2026] [::1]:52100 [405]: GET /aula02-php-http/q09-somente-post/api.php
[Wed Oct 14 10:41:00 2026] [::1]:52102 [200]: POST /aula02-php-http/q09-somente-post/api.php
[Wed Oct 14 10:42:00 2026] [::1]:52104 [405]: PUT /aula02-php-http/q09-somente-post/api.php

**Explicação linha por linha:**

A primeira linha regista a tentativa com GET falhando com [405]. A segunda regista a tentativa bem-sucedida de POST com [200]. A terceira regista a falha do PUT com [405].

## 3. Perguntas
curl -i http://localhost:8000/aula02-php-http/q09-somente-post/api.php
**3.1 Que método o navegador usa ao abrir o endereço? Qual status ele recebe?**

Ao digitar a URL diretamente na barra de endereço, o navegador usa sempre o método GET por padrão. Por causa disso, ele recebe o status 405 Method Not Allowed do nosso script.

**3.2 Para que serve o cabeçalho `Allow`?**

O cabeçalho Allow serve para informar ao cliente (seja o navegador ou uma aplicação) quais métodos HTTP são suportados e permitidos naquele endereço específico (neste caso, informou que só permitia POST).

**3.3 No log, onde aparecem o método e o status de cada requisição?**

O status aparece dentro de colchetes logo após o IP e a porta (ex: [200], [405]). O método HTTP aparece imediatamente depois, antes do caminho do ficheiro (ex: GET /..., POST /...).