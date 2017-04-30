# TesteWebDev - Flávio Costa e Silva
## Requisitos
1. PHP 7.0
2. Composer

## Instalação
1. Clone o projeto
2. Rode o comando composer install dentro da pasta do projeto

## Configurando
1. Verifique a presença do banco de dados (database.sqlite) em /storage/
2. Execute o programa através da linha de comando: 
* php artisan serve
3. Acesse pelo navegador com o endereço e porta informado pelo comando anterior
4. Ligue a queue com o comando: 
* php artisan queue:listen database

Agora basta inserir um arquivo .xlsx com 
os produtos, como no modelo passado!

## Funções
* Upload de arquivo .XLSX e pós processamento por fila, realizando criação e edição dos produtos.
* Edição dos produtos inserido atráves do botão Editar.
* Exclusão de produto pelo botão excluir.
* DICA: Você também pode editar seus produtos diretamente no arquivo .xlsx, mantendo o campo LM igual, o processamento irá editar o produto exitente para você!