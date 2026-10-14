# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, que você vai modificar no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

const: Define uma constante (MEDIA_APROVACAO) com valor fixo 7 que não pode ser alterado durante a execução do script.

Parênteses ($n1 + $n2): Garantem a precedência matemática, forçando o PHP a somar as duas notas primeiro antes de dividir por 2.

Operador ? :: É o operador ternário, um atalho para a estrutura if/else. Ele avalia a condição $media >= MEDIA_APROVACAO; se for verdadeira, retorna "Aprovado", caso contrário, retorna "Em recuperação".

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);

Substituí os valores fixos pelas superglobais $_GET['n1'] e $_GET['n2']. O operador ?? (Null Coalescing) atribui o valor padrão 0 caso o parâmetro não seja enviado na URL, e o (float) converte o texto recebido para número decimal.
## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

<p>Notas: 5 e 6</p>
<p>Média: 5.5</p>
<p>Situação: Em recuperação</p>

**Explicação linha por linha:**

<p>Notas: 5 e 6</p>: Exibe as notas 5 e 6 capturadas da URL.

<p>Média: 5.5</p>: Exibe a média calculada: $(5 + 6) / 2 = 5.5$.

<p>Situação: Em recuperação</p>: Como 5.5 é menor que a constante 7, o operador ternário definiu a situação como "Em recuperação".

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>

**Explicação linha por linha:**

<p>Notas: 9 e 0</p>: $n1$ recebeu 9 da URL, enquanto $n2$ assumiu o valor padrão 0 pois não foi enviado. 

<p>Média: 4.5</p>: Exibe a média calculada: $(9 + 0) / 2 = 4.5$.

<p>Situação: Em recuperação</p>: A média 4.5 é menor que 7, resultando em "Em recuperação".

**2.3 Log do servidor das duas requisições acima**

[Wed Oct 14 08:50:01 2026] [::1]:41200 [200]: GET /aula02-php-http/q05-media/media.php?n1=5&n2=6
[Wed Oct 14 08:50:05 2026] [::1]:41202 [200]: GET /aula02-php-http/q05-media/media.php?n1=9

**Explicação linha por linha:**

Linha 1: Registra a primeira requisição GET respondida com sucesso [200], incluindo os parâmetros ?n1=5&n2=6 no caminho da requisição.
Linha 2: Registra a segunda requisição GET com o parâmetro ?n1=9, também entregue com status [200].

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

Os valores aparecem logo após o nome do arquivo media.php, iniciados pelo caractere ?. Essa parte da URL é chamada de Query String (ou parâmetros da requisição GET).

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

O código usou o valor 0. O operador que garantiu essa atribuição foi o Null Coalescing Operator (??), que verifica se a chave $_GET['n2'] existe e, caso não exista, retorna o valor definido à sua direita (0).

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

A variável $n1 assumirá o valor 0 e o cálculo da média utilizará $0$ e $10$ (média $5$). O conversor (float) tenta transformar a string recebida em número; como a string "abc" não começa com dígitos numéricos, o PHP a converte com segurança para 0.0, prevenindo erros de execução.
