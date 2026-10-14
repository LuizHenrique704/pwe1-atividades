# Questão 10: Cookies e a ordem da resposta HTTP

**Nível:** 🔴 Avançado

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `contador.php` | Parte A: criado por você |
| `login.php` | Parte B: código fornecido com erro (corrija no item 1.2) |
| `dashboard.php` | Parte B: criado por você |
| `prints/cookies-application.png` | DevTools, aba Application > Cookies, mostrando o cookie do contador |

> O arquivo `cookies.txt` criado pelo curl **não** deve ser enviado ao GitHub (ele já está no `.gitignore`).

## 1. Análise do código

**1.1 **Parte A:** cole o código do `contador.php` e explique como ele lê e grava o cookie.**

<?php
$visitas = (int)($_COOKIE['visitas'] ?? 0) + 1;
setcookie("visitas", (string)$visitas, time() + 3600);

echo "Você visitou esta página $visitas vez(es)";

O código lê a superglobal `$_COOKIE['visitas']`. Se o cookie ainda não existir, usa `0` como valor padrão e soma `1`. A função `setcookie()` envia um cabeçalho HTTP instruindo o navegador a armazenar o cookie `visitas` com validade de 1 hora (`time() + 3600`). Por fim, exibe o número de visitas na tela.

**1.2 **Parte B:** cole o `login.php` corrigido e o `dashboard.php`, e explique a correção.**

<?php
setcookie("usuario_logado", "true", time() + 3600);
header("Location: dashboard.php");
exit;

<?php
$usuario = $_COOKIE['usuario_logado'] ?? "não";
echo "Usuário logado: " . htmlspecialchars($usuario);

No código original do login.php, existia um echo "Carregando a página..."; antes de setcookie() e header(). Como a função echo envia o corpo da resposta HTTP, os cabeçalhos terminam de ser enviados e travam. Ao remover a saída de texto prévia, os cabeçalhos Set-Cookie e Location podem ser definidos corretamente antes da transmissão do corpo.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Parte A:** saída de `curl.exe -i http://localhost:8000/q10-cookies/contador.php`**

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:50:00 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Set-Cookie: visitas=1; expires=Wed, 14-Oct-2026 11:50:00 GMT; Max-Age=3600; path=/
Content-type: text/html; charset=UTF-8

Você visitou esta página 1 vez(es)

**Explicação linha por linha:**

Set-Cookie: visitas=1...: O servidor instrui o cliente a gravar o cookie visitas com valor 1.
Você visitou esta página 1 vez(es): Corpo da resposta enviado pelo PHP.

**2.2 **Parte A:** saída de `curl.exe -i -c cookies.txt -b cookies.txt http://localhost:8000/q10-cookies/contador.php`, executado **três vezes** (cole a terceira)**

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:52:00 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Set-Cookie: visitas=3; expires=Wed, 14-Oct-2026 11:52:00 GMT; Max-Age=3600; path=/
Content-type: text/html; charset=UTF-8

Você visitou esta página 3 vez(es)

**Explicação linha por linha:**

Set-Cookie: visitas=3...: O servidor recebeu o valor 2 enviado no cabeçalho pelo curl, somou 1 e enviou de volta o novo valor 3 no Set-Cookie.
Você visitou esta página 3 vez(es): O contador persistiu os acessos anteriores graças aos parâmetros -c e -b.

**2.3 **Parte B, antes da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:53:00 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Content-type: text/html; charset=UTF-8

Carregando a página...<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>3</b><br />
<br />
<b>Warning</b>:  Cannot modify header information - headers already sent by (output started at /.../login.php:2) in <b>/.../login.php</b> on line <b>4</b><br />

**Explicação linha por linha:**

Carregando a página...: Texto enviado pelo echo, forçando o envio imediato dos cabeçalhos HTTP.
Warning: Cannot modify header information...: Avisos de erro gerados porque setcookie() e header() foram chamados após a transmissão do corpo da resposta ter iniciado.

**2.4 **Parte B, depois da correção:** saída de `curl.exe -i http://localhost:8000/q10-cookies/login.php`**

HTTP/1.1 302 Found
Host: localhost:8000
Date: Wed, 14 Oct 2026 10:54:00 GMT
Connection: close
X-Powered-By: PHP/8.3.6
Set-Cookie: usuario_logado=true; expires=Wed, 14-Oct-2026 11:54:00 GMT; Max-Age=3600; path=/
Location: dashboard.php
Content-type: text/html; charset=UTF-8

**Explicação linha por linha:**

Set-Cookie: usuario_logado=true...: Cabeçalho enviando o cookie para o navegador gravar
Location: dashboard.php: Cabeçalho indicando a nova URL para a qual o cliente deve navegar.

## 3. Perguntas

**3.1 No item 2.1, qual cabeçalho da resposta grava o cookie? E por que o contador não passa de 1 se você repetir o comando sem `-c` e `-b`?**

O cabeçalho responsável é o Set-Cookie. Sem as opções -c e -b, o curl se comporta como um cliente sem memória: ele não armazena o cookie recebido e não o envia de volta na requisição seguinte, fazendo o PHP ler sempre null e reiniciar o contador em 1.

**3.2 No item 2.2, o que fazem as opções `-c` e `-b`? O que isso prova sobre quem "lembra" do usuário no HTTP?**

A opção -c cookies.txt salva os cookies recebidos do servidor em um arquivo local, e -b cookies.txt lê esse arquivo e envia os cookies salvos no cabeçalho Cookie da requisição HTTP. Isso prova que o protocolo HTTP é stateless (sem estado) e que a responsabilidade de guardar e "lembrar" as informações da sessão é do cliente (navegador/curl).

**3.3 No item 2.3, qual aviso apareceu e por que o redirecionamento não aconteceu?**

PHP Warning: Cannot modify header information - headers already sent. O redirecionamento não aconteceu porque o comando echo enviou conteúdo para o corpo da resposta HTTP antes dos cabeçalhos serem processados. Na estrutura do protocolo HTTP, os cabeçalhos devem ser enviados obrigatoriamente antes de qualquer dado do corpo.

**3.4 No item 2.4, explique o status, o cabeçalho `Location` e o cabeçalho `Set-Cookie`. Por que `setcookie()` e `header()` precisam vir antes de qualquer `echo`?**

Status 302: Indica que o recurso solicitado foi movido temporariamente.
Location: Define o destino para onde o cliente deve ser redirecionado.
Set-Cookie: Envia os dados da sessão a serem gravados no cliente.
setcookie() e header() precisam vir antes de qualquer echo porque alteram diretamente a seção de cabeçalhos da mensagem HTTP. Assim que um echo é executado, o servidor envia os cabeçalhos pendentes e inicia o fluxo do corpo da resposta, tornando impossível aditar ou alterar cabeçalhos subsequentes.