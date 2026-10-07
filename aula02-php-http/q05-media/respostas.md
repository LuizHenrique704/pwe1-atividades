# Questão 05: Média com dados da URL

**Nível:** 🟡 Intermediário

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `media.php` | Código fornecido, que você vai modificar no item 1.2 |

## 1. Análise do código

**1.1 Explique o código original: o que fazem `const`, os parênteses no cálculo e o operador `? :`?**

`const MEDIA_APROVACAO = 7;` define uma constante, ou seja, um valor fixo que não muda durante a execução. Isso centraliza a regra de negócio: a média mínima de aprovação é 7.

Os parênteses em `($n1 + $n2) / 2` garantem que a soma seja feita antes da divisão. Isso evita ambiguidades e deixa a expressão clara.

O operador ternário `?:` funciona como um if em uma linha: `condição ? valor_se_verdadeiro : valor_se_falso`. Aqui, se a média for maior ou igual a 7, a situação é `Aprovado`; caso contrário, é `Em recuperação`.

**1.2 Modifique o código para receber as notas pela URL (`?n1=...&n2=...`), usando `??` com valor padrão `0` e convertendo para `float`. Cole aqui o trecho que você alterou e explique.**

```php
<?php
const MEDIA_APROVACAO = 7;

$n1 = (float) ($_GET['n1'] ?? 0);
$n2 = (float) ($_GET['n2'] ?? 0);
$media = ($n1 + $n2) / 2;
$situacao = $media >= MEDIA_APROVACAO ? "Aprovado" : "Em recuperação";
?>
```

O `??` verifica se a chave da URL existe; se não existir, usa `0`. Em seguida, `(float)` converte o valor para número decimal. Assim, a página funciona mesmo quando a URL traz apenas uma nota ou nenhuma.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=5&n2=6"`**

```text
<p>Notas: 5 e 6</p>
<p>Média: 5.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

- A primeira linha mostra os valores recebidos por `n1` e `n2`.
- A segunda linha calcula a média de 5 e 6.
- A terceira linha compara a média com 7 e conclui que não foi aprovada.

**2.2 Saída de `curl.exe -s "http://localhost:8000/q05-media/media.php?n1=9"`**

```text
<p>Notas: 9 e 0</p>
<p>Média: 4.5</p>
<p>Situação: Em recuperação</p>
```

**Explicação linha por linha:**

- Como `n2` não foi enviado, o código usou `0`.
- A média entre 9 e 0 é 4.5.
- A situação fica em recuperação porque a média ficou abaixo de 7.

**2.3 Log do servidor das duas requisições acima**

```text
[Wed Oct  7 19:30:00 2026] 127.0.0.1:45678 [200]: GET /q05-media/media.php?n1=5&n2=6
[Wed Oct  7 19:30:01 2026] 127.0.0.1:45679 [200]: GET /q05-media/media.php?n1=9
```

**Explicação linha por linha:**

- Cada linha registra uma requisição `GET` com status `200`.
- A URL aparece na linha do log, mostrando os valores que vieram pela query string.

## 3. Perguntas

**3.1 No log, onde aparecem os valores das notas? Que parte da URL é essa?**

Os valores aparecem no caminho da requisição, depois do `?`. Essa parte é a query string, por exemplo `?n1=5&n2=6`. O PHP lê esses pares chave/valor com `$_GET`.

**3.2 Na requisição 2.2, a nota 2 não foi enviada. Qual valor o código usou? Qual operador garantiu isso?**

O código usou `0`. Isso foi garantido pelo operador `??`, que retorna o valor padrão quando a chave não existe.

**3.3 O que acontece com `?n1=abc&n2=10`? Explique o papel do `(float)`.**

O PHP tenta converter `abc` para número. Como isso não é um valor numérico, o cast para `float` faz a conversão para `0.0` ou para um valor que a linguagem consegue interpretar, e a operação segue sem quebrar o script. O cast evita que a variável fique como string e garante que a soma e a divisão funcionem em formato numérico.
