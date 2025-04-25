# Financiacel API

Este proyecto es una API construida con **Laravel** para gestionar solicitudes de crédito de teléfonos móviles. Permite registrar nuevas solicitudes de crédito, obtener detalles de una solicitud específica y ver las cuotas (instalments) asociadas.

## 🛠️ Requisitos

- PHP >= 8.1  
- Composer  
- Laravel 10+  



{
  "client_id": 1,
  "phone_id": 2,
  "term_months": 12
}

1. Clona el repositorio:
   ```bash
   git clone https://github.com/diegocomunity/financiacel.git

2. Instalar dependencias:
   ```bash
   composer install

3. Ejecutar migraciones:
    ```bash
    php artisan migrate

4. Poblar la base de datos:
    ```bash
    php artisan db:seed

# API Documentation

## Base URL
`http://localhost:8000`

## Endpoints

### 1. POST /credits
#### Description:
Para crear una nueva aplicación.

#### Request Body:
```json
{
  "client_id": 1,
  "phone_id": 2,
  "term_months": 12
}
```
#### Respuesta que todo salió bien:
```
{
  "message": "Crédito aprobado",
  "application_id": 1
}
```
#### Error que indica que no hay modelo disponible en el stock:
```
{
  "error": "El cliente ya tiene un crédito activo."
}
```
### 2. POST /credits/{id}
#### Description:
Para ver detalles de un crédito en especifico por su ID.
##### Respuesta que todo salió bien:
```
{
  "id": 1,
  "client": "John Doe",
  "phone": "iPhone 12",
  "amount": 999.99,
  "term_months": 12,
  "state": "approved",
  "created_at": "2025-04-24T00:00:00"
}
```
##### Error
```
{
  "error": "Solicitud no encontrada"
}
```
### 3. GET /credits/{id}/instalmnts
#### Respuesta que todo salió bien
```
{
  "application_id": 1,
  "instalments": [
    {
      "number": 1,
      "amount": 99.99,
      "due_date": "2025-05-24T00:00:00",
      "paid": false
    },
    {
      "number": 2,
      "amount": 99.99,
      "due_date": "2025-06-24T00:00:00",
      "paid": false
    }
  ]
}
```
