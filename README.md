# Reiserva
## Config inicial

1. Duplicar .enb.example para .env

2. Instalar dependencias
```
composer i
```
3. Gere a chave
```
php artisan key:generate
```
4. criar migrations
```
php artisan make:migration --create=nome_da_tabela
```
5. Dar refresh 
```
php artisan migrate:refresh
```

## Execução local

apos a config inicial basta executar o servidor

```
php artisan serve
```