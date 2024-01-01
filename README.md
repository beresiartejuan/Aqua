# Aqua

Librería para verificar arrays y objetos de manera sencilla

# Uso

Para definir las reglas que deben seguir los datos:

```php
use Beresiartejuan\Aqua\Validator;

$validator = new Validator;

$validator->field("username");
$validator->string();
$validator->custom(function(string $username){
  if(strlen($username) < 4 || strlen($username) > 20) throw new InvalidUsername();
});

$validator
  ->field("password")
  ->string()
  ->custom(function(string $password){
    if(strlen($password) < 6) throw new InsecurePassword();
  });

```

Para evaluar un array/objeto con las reglas anteriores:

```php
$credentials = [
  "username" => "val9020",
  "password" => "12345678"
];

$result = $validator->check($credentials);

if($result instanceof InvalidUsername){
  // Hubo un error con el username
}

if($result instanceof InsecurePassword){
  // Hubo un error en password
}

```

En caso de que el objecto/array cumpla con las condiciones deseadas la función `check` retornará `true`. Pero en caso de fallar hay dos posibles casos, la función `check` admite dos parametros: La estructura a evaluar y un boleano que indica sí queremos solamente retornar la excepción generada ó lanzar esa excepción.

```php
$credentials = [
  "username" => "val9020",
  "password" => ""
];

// Por defecto, retorna la excepción sin lanzarla
// Por lo que result es una instancia de InsecurePassword
$result = $validator->check($credentials, false);

// Cuando el boleano es verdadero, la excepción se lanza y la función no retorna nada
try{
  $validator->check($credentials, true);
}catch(Exception $e){
  echo "Hubo un error!";
}
```