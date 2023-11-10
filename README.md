<h1 align="center">Senakicht</h1>
<br>

### Instalation (dependencias)

```
git clone https://github.com/TCLJOHANT/senakicht.git
```
```
composer install
```
para jestream y sass
```
npm install
```
```
npm run build
```
sass globalmente
```
npm install -g sass
```
Para actualizar cada cambio que se haga en sass debes ejecutar:
```
sass --watch resources/sass:public/css
```
esto lo que hace es compilar  todo lo de sass a css dentro public/css 

jetstream necesita carpeta storage (alli se guardan las fotos de los usuarios)
```
php artisan storage:link
```
cambiar error de la api paypal
File: vendor\paypal\rest-api-sdk-php\lib\PayPal\Common\PayPalModel.php
en la linea 176
```
elseif (is_array($v) && sizeof($v) <= 0)
```
cuentas sandbox
```
sb-omfly28011412@personal.example.com
w93WW,K-
```
