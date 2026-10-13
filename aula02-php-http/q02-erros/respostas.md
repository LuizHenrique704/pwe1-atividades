# Questão 02: Lendo mensagens de erro

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `erro.php` | Código fornecido com um erro proposital (corrija no item 3.3) |

## 1. Análise do código

**1.1 Antes de executar: qual é o erro do código? Em que linha ele está?**

O erro é a falta de um ponto e vírgula (;) no final da instrução na linha 2 ($curso = "ADS")

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Log do servidor ao abrir a página com `display_errors=1`**

[Tue Oct 13 18:33:19 2026] [::1]:37718 Accepted
[Tue Oct 13 18:33:19 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/luiz/Downloads/pweb1-atividades/aula02-php-http/q02-erros/erro.php on line 3
[Tue Oct 13 18:33:19 2026] [::1]:37718 [200]: GET /aula02-php-http/q02-erros/erro.php - syntax error, unexpected token "echo" in /home/luiz/Downloads/pweb1-atividades/aula02-php-http/q02-erros/erro.php on line 3
[Tue Oct 13 18:33:19 2026] [::1]:37718 Closing



**Explicação linha por linha:**

[Tue Oct 13 18:33:19 2026] [::1]:37718 Accepted: O servidor recebeu e aceitou o pedido de ligação do teu navegador no endereço local.

[Tue Oct 13 18:33:19 2026] PHP Parse error: syntax error, unexpected token "echo" in ... on line 3: O motor do PHP tentou processar o código e encontrou um erro fatal de sintaxe. Ele diz que encontrou um echo inesperado na linha 3, porque a instrução anterior (linha 2) não foi encerrada corretamente com o ponto e vírgula.

[Tue Oct 13 18:33:19 2026] [::1]:37718 [200]: GET ... - syntax error...: Regista o pedido para aceder ao ficheiro. O servidor devolveu o código de estado [200] (OK), pois como a exibição de erros estava ativada, ele construiu e entregou uma página HTML que exibia o erro no ecrã.

[Tue Oct 13 18:33:19 2026] [::1]:37718 Closing: A ligação foi encerrada após o envio da resposta.

**2.2 Log do servidor ao abrir a página com `display_errors=0`**

[Tue Oct 13 18:35:33 2026] [::1]:40758 Accepted
[Tue Oct 13 18:35:33 2026] PHP Parse error:  syntax error, unexpected token "echo" in /home/luiz/Downloads/pweb1-atividades/aula02-php-http/q02-erros/erro.php on line 3
[Tue Oct 13 18:35:33 2026] [::1]:40758 [500]: GET /aula02-php-http/q02-erros/erro.php - syntax error, unexpected token "echo" in /home/luiz/Downloads/pweb1-atividades/aula02-php-http/q02-erros/erro.php on line 3
[Tue Oct 13 18:35:33 2026] [::1]:40758 Closing


**Explicação linha por linha:**

[Tue Oct 13 18:35:33 2026] [::1]:40758 Accepted: O servidor aceitou o pedido de ligação do navegador.

[Tue Oct 13 18:35:33 2026] PHP Parse error... on line 3: Embora a exibição de erros esteja desativada para o utilizador, o PHP continua a registar internamente o problema no terminal. Ele aponta o erro fatal de sintaxe na linha 3.

[Tue Oct 13 18:35:33 2026] [::1]:40758 [500]: GET...: Aqui está a principal diferença. Como o erro não foi transformado numa página HTML amigável para o navegador (display_errors=0), o script simplesmente quebrou. O servidor respondeu com o código HTTP [500], que significa "Erro Interno do Servidor". É por isso que o ecrã ficou em branco.

[Tue Oct 13 18:35:33 2026] [::1]:40758 Closing: A ligação foi encerrada.

## 3. Perguntas

**3.1 A mensagem diz que o erro está em qual linha? Por que não é a linha onde falta o `;`?**

A mensagem indica que o erro está na linha 3 (no token echo), mas a falha real é a ausência do ; no final da linha 2. Isso acontece porque o PHP lê o código de forma contínua. Ele não sabe que a variável da linha 2 terminou até bater de frente com o comando echo na linha 3, momento em que percebe a falha de sintaxe.

**3.2 Compare o status registrado no log nas duas execuções (`[200]` e `[500]`). Por que eles são diferentes? Qual dos dois é o correto do ponto de vista do HTTP?**

Eles são diferentes por causa da configuração do PHP. Com display_errors=1, o PHP "salva" a execução para desenhar um HTML com a mensagem de erro, logo a resposta HTTP é entregue com sucesso ([200] OK). Com display_errors=0, o erro quebra a execução da página, gerando o status [500] (Internal Server Error). O correto do ponto de vista do protocolo HTTP para uma página quebrada é o [500].

**3.3 Corrija o código, faça um commit e cole aqui o log da execução corrigida.**

[Tue Oct 13 18:47:14 2026] [::1]:55952 Accepted
[Tue Oct 13 18:47:14 2026] [::1]:55952 [200]: GET /aula02-php-http/q02-erros/erro.php
[Tue Oct 13 18:47:14 2026] [::1]:55952 Closing


