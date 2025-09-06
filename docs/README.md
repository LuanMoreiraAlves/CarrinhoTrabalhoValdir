# Simulador de Carrinho de Compras

## Informações da Dupla

- Nome: Luan Moreira Alves - RA: 1996380
- Nome: Luis Felipe Pizelli Marques - RA: 1996772

## Descrição do Projeto

Este projeto é um simulador simples de carrinho de compras em PHP, desenvolvido para a disciplina de Design Patterns & Clean Code. O objetivo é praticar boas práticas como PSR-12 (estilo de código), KISS (manter simples) e DRY (evitar repetições), simulando um fluxo de e-commerce básico sem banco de dados ou frameworks. Todos os dados são armazenados em arrays PHP.

## Instruções de Execução

1. Instale o XAMPP e inicie o Apache.
2. Clone este repositório ou copie os arquivos para a pasta `htdocs/carrinho` do XAMPP.
3. Acesse via browser: `http://localhost/carrinho/src/index.php` (exibe saídas no navegador).
4. Ou rode via CLI: Navegue para `src/` e execute `php index.php` (exibe saídas no console).
5. O arquivo `index.php` demonstra todos os casos de uso automaticamente.

## Funcionalidades Implementadas

- **Adicionar Item ao Carrinho**: Valida existência do produto e estoque suficiente. Atualiza carrinho e reduz estoque.
- **Remover Item do Carrinho**: Valida existência do item no carrinho. Atualiza carrinho e restaura estoque.
- **Listar Itens do Carrinho**: Exibe itens com quantidade, subtotal e total.
- **Calcular Total**: Soma subtotais e aplica desconto se um cupom for fornecido.
- **Aplicar Desconto Fixo**: Cupom "DESCONTO10" aplica 10% de desconto no total final.
- Validações: Erros para produto inexistente, estoque insuficiente ou item não encontrado no carrinho.

Regras de Negócio:

- Subtotal é calculado automaticamente (preço \* quantidade).
- Estoque é atualizado em tempo real (reduz ao adicionar, restaura ao remover).
- Desconto é aplicado apenas no total final.

Limitações:

- Dados não persistentes (apenas arrays em memória).
- Sem interface de usuário (valores fixos ou via código de demo).
- Sem login ou autenticação.
- PHP puro, sem frameworks.

## Exemplos de Uso (Casos de Teste)

O arquivo `index.php` executa esses casos automaticamente. Saídas são impressas.

### Caso 1: Usuário adiciona um produto válido

- Entrada: Produto ID=1, Quantidade=2.
- Resultado: Produto adicionado, estoque de "Camiseta" reduzido de 10 para 8.
- Saída: Mensagem de sucesso e lista do carrinho.

### Caso 2: Usuário tenta adicionar além do estoque

- Entrada: Produto ID=3, Quantidade=10.
- Resultado: Erro "Estoque insuficiente para o produto Tênis (estoque disponível: 3)".
- Saída: Mensagem de erro, carrinho não alterado.

### Caso 3: Usuário remove produto do carrinho

- Entrada: Produto ID=2 (assumindo que foi adicionado previamente).
- Resultado: Produto removido, estoque de "Calça Jeans" restaurado (ex: de 4 para 5 se 1 foi adicionado).
- Saída: Mensagem de sucesso e lista atualizada do carrinho.

### Caso 4: Aplicação de cupom de desconto

- Entrada: Cupom "DESCONTO10" após adicionar itens.
- Resultado: Total reduzido em 10% (ex: total de R$100 vira R$90).
- Saída: Total com desconto exibido.

## Organização do Código

- Código em `src/Carrinho.php` (classe principal, seguindo PSR-12).
- Demo em `src/index.php` (executa casos de uso).
- Aplicação de DRY: Funções reutilizáveis para buscas e cálculos.
- Aplicação de KISS: Lógica simples, sem complexidades desnecessárias.
- Criatividade: Demo automatizado que roda todos os casos de uso em sequência para fácil visualização.
