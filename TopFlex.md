# TopFlex — Football Shirts Store

TopFlex es una **tienda online de camisetas de fútbol** desarrollada como proyecto **Full Stack**, separando completamente el backend (API REST) del frontend (SPA).

---

## Descripción del proyecto

TopFlex permite a los usuarios:

- Registrarse e iniciar sesión
- Navegar por camisetas de fútbol
- Ver detalles de cada camiseta
- Añadir productos al carrito seleccionando talla
- Confirmar pedidos

Los administradores pueden:

- Gestionar usuarios
- Gestionar ligas
- Gestionar equipos
- Gestionar camisetas e imágenes

El proyecto sigue una **arquitectura cliente-servidor**, con comunicación vía JSON usando **Laravel Sanctum** para la autenticación.

---

# Backend — Laravel API

## Tecnologías utilizadas

- PHP
- Laravel
- Laravel Sanctum
- MySQL
- REST API

---

## Esquema de Base de Datos

El proyecto utiliza las siguientes tablas:

- `users`
- `leagues`
- `teams`
- `shirts`
- `shirt_images`
- `carts`
- `cart_items`
- `orders`
- `order_items`

### Relaciones principales

- Un usuario tiene un carrito
- Un carrito tiene múltiples productos (`cart_items`)
- Una camiseta pertenece a un equipo
- Un equipo pertenece a una liga
- Un pedido contiene varios productos
- Una camiseta puede tener múltiples imágenes

---

## Autenticación y seguridad

- Autenticación mediante **Laravel Sanctum**
- Tokens Bearer
- Middleware:
  - `auth:sanctum`
  - `is_admin`
- Protección de rutas según rol

Ejemplo de header:

```http
Authorization: Bearer {token}
```

# Endpoints del Backend

## Endpoints públicos

| Método | Endpoint         | Descripción          |
| ------ | ---------------- | -------------------- |
| POST   | /api/register    | Registro de usuario  |
| POST   | /api/login       | Login                |
| GET    | /api/shirts      | Listado de camisetas |
| GET    | /api/shirts/{id} | Detalle de camiseta  |
| GET    | /api/leagues     | Listado de ligas     |
| GET    | /api/teams       | Listado de equipos   |

## Endpoints autenticados

| Método | Endpoint             | Descripción         |
| ------ | -------------------- | ------------------- |
| GET    | /api/me              | Usuario autenticado |
| POST   | /api/logout          | Logout              |
| GET    | /api/cart            | Ver carrito         |
| POST   | /api/cart/items      | Añadir producto     |
| PUT    | /api/cart/items/{id} | Actualizar cantidad |
| DELETE | /api/cart/items/{id} | Eliminar producto   |
| POST   | /api/orders          | Crear pedido        |
| GET    | /api/orders          | Pedidos del usuario |
| GET    | /api/orders/{id}     | Detalle del pedido  |

## Endpoints administrador

| Método | Endpoint                | Descripción       |
| ------ | ----------------------- | ----------------- |
| POST   | /api/leagues            | Crear liga        |
| PUT    | /api/leagues/{id}       | Editar liga       |
| DELETE | /api/leagues/{id}       | Eliminar liga     |
| POST   | /api/teams              | Crear equipo      |
| PUT    | /api/teams/{id}         | Editar equipo     |
| DELETE | /api/teams/{id}         | Eliminar equipo   |
| POST   | /api/shirts             | Crear camiseta    |
| PUT    | /api/shirts/{id}        | Editar camiseta   |
| DELETE | /api/shirts/{id}        | Eliminar camiseta |
| POST   | /api/shirts/{id}/images | Subir imagen      |
| DELETE | /api/shirt-images/{id}  | Eliminar imagen   |
| DELETE | /api/users/{id}         | Eliminar usuario  |

# Backend — Estructura principal

- **Controllers/Api**: lógica de negocio
- **Models**: modelos Eloquent
- **Middleware**: control de permisos
- **routes/api.php**: rutas API
- **database/migrations**: estructura BD

# Link al esquema de la base de datos:

- **https://drive.google.com/file/d/1jI8Vr9kJ-VXGPMYVE_oFBaZ4iZAr3Wev/view?usp=sharing**

# Frontend — React

## Tecnologías utilizadas

- React + Vite
- Axios
- React Router DOM
- Bootstrap 5
- Context API
- i18next (multidioma)

## Rutas del Frontend

| Ruta       | Descripción          |
| ---------- | -------------------- |
| /          | Listado de camisetas |
| /shirt/:id | Detalle de camiseta  |
| /cart      | Carrito              |
| /checkout  | Confirmar pedido     |
| /orders    | Pedidos              |
| /login     | Login                |
| /register  | Registro             |

## Gestión de estado

- **AuthContext**: usuario y token
- **CartContext**: carrito global
- Notificaciones y loaders
- Protección de rutas (ProtectedRoute, AdminRoute)

## Multilenguaje

Soporte para:

- Español
- Inglés
- Catalán

Implementado con i18next, con selector de idioma persistente en localStorage.

## Diseño y UX

- Bootstrap responsive
- Navbar dinámica
- Formularios validados
- Accesible y usable en móvil
