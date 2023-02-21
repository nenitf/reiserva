1. Duplicar .enb.example para .env

2. Instalar dependencias
```
composer i
```

3. Gere a chave
```
php artisan key:generate
```

4. suba o servidor
```
php artisan serve
```
5. criar migrations
```
php artisan make:migration --create=nome_da_tabela
```
6. Dar refresh 
```
php artisan migrate:refresh
```