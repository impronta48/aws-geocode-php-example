# Usare Amazon AWS per geocodificare gli indirizzi
Questa pagina spiega come usare AWS per geocodificare gli indirizzi usando PHP

## Come invocare
    https://localhost/_esempi/aws-geocode/

Oppure da riga di comando

    php index.php

## Creare un file composer.json
Creare composer.json e aggiungere l'sdk di AWS in PHP
```json

{
  "name": "impronta48/aws-geocode",
  "description": "AWS Geocode",
  "type": "library",
  "license": "MIT",
  "authors": [
    {
      "name": "Massimo Infunti",
      "email": "massimoi@mobilitysquare.eu"
    }
  ],
  "require": {
    "aws/aws-sdk-php": "^3.0"
  }
}
```
lanciare composer update

## Creare un file index.php che faccia le chiamate ad AWS
index.php (vedi il file index.php in questo repository)

##  Creare uno user specifico in IAM
Collegarsi a 
https://us-east-1.console.aws.amazon.com/iam/home
che è la console globale

- Scegliere __utenti__
- Creare un utente
- Aggiungere una policy di autorizzazione
- Creare la policy di autorizzazione inline (nel mio caso geo)
- Aggiungere alla policy tutti i privilegi geo:*

Salvare l'utente è **attendere** (l'aggiornamento dei privilegi non è istantaneo)

### Creare le chiavi di accesso per l'utente appena creato
In particolare la chiave di accesso e la chiave segreta e copiarle in un file di configurazione

##  Creare un file config.php
Nel file config.php inserire le credenziali di AWS
```php
$accessKey = xxxxxxxxxxxxxxxxxxxx
$secretKey = xxxx
```

assicurarsi che questo file non sia committato (.gitignore)

## Creare una location 
Andare su Amazon Location Services
https://eu-central-1.console.aws.amazon.com/location/places/home

Creare un indice dei luoghi
(Attenzione assicurarsi che la region dell'utente creato sopra sia la stessa dell'indice dei luoghi se no non funziona)
Non è necessario avere l'API key dell'indice dei luoghi
Inserire il nome dell'indice dei luoghi nel file di configurazione
$region = "eu-central-1";
$placeIndexName = "xxxxx";

