# Questão 04: Tipos e conversões

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `tipos.php` | Código fornecido (no item 3.3 você vai acrescentar linhas) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o tipo e o valor de cada linha.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"10" + 5` | `int(15)` | `int(15)` |
| `"10" . 5` | `string(3) "105"` | `string(3) "105"` |
| `7 / 2` | `float(3.5)` | `float(3.5)` |
| `7 % 2` | `int(1)` | `int(1)` |
| `(int) "3.9 kg"` | `int(3)` | `int(3)` |
| `(bool) "0"` | `bool(false)` | `bool(false)` |
| `(bool) "false"` | `bool(true)` | `bool(true)` |
| `0.1 + 0.2 == 0.3` | `bool(false)` | `bool(false)` |

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q04-tipos/tipos.php`**

```text
<pre>int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
</pre>
```

**Explicação linha por linha:**

- `int(15)` vem da operação matemática `"10" + 5`, em que a string é convertida em número.
- `string(3) "105"` vem da concatenação, que não faz cálculo e junta os textos.
- `float(3.5)` mostra que divisão em PHP produz número real, quando há casas decimais.
- `int(1)` é o resto da divisão `7 % 2`.
- `int(3)` vem da conversão forçada de string para inteiro, que ignora a parte decimal e o texto depois do número.
- `bool(false)` e `bool(true)` mostram que strings vazias ou valores como `"0"` são falsy, enquanto `"false"` é tratada como string não vazia, então é truthy.
- O último `bool(false)` mostra que testar `0.1 + 0.2 == 0.3` em ponto flutuante não dá um resultado exato por representação binária.

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

`"10" + 5` é uma operação matemática. O PHP tenta converter a string para número e faz a soma, resultando em `15` (`int`). Já `"10" . 5` usa o operador de concatenação `.` e transforma o valor `5` em texto, gerando a string `"105"`.

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

Em PHP, um valor booleano vai ser falso apenas quando ele é considerado vazio ou equivalente a zero. A string `"0"` é tratada como zero, então vira `false`. Já a string `"false"` não é vazia, nem zero nem nula, então ela é considerada verdadeira (`true`) quando convertida para `bool`.

**3.3 Acrescente ao arquivo duas linhas `var_dump` criadas por você, com resultados que te surpreenderam ou que você achou interessantes. Explique cada uma.**

Exemplo de linhas que podem ser acrescentadas:

```php
var_dump((int) "9.99");
var_dump((bool) "");
```

Explicação:

- `(int) "9.99"` resulta em `int(9)`: ao converter para inteiro, o PHP corta a parte decimal.
- `(bool) ""` resulta em `bool(false)`: uma string vazia é considerada falsa em PHP.

Isso mostra como a linguagem converte tipos de forma automática ou por cast, e como alguns valores são considerados “vazios” em operações booleanas.
