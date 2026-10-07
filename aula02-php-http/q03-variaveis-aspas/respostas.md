# Questão 03: Variáveis, aspas e concatenação

**Nível:** 🟢 Básico

## Arquivos desta questão

| Arquivo | O que é |
|---|---|
| `aspas.php` | Código fornecido (não altere) |

## 1. Análise do código

**1.1 **Antes de executar**, preencha a coluna "Minha previsão" com o que cada linha vai mostrar.

| Linha | Minha previsão | Resultado real |
|---|---|---|
| `"Aluna: " . $nome` | `Aluna: Maria` | `Aluna: Maria` |
| `"Aluna: $nome"` | `Aluna: Maria` | `Aluna: Maria` |
| `'Aluna: $nome'` | `Aluna: $nome` | `Aluna: $nome` |
| `"Cursa o {$semestre}º semestre de $curso"` | `Cursa o 2º semestre de ADS` | `Cursa o 2º semestre de ADS` |
| `$nome . $curso` | `MariaADS` | `MariaADS` |
| `<?= $nome ?>` | `Maria` | `Maria` |

**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

As chaves permitem que o PHP identifique claramente o início e o fim de uma expressão dentro de uma string interpolada. Em `"Cursa o {$semestre}º semestre de $curso"`, elas deixam explícito que `semestre` é a variável a ser inserida, evitando ambiguidades e deixando o código mais legível.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

```text
<p>Aluna: Maria</p>
<p>Aluna: Maria</p>
<p>Aluna: $nome</p>
<p>Cursa o 2º semestre de ADS</p>
<p>MariaADS</p>
<p>Atalho: Maria</p>
```

**Explicação linha por linha:**

- A primeira linha imprime `Aluna: Maria` usando concatenação.
- A segunda linha usa interpolação em string dupla e também imprime `Aluna: Maria`.
- A terceira linha usa aspas simples, que não interpretam `$nome`, então o valor literal é exibido.
- A quarta linha mostra `2º` e `ADS` corretamente, com a variável interpolada no meio da frase.
- A quinta linha concatena `$nome` e `$curso` sem espaço, resultando em `MariaADS`.
- A sexta linha mostra o atalho `<?= $nome ?>`, equivalente a `<?php echo $nome; ?>`.

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

A principal diferença que costuma causar erro de previsão é a linha com aspas simples: `'Aluna: $nome'` não interpreta a variável, então o conteúdo mostrado é literalmente `$nome`. As outras linhas seguem a lógica de concatenação e interpolação esperada, e o resultado real confirma isso.

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Porque o operador `.` apenas concatena textos, sem inserir automaticamente espaços. O código `$nome . $curso` produz `MariaADS` porque a string `Maria` fica colada à string `ADS`. Para corrigir, basta adicionar um espaço manualmente na concatenação, por exemplo:

```php
<?php echo $nome . " " . $curso; ?>
```

ou então

```php
<?php echo "$nome $curso"; ?>
```
