<?php

class Wonder_MaxItens_Model_Observer
{
  public function maxItens($observer)
  {
    $quantidade_itens_permitida = 500;
    $quote = Mage::getSingleton('checkout/cart')->getQuote();
    $quantidade_itens_no_carrinho = count($quote->getAllItems());
    Mage::log('quantidade atual: '.$quantidade_itens_no_carrinho);
    if ($quantidade_itens_no_carrinho >= $quantidade_itens_permitida) {
      Mage::getSingleton('checkout/session')->addError('Atingido limite de itens permitido no pedido');
      Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('checkout/cart'));
      Mage::app()->getResponse()->sendResponse();
      exit;
    }
  }
}
