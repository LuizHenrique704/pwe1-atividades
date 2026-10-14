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

$nome = $_GET['nome'] ?? "Visitante";
echo "Olá, " . htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');

 Operador ?? (Null Coalescing) resolve o aviso de erro. Se o utilizador não enviar o parâmetro ?nome=, a variável $nome recebe o valor padrão "Visitante". 
 A função htmlspecialchars() resolve a vulnerabilidade XSS. Ela converte caracteres especiais do HTML (como < e >) em entidades seguras (como &lt; e &gt;), impedindo que o navegador os interprete como código

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

Olá, &lt;b&gt;Oi&lt;/b&gt;

**Explicação linha por linha:**

O navegador (ou o curl) agora recebe &lt;b&gt; em vez de <b>. Assim, o navegador apenas imprime o texto literalmente na tela, sem aplicar o negrito.

## 3. Perguntas

**3.1 Qual aviso apareceu no item 2.1? O que ele significa?**

Apareceu o aviso PHP Warning: Undefined array key "nome". Isso significa que o PHP tentou procurar pela chave 'nome' dentro da superglobal $_GET, mas ela não existia (porque não passámos nada na URL).

**3.2 Compare o corpo da resposta em 2.2 e 2.3. O que o `htmlspecialchars` fez com `<b>`?**

No item 2.2, o código devolveu as tags puras (<b>Oi</b>), aplicando o negrito. No 2.3, o htmlspecialchars converteu as tags para o formato de entidade HTML (&lt;b&gt;Oi&lt;/b&gt;), inativando o seu efeito visual.

**3.3 Teste no navegador `?nome=<script>alert('Ataque')</script>` antes e depois da correção. Explique o que aconteceu e por que isso é perigoso (XSS).**

Antes: O navegador leu a tag <script> e executou o JavaScript, mostrando um alerta na tela.
Depois: Com a correção, a tag <script> foi desarmada pelo htmlspecialchars e exibida apenas como texto comum.
Por que é perigoso (XSS): O Cross-Site Scripting (XSS) permite que um atacante injete código malicioso na nossa página. Se um utilizador real clicar num link com esse script, o atacante pode roubar sessões, senhas ou infetar o utilizador.
