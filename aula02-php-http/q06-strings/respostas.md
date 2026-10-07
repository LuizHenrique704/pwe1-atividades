# Questão 06: Strings e acentuação

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `palavra.php` | Código fornecido, que você vai completar no item 1.2 |

> Se aparecer `Call to undefined function mb_strlen()`, ative a linha `extension=mbstring` no seu `php.ini` e reinicie o servidor. Registre isso na resposta 3.3.

## 1. Análise do código

**1.1 Explique o código original linha por linha.**

```php
<?php
$palavra = $_GET['palavra'] ?? "Ceara";

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";
```

- `$_GET['palavra']` lê o parâmetro `palavra` da URL.
- O operador `??` usa `"Ceara"` como valor padrão se o parâmetro não vier.
- `strlen($palavra)` conta o número de bytes da string.
- `echo` imprime o resultado em HTML.

**1.2 Complete o código para mostrar também: `mb_strlen`, `strtoupper`, `mb_strtoupper` e uma classificação com `if`: "palavra curta" (até 5 letras) ou "palavra longa". Use `mb_strlen` na classificação. Cole o código e explique.**

```php
<?php
$palavra = $_GET['palavra'] ?? "Ceara";

echo "<p>Palavra: $palavra</p>";
echo "<p>strlen: " . strlen($palavra) . "</p>";
echo "<p>mb_strlen: " . mb_strlen($palavra, 'UTF-8') . "</p>";
echo "<p>strtoupper: " . strtoupper($palavra) . "</p>";
echo "<p>mb_strtoupper: " . mb_strtoupper($palavra, 'UTF-8') . "</p>";

$classe = mb_strlen($palavra, 'UTF-8') <= 5 ? "palavra curta" : "palavra longa";
echo "<p>Classificação: $classe</p>";
```

A diferença é que `strlen` conta bytes, enquanto `mb_strlen` conta caracteres Unicode corretamente. `strtoupper` é a versão ASCII, e `mb_strtoupper` trata corretamente letras acentuadas. A classificação usa `mb_strlen` para contar “letras” com acento como um único caractere.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q06-strings/palavra.php?palavra=Ceara"`**

```text
<p>Palavra: Ceara</p>
<p>strlen: 5</p>
<p>mb_strlen: 5</p>
<p>strtoupper: CEARA</p>
<p>mb_strtoupper: CEARA</p>
<p>Classificação: palavra curta</p>
```

**Explicação linha por linha:**

- A palavra original é `Ceara`.
- `strlen` e `mb_strlen` dão 5 porque não há acento.
- `strtoupper` e `mb_strtoupper` transformam em maiúsculas.
- A classificação considera que a palavra tem até 5 caracteres e a classifica como curta.

**2.2 Abra no navegador `palavra.php?palavra=Ceará` e cole a linha do log do servidor**

```text
[Wed Oct  7 19:31:00 2026] 127.0.0.1:45681 [200]: GET /q06-strings/palavra.php?palavra=Cear%C3%A1
```

**Explicação linha por linha:**

- O navegador converte `á` para a forma URL-safe `%C3%A1`.
- O servidor recebe o caractere corretamente por meio da codificação UTF-8.
- O status `200` mostra que a requisição foi bem-sucedida.

## 3. Perguntas

**3.1 Compare o `strlen` de "Ceara" e de "Ceará". Por que o acento muda o resultado?**

Em `Ceara`, `strlen` conta 5 bytes/bytes e `mb_strlen` também conta 5 caracteres. Em `Ceará`, o `á` é representado em UTF-8 por dois bytes, então `strlen` passa a contar 6 bytes, mesmo sendo 5 letras. O `mb_strlen` corrige isso porque conta caracteres, não bytes.

**3.2 No log, a palavra aparece como `Cear%C3%A1`. O que é isso? Por que o navegador transformou o "á"?**

`Cear%C3%A1` é a codificação URL do caractere `á`. O navegador usa percent-encoding para enviar dados em uma URL segura e sem caracteres ambíguos. O `á` é convertido porque URLs não aceitam certos caracteres diretamente.

**3.3 Qual a diferença entre `strtoupper` e `mb_strtoupper` com a palavra "Ceará"?**

`strtoupper` é baseado em bytes ASCII e normalmente não trata corretamente caracteres acentuados em UTF-8. `mb_strtoupper` entende Unicode e transforma `Ceará` em `CEARÁ` corretamente. Isso é essencial para aplicações com textos em português.
