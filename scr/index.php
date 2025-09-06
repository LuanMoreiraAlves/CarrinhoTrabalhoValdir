<?php

declare(strict_types=1);

require_once 'Carrinho.php';

$carrinho = new Carrinho();

// Demo dos Casos de Uso
echo "<pre>"; // Para formatação no browser

// Caso 1: Adicionar produto válido
echo "Caso 1: Adicionar ID=1, Quantidade=2\n";
echo $carrinho->adicionarItem(1, 2) . "\n";
echo $carrinho->listarItens() . "\n\n";

// Adicionar mais um item para outros testes
echo "Adicionando ID=2, Quantidade=1 (para testes)\n";
echo $carrinho->adicionarItem(2, 1) . "\n";
echo $carrinho->listarItens() . "\n\n";

// Caso 2: Adicionar além do estoque
echo "Caso 2: Adicionar ID=3, Quantidade=10\n";
echo $carrinho->adicionarItem(3, 10) . "\n";
echo $carrinho->listarItens() . "\n\n";

// Caso 3: Remover produto
echo "Caso 3: Remover ID=2\n";
echo $carrinho->removerItem(2) . "\n";
echo $carrinho->listarItens() . "\n\n";

// Caso 4: Aplicar desconto
echo "Caso 4: Calcular total com cupom DESCONTO10\n";
$totalComDesconto = $carrinho->calcularTotal('DESCONTO10');
echo "Total com desconto: R$ $totalComDesconto\n";

echo "</pre>";
