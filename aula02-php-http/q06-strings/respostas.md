# Questão 06: Strings e acentuação

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `palavra.php` | Código fornecido, que você vai completar no item 1.2 |

> Se aparecer `Call to undefined function mb_strlen()`, ative a linha `extension=mbstring` no seu `php.ini` e reinicie o servidor. Registre isso na resposta 3.3.

## 1. Análise do código

**1.1 Explique o código original linha por linha.**

$palavra = $_GET['palavra'] ?? "Ceara";: Captura o valor do parâmetro palavra passado na URL via método GET. Caso o parâmetro não seja informado, atribui o valor padrão "Ceara" usando o operador null coalescing (??)

echo "<p>Palavra: $palavra</p>";: Exibe um parágrafo HTML com o texto contido na variável $palavra.v

echo "<p>strlen: " . strlen($palavra) . "</p>";: Exibe o tamanho da string em bytes utilizando a função nativa strlen().

**1.2 Complete o código para mostrar também: `mb_strlen`, `strtoupper`, `mb_strtoupper` e uma classificação com `if`: "palavra curta" (até 5 letras) ou "palavra longa". Use `mb_strlen` na classificação. Cole o código e explique.**

echo "<p>mb_strlen: " . mb_strlen($palavra) . "</p>";
echo "<p>strtoupper: " . strtoupper($palavra) . "</p>";
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra) . "</p>";

if (mb_strlen($palavra) <= 5) {
echo "Classificação: palavra curta";
} else {
echo "Classificação: palavra longa";
}

 `mb_strlen()` conta a quantidade real de caracteres da string em multibyte (UTF-8).
 `strtoupper()` tenta converter a string para maiúsculas levando em conta apenas a tabela ASCII simples.
 `mb_strtoupper()` converte a string para maiúsculas reconhecendo caracteres acentuados em UTF-8.
 A estrutura `if/else` utiliza a contagem de caracteres reais (`mb_strlen`) para classificar a palavra como "palavra curta" (até 5 caracteres) ou "palavra longa".

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"`**

<p>Palavra: Ceara</p>
<p>strlen: 5</p>
<p>mb_strlen: 5</p>
<p>strtoupper: CEARA</p>
<p>mb_strtoupper: CEARA</p>
<p>Classificação: palavra curta</p>

**Explicação linha por linha:**

<p>Palavra: Ceara</p>: Exibe a palavra "Ceara" recebida via URL.

<p>strlen: 5</p>: strlen() retornou 5 bytes.

<p>mb_strlen: 5</p>: mb_strlen() retornou 5 caracteres reais.

<p>strtoupper: CEARA</p>: Converteu a palavra para letras maiúsculas.

<p>mb_strtoupper: CEARA</p>: Converteu a palavra para letras maiúsculas.

<p>Classificação: palavra curta</p>: Como 5 é menor ou igual a 5, classificou como palavra curta.

**2.2 Abra no navegador `palavra.php?palavra=Ceará` e cole a linha do log do servidor**

[Wed Oct 14 09:12:00 2026] [::1]:42310 [200]: GET /aula02-php-http/q06-strings/palavra.php?palavra=Cear%C3%A1

**Explicação linha por linha:**

Linha de log: O servidor web aceitou o pedido GET com o status HTTP [200] OK. A letra acentuada "á" da Query String foi convertida automaticamente pelo navegador em Percent-Encoding (%C3%A1).

## 3. Perguntas

**3.1 Compare o `strlen` de "Ceara" e de "Ceará". Por que o acento muda o resultado?**

Para "Ceara", o strlen retorna 5. Para "Ceará", o strlen retorna 6. Isso ocorre porque a função strlen() conta a quantidade de bytes e não de caracteres. Na codificação UTF-8, caracteres ASCII simples ocupam 1 byte, mas letras acentuadas como o "á" ocupam 2 bytes na memória.

**3.2 No log, a palavra aparece como `Cear%C3%A1`. O que é isso? Por que o navegador transformou o "á"?**

Isso se chama Percent-Encoding (ou URL Encoding). As especificações do protocolo HTTP e URLs permitem apenas caracteres pertencentes ao conjunto ASCII básico. Como o caractere "á" não pertence ao ASCII simples, o navegador converte os seus 2 bytes UTF-8 (0xC3 e 0xA1) nos códigos hexadecimais %C3%A1 para poder transmiti-los com segurança na URL.

**3.3 Qual a diferença entre `strtoupper` e `mb_strtoupper` com a palavra "Ceará"?**

A função strtoupper("Ceará") resulta em "CEARá", pois ela só reconhece e converte caracteres ASCII de 1 byte, ignorando o acento. Já a função mb_strtoupper("Ceará") resulta em "CEARÁ", pois suporta a codificação multibyte UTF-8 e consegue converter corretamente letras acentuadas para suas correspondentes maiúsculas.
