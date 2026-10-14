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
| `"10" + 5` | | |
| `"10" . 5` | | |
| `7 / 2` | | |
| `7 % 2` | | |
| `(int) "3.9 kg"` | | |
| `(bool) "0"` | | |
| `(bool) "false"` | | |
| `0.1 + 0.2 == 0.3` | | |**

int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q04-tipos/tipos.php`**

<pre>int(15)
string(3) "105"
float(3.5)
int(1)
int(3)
bool(false)
bool(true)
bool(false)
</pre>

**Explicação linha por linha:**

int(15): O operador + força a conversão da string "10" para inteiro e soma com 5.   

float(3.5): A divisão / em PHP sempre retorna um número de ponto flutuante quando o resultado não é exato

int(1): O operador módulo % calcula o resto da divisão inteira de $7$ por $2$ (que é $1$). 

int(3): O cast (int) extrai o número inicial da string "3.9 kg" e descarta a parte decimal e o texto.

bool(false): Em PHP, a string contendo apenas o caractere "0" é considerada falsa quando convertida para booleano.

bool(true): Qualquer string não vazia diferente de "0" (incluindo a palavra "false") é convertida para true.

bool(false): Devido à imprecisão de representação interna de números flutuantes na memória (padrão IEEE 754), $0.1 + 0.2$ resulta em $0.30000000000000004$, tornando a comparação falsa. 

## 3. Perguntas

**3.1 Explique a diferença entre `"10" + 5` e `"10" . 5`.**

O operador + é estritamente aritmético; ele converte os operandos para números e realiza a soma (10 + 5 = 15). Já o operador . é de concatenação de strings; ele converte os operandos para texto e junta os caracteres ("10" com "5" resulta em "105").

**3.2 Por que `(bool) "0"` é `false`, mas `(bool) "false"` é `true`?**

O PHP define por regra que a string "0" representa um valor nulo/falso em contextos booleanos. Por outro lado, a string "false" é uma cadeia de caracteres contendo 5 letras (não vazia e diferente de "0"), e qualquer string preenchida é avaliada como verdadeira (true).

**3.3 Acrescente ao arquivo duas linhas `var_dump` criadas por você, com resultados que te surpreenderam ou que você achou interessantes. Explique cada uma.**

var_dump("10" === 10); -> Retorna bool(false). O operador de comparação estrita === verifica o valor e o tipo de dado. Como um lado é string e o outro é int, o resultado é falso.

var_dump((bool) []); -> Retorna bool(false). Em PHP, um array vazio sem elementos é considerado um valor falsy ao ser convertido para booleano.