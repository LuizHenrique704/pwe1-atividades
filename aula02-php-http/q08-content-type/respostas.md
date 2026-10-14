# Questão 08: O que o navegador entende? (Content-Type)

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `dados.php` | Código fornecido. No item 2.2 você vai descomentar a linha do header |
| `prints/devtools-html.png` | DevTools com o Content-Type antes de descomentar |
| `prints/devtools-json.png` | DevTools com o Content-Type depois de descomentar |

## 1. Análise do código

**1.1 Explique o que fazem `json_encode`, `JSON_PRETTY_PRINT` e `JSON_UNESCAPED_UNICODE`.**

json_encode(): Converte uma estrutura de dados do PHP (como um array associativo) numa string formatada no padrão JSON.
JSON_PRETTY_PRINT: É uma flag de formatação que aplica indentação, espaçamentos e quebras de linha ao JSON gerado, tornando-o legível para humanos.
JSON_UNESCAPED_UNICODE: Evita que caracteres multibyte ou acentuados (como ç e ã) sejam convertidos para sequências de escape Unicode (como \u00e7 e \u00e3), mantendo o texto em UTF-8 nativo.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -i http://localhost:8000/q08-content-type/dados.php` com o header **comentado****

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 13:16:14 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-type: text/html; charset=UTF-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}⏎                                                                                                                 


**Explicação linha por linha:**

HTTP/1.1 200 OK: Status HTTP $200$, indicando que o servidor processou o pedido com sucesso.

Content-type: text/html; charset=UTF-8: O PHP definiu por omissão que a resposta é um documento HTML simples.

Linha em branco: Separa os cabeçalhos HTTP do corpo da resposta.

Corpo do JSON: Conteúdo retornado pela função json_encode().

**2.2 Saída do mesmo comando com o header **descomentado****

HTTP/1.1 200 OK
Host: localhost:8000
Date: Wed, 14 Oct 2026 13:18:57 GMT
Connection: close
X-Powered-By: PHP/8.5.10
Content-Type: application/json; charset=utf-8

{
    "disciplina": "Programação Web I",
    "status": "Ativo",
    "alunos": 30
}⏎    

**Explicação linha por linha:**

Content-Type: application/json; charset=utf-8: O cabeçalho foi explicitamente alterado pela função header(), informando ao cliente que a resposta deve ser tratada como dados no formato JSON.

## 3. Perguntas

**3.1 Compare o cabeçalho `Content-Type` nas duas saídas. O que mudou?**

O valor do cabeçalho Content-Type mudou de text/html; charset=UTF-8 (padrão do servidor PHP) para application/json; charset=utf-8

**3.2 O corpo da resposta mudou? O que isso mostra sobre quem decide como o conteúdo é interpretado?**

O corpo da resposta permaneceu exatamente igual. Isso demonstra que a resposta trafegada via HTTP é sempre texto puro; quem determina como esse texto deve ser interpretado, formatado e renderizado é o cliente (navegador/aplicação), com base nas instruções fornecidas pelo servidor no cabeçalho Content-Type.

**3.3 Retire o `JSON_UNESCAPED_UNICODE`, rode o curl de novo e explique o que aconteceu com "Programação".**

Ao remover a constante JSON_UNESCAPED_UNICODE e reexecutar a função json_encode($dados, JSON_PRETTY_PRINT), a palavra "Programação Web I" passou a ser exibida como "Programa\u00e7\u00e3o Web I". Sem essa instrução, o json_encode converte caracteres acentuados para as suas sequências de escape em Unicode (\u00e7 para ç e \u00e3 para ã).