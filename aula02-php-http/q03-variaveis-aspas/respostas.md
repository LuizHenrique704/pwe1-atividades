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
| `"Aluna: " . $nome` | | | Aluna: Maria
| `"Aluna: $nome"` | | | Aluna: Maria
| `'Aluna: $nome'` | | | Aluna:$nome
| `"Cursa o {$semestre}º semestre de $curso"` | | | Cursa o 2º semestre de ADS
| `$nome . $curso` | | | MariaADS
| `<?= $nome ?>` | | | Maria

**1.2 Para que servem as chaves `{}` em `{$semestre}`?**

As chaves servem para isolar o nome da variável do texto que vem imediatamente a seguir. Se escrevêssemos $semestreº sem as chaves, o PHP tentaria procurar uma variável com o nome exato $semestreº (o que causaria um erro, pois ela não existe). As chaves garantem que o interpretador leia apenas a variável $semestre.

## 2. Saídas do terminal

> Copie do terminal e cole entre as linhas de três crases. Depois explique **cada linha** com suas palavras.

**2.1 Saída de `curl.exe -s http://localhost:8000/q03-variaveis-aspas/aspas.php`**

<p>Aluna: Maria</p>
<p>Aluna: Maria</p>
<p>Aluna: $nome</p>
<p>Cursa o 2º semestre de ADS</p>
<p>MariaADS</p>
<p>Atalho: Maria</p>

**Explicação linha por linha:**

<p>Aluna: Maria</p>: O PHP concatenou a string "Aluna: " com o valor da variável $nome através do operador ponto (.)

<p>Aluna: Maria</p>: O PHP realizou a interpolação automática da variável $nome porque a string está delimitada por aspas duplas (")

<p>Aluna: $nome</p>: As aspas simples (') tratam todo o conteúdo como texto literal, logo o PHP não interpretou a variável $nome.

<p>Cursa o 2º semestre de ADS</p>: O PHP interpretou as variáveis dentro de aspas duplas, utilizando as chaves {$semestre} para isolar a variável da letra "º" colada a ela.

<p>MariaADS</p>: O PHP uniu os valores de $nome e $curso exatamente como estavam, sem adicionar nenhum espaço intermédio.

<p>Atalho: Maria</p>: A tag reduzida <?= $nome ?> funciona como um atalho direto para imprimir o valor da variável no HTML.

## 3. Perguntas

**3.1 Em quais linhas sua previsão errou? Explique o motivo.**

Não houve erros na previsão. Todas as saídas corresponderam ao comportamento esperado das aspas e dos operadores no PHP.

**3.2 Por que `$nome . $curso` aparece sem espaço entre as palavras? Como corrigir?**

Aparece sem espaço porque o operador ponto (.) apenas junta o conteúdo exato das duas variáveis sem inserir qualquer caractere adicional. Para corrigir, pode-se concatenar uma string com um espaço no meio ($nome . ' ' . $curso) ou utilizar aspas duplas ("$nome $curso").