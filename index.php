<?php

include 'funcoes.php';

$certFile = realpath('seu_certificado.cer');
$keyFile = realpath('sua_chave_privada_sem_senha.key');
$clientId = "client ID";
$clientSecret = "client secret";
$chave = 'chave pix do recebedor';
$cnpj = 'CNPJ do recebedor';

$token = geraAccessToken($certFile, $keyFile, $clientId, $clientSecret);

$txid = geraTxid();

$cpfPagador = '123.456.789-12';
$nomePagador = 'Fulano da Silva';
$valor = 123.45;
$descricao = 'teste API sicredi';

$pixPF = geraCobrancaPF($certFile, $keyFile, $chaveRecebedor, $cpfPagador, $nomePagador, $valor, $descricao, $token, $txid);

$cnpjPagador = '01.234.567/8912-34';

$pixPJ = geraCobrancaPJ($certFile, $keyFile, $chaveRecebedor, $cnpjPagador, $nomePagador, $valor, $descricao, $token);