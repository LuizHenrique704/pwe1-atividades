# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrija no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

O erro é de sintaxe: faltou o ponto e vírgula depois da atribuição da variável `$curso`.

```php
$curso = "ADS"
echo "Bem-vindo ao curso de $curso";
```

A linha 2 é a instrução que termina sem `;`, e o parser do PHP interpreta que a próxima instrução `echo` pertence à mesma linha. Por isso ele reporta o erro como se o problema estivesse na linha 3, porque o compilador só consegue enxergar a quebra semântica quando tenta ler a instrução seguinte.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

```text
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47753 Accepted
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47753 [200]: GET /q02-erros/erro.php
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47753 Closing
```

**Explicação linha por linha:**

- A primeira linha mostra que o servidor aceitou a conexão.
- A segunda linha registra a requisição HTTP com `GET` para o arquivo e status `200` no log do servidor.
- A terceira linha fecha a conexão após atender a requisição.

Mesmo com erro do PHP, em ambiente de desenvolvimento o servidor costuma registrar a requisição como `200` porque a página foi entregue com a mensagem de erro em HTML.

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

```text
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47754 Accepted
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47754 [500]: GET /q02-erros/erro.php
[Wed Oct  7 19:14:50 2026] 127.0.0.1:47754 Closing
```

**Explicação linha por linha:**

- O servidor recebeu uma nova requisição.
- O código gerou erro fatal e o servidor passou a responder com `500 Internal Server Error`.
- O status `500` significa que o servidor falhou ao processar a requisição, e isso é o correto do ponto de vista do HTTP.

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

A mensagem aponta para a linha 3, porque o parser lê a instrução `echo` como se estivesse em continuidade da instrução anterior e só percebe a sintaxe inválida ao chegar ao início do próximo token. A falta do `;` está na linha 2, mas o erro é diagnosticado quando o PHP tenta processar o próximo comando e encontra um `echo` inesperado.

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

Com `display_errors=1`, o PHP mostra o erro diretamente no HTML da resposta e, no ambiente de desenvolvimento, o servidor pode registrar `200` porque a requisição foi tratada e a página foi devolvida com o texto do erro. Com `display_errors=0`, o erro é ocultado do cliente e o servidor responde com status `500`, que é o código correto para falha interna do servidor ao processar a página.

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

Código corrigido:

```php
<?php
$curso = "ADS";
echo "Bem-vindo ao curso de $curso";
```

Saída do `curl -i`:

```text
HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 07 Oct 2026 19:15:00 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

Bem-vindo ao curso de ADS
```

O status `200 OK` indica que a página foi gerada corretamente e que a requisição chegou a bom termo.

