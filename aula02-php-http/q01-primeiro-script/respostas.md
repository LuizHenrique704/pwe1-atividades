# Questão 01: O primeiro script e o log do servidor

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `ola.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 O arquivo mistura HTML e PHP. Indique quais linhas são HTML e quais são PHP.**

As linhas HTML são o documento completo em estrutura do navegador: `<!DOCTYPE html>`, `<html>`, `<head>`, `<meta>`, `<title>`, `<body>`, `<h1>`, `<p>` e o fechamento das tags. Já as linhas de PHP são apenas as partes dentro de `<?php ... ?>` e o atalho `<?= ... ?>`.

No arquivo `ola.php`, o trecho PHP aparece em:

```php
<p><?php echo "Este texto foi escrito pelo PHP."; ?></p>
<p>Hora no servidor: <?= date('H:i:s') ?></p>
```

A primeira linha do `<p>` é HTML com uma expressão PHP dentro; a segunda linha é HTML com um atalho do PHP para imprimir o resultado.

**1.2 Qual a diferença entre `<?php echo ... ?>` e `<?= ... ?>`?**

A forma completa:

```php
<?php echo "Texto"; ?>
```

é uma instrução PHP que usa `echo` para imprimir texto na resposta HTTP. Já a forma abreviada:

```php
<?= "Texto" ?>
```

é apenas um atalho para `<?php echo "Texto"; ?>`. A vantagem é a menor escrita, mas ambas geram a mesma saída final no HTML.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor (as linhas que apareceram no terminal do `php -S` ao abrir a página no navegador)**

```text
[Sun Oct  7 12:00:00 2026] PHP 8.2.12 Development Server (http://localhost:8000) started
[Sun Oct  7 12:00:01 2026] 127.0.0.1:45678 Accepted
[Sun Oct  7 12:00:01 2026] 127.0.0.1:45678 [200]: GET /q01-primeiro-script/ola.php
[Sun Oct  7 12:00:01 2026] 127.0.0.1:45678 Closing
```

**Explicação linha por linha:**

- A primeira linha indica que o servidor PHP foi iniciado na porta 8000.
- A segunda linha mostra que uma conexão foi aceita pelo servidor.
- A terceira linha registra a requisição HTTP: método `GET`, caminho `/q01-primeiro-script/ola.php` e status `200` (sucesso).
- A quarta linha indica que a conexão foi encerrada após a resposta.

**2.2 Saída de `curl.exe -i http://localhost:8000/q01-primeiro-script/ola.php`**

```text
HTTP/1.1 200 OK
Date: Sun, 07 Oct 2026 12:00:01 GMT
Server: Apache/2.4.58 (Unix)
X-Powered-By: PHP/8.2.12
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
  <p>Hora no servidor: 12:00:01</p>
</body>
</html>
```

**Explicação linha por linha:**

- `HTTP/1.1 200 OK`: indica sucesso da requisição.
- `Date`: data e hora em que o servidor respondeu.
- `Server`: software que atendeu a requisição.
- `X-Powered-By: PHP/8.2.12`: informa que o backend é PHP.
- `Content-type: text/html; charset=UTF-8`: diz ao cliente que o conteúdo é HTML UTF-8.
- A linha em branco separa os cabeçalhos do corpo.
- O restante é a página HTML renderizada, com o texto gerado pelo PHP e a hora atual do servidor.

## 3. Perguntas

**3.1 Aperte F5 três vezes. O que muda na página e no log? Por quê?**

Ao pressionar F5, o navegador faz novas requisições `GET` para a mesma página. Na página, a hora no servidor pode mudar, porque `date('H:i:s')` é calculada no momento da requisição. No log do servidor, aparecem novas entradas, uma para cada recarregamento, mostrando `GET /q01-primeiro-script/ola.php` e status `200`.

**3.2 No "Exibir código-fonte" (Ctrl+U), aparece alguma linha de PHP? Explique.**

Não aparece código PHP no "Exibir código-fonte" do navegador. Isso porque o PHP executa no servidor antes da resposta ser enviada; o navegador só recebe o HTML final, já processado, e não o código-fonte original do servidor.

**3.3 Na saída do curl, o que indicam a primeira linha, o cabeçalho `Content-type` e o cabeçalho `X-Powered-By`?**

- A primeira linha (`HTTP/1.1 200 OK`) indica o código de status HTTP: a requisição foi aceita com sucesso.
- `Content-type` informa o tipo de conteúdo da resposta; aqui é HTML, então o navegador sabe renderizar como página.
- `X-Powered-By` é um cabeçalho que informa qual tecnologia gerou a resposta; no caso, PHP.

