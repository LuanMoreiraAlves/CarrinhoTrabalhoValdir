<?php

declare(strict_types=1);

class Carrinho
{
    private array $produtos;
    private array $carrinho;

    public function __construct()
    {
        $this->produtos = [
            ['id' => 1, 'nome' => 'Camiseta', 'preco' => 59.90, 'estoque' => 10],
            ['id' => 2, 'nome' => 'Calça Jeans', 'preco' => 129.90, 'estoque' => 5],
            ['id' => 3, 'nome' => 'Tênis', 'preco' => 199.90, 'estoque' => 3],
        ];

        $this->carrinho = [];
    }

    public function adicionarItem(int $idProduto, int $quantidade): string
    {
        $produto = $this->encontrarProduto($idProduto);
        if ($produto === null) {
            return "Produto com ID $idProduto não encontrado.";
        }

        if ($quantidade > $produto['estoque']) {
            return "Estoque insuficiente para o produto {$produto['nome']} (estoque disponível: {$produto['estoque']}).";
        }

        $itemExistente = $this->encontrarItemNoCarrinho($idProduto);
        if ($itemExistente !== null) {
            $itemExistente['quantidade'] += $quantidade;
            $itemExistente['subtotal'] = $itemExistente['quantidade'] * $produto['preco'];
        } else {
            $this->carrinho[] = [
                'id_produto' => $idProduto,
                'quantidade' => $quantidade,
                'subtotal' => $quantidade * $produto['preco'],
            ];
        }

        $produto['estoque'] -= $quantidade;
        $this->atualizarProduto($produto);

        return "Produto {$produto['nome']} adicionado com sucesso (quantidade: $quantidade).";
    }

    public function removerItem(int $idProduto): string
    {
        $item = $this->encontrarItemNoCarrinho($idProduto);
        if ($item === null) {
            return "Item com ID $idProduto não encontrado no carrinho.";
        }

        $produto = $this->encontrarProduto($idProduto);
        $produto['estoque'] += $item['quantidade'];
        $this->atualizarProduto($produto);

        $this->carrinho = array_filter($this->carrinho, function ($i) use ($idProduto) {
            return $i['id_produto'] !== $idProduto;
        });

        return "Item com ID $idProduto removido com sucesso.";
    }

    public function listarItens(): string
    {
        if (empty($this->carrinho)) {
            return "Carrinho vazio.";
        }

        $output = "Itens no carrinho:\n";
        $total = 0;
        foreach ($this->carrinho as $item) {
            $produto = $this->encontrarProduto($item['id_produto']);
            $output .= "- {$produto['nome']} (ID: {$item['id_produto']}) | Quantidade: {$item['quantidade']} | Subtotal: R$ {$item['subtotal']}\n";
            $total += $item['subtotal'];
        }
        $output .= "Total: R$ $total\n";

        return $output;
    }

    public function calcularTotal(string $cupom = ''): float
    {
        $total = 0;
        foreach ($this->carrinho as $item) {
            $total += $item['subtotal'];
        }

        if ($cupom === 'DESCONTO10') {
            $total *= 0.9; // 10% de desconto
        }

        return $total;
    }

    private function encontrarProduto(int $id): ?array
    {
        foreach ($this->produtos as $produto) {
            if ($produto['id'] === $id) {
                return $produto;
            }
        }
        return null;
    }

    private function encontrarItemNoCarrinho(int $id): ?array
    {
        foreach ($this->carrinho as &$item) { // Referência para permitir atualização
            if ($item['id_produto'] === $id) {
                return $item;
            }
        }
        return null;
    }

    private function atualizarProduto(array $produtoAtualizado): void
    {
        foreach ($this->produtos as &$produto) {
            if ($produto['id'] === $produtoAtualizado['id']) {
                $produto = $produtoAtualizado;
                return;
            }
        }
    }
}
