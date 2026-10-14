# Questão 07: O dado pode não vir, o dado pode ser perigoso

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `saudacao.php` | Código fornecido, que você vai corrigir no item 1.2 |

## 1. Análise do código

**1.1 Quais são os dois problemas deste código?**

Ausência de verificação de existência do parâmetro: Se a página for acedida sem o parâmetro ?nome= na URL, o PHP gera um aviso (Warning: Undefined array key "nome").   Vulnerabilidade a XSS (Cross-Site Scripting): O código imprime diretamente no ecrã o que o utilizador envia pela URL sem qualquer higienização, permitindo que códigos HTML ou JavaScript maliciosos sejam executados no navegador do utilizador.

**1.2 Corrija o código usando `??` (valor padrão "Visitante") e `htmlspecialchars`. Faça um commit **antes** e outro **depois** da correção. Cole o código corrigido e explique.**

_(responda aqui)_

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 **Antes da correção**: log do servidor ao abrir `saudacao.php` sem parâmetro**

[Wed Oct 14 09:50:53 2026] PHP Warning:  Undefined array key "nome" in /home/luiz/.../saudacao.php on line 2
[Wed Oct 14 09:50:53 2026] [::1]:56828 [200]: GET /q07-tratamento/saudacao.php - Undefined array key "nome" in /home/luiz/.../saudacao.php on line 2

**Explicação linha por linha:**

O log indica que o servidor processou a requisição HTTP e retornou o status 200 (sucesso), mas registrou o aviso PHP Warning: Undefined array key 'nome'. Isso ocorreu porque o arquivo foi acessado sem nenhum parâmetro na URL, e o script tentou ler a chave 'nome' na superglobal $_GET sem testar se ela existia primeiro.

**2.2 **Antes da correção**: saída de `curl.exe -s "http://localhost:8000/q07-tratamento/saudacao.php?nome=<b>Oi</b>"`**

Olá, <b>Oi</b>

**Explicação linha por linha:**

A saída mostra a mensagem Olá, <b>Oi</b> porque o PHP juntou o texto fixa com a string bruta vinda da URL (<b>Oi</b>). Como não foi usada nenhuma função de sanitização, as tags HTML foram enviadas puras na resposta, fazendo com que o navegador interprete a tag <b> e exiba o texto em negrito

**2.3 **Depois da correção**: saída do mesmo comando do item 2.2**

```text
(cole aqui a saída do terminal)
```

**Explicação linha por linha:**

_(responda aqui)_

## 3. Perguntas

**3.1 Qual aviso apareceu no item 2.1? O que ele significa?**

_(responda aqui)_

**3.2 Compare o corpo da resposta em 2.2 e 2.3. O que o `htmlspecialchars` fez com `<b>`?**

_(responda aqui)_

**3.3 Teste no navegador `?nome=<script>alert('Ataque')</script>` antes e depois da correção. Explique o que aconteceu e por que isso é perigoso (XSS).**

_(responda aqui)_
