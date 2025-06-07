# Sistema de Gestión para Consultorio Dental

Este es un sistema web desarrollado para gestionar las citas de un consultorio dental. Permite a los doctores registrar horarios de atención y a los pacientes agendar una única cita activa de forma segura y eficiente.

## Características principales

- Inicio de sesión con validación de roles (doctor o paciente).
- Redirección automática a la pantalla correspondiente según el tipo de usuario.
- El doctor puede registrar horarios disponibles (slots).
- El paciente puede agendar una cita en los horarios disponibles.
- Restricción para que el paciente no tenga más de una cita activa.
- Protección contra navegación por URL sin autenticación.
- Interfaz amigable y validación de formularios.

## Tecnologías utilizadas

- Laravel (PHP Framework)
- Blade (motor de vistas)
- MariaDB (base de datos)
- Tailwind CSS (estilos)

## Requisitos

- PHP 8.1 o superior
- Composer
- Node.js y npm
- MariaDB
- Navegador web actualizado

## Instalación

1. Clonar el repositorio:
   ```bash
   git clone https://github.com/tu-usuario/consultorio-dental.git
   cd consultorio-dental
   ```

2. Instalar dependencias de PHP y Node:
   ```bash
   composer install
   npm install && npm run dev
   ```

3. Configurar el archivo `.env`:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Crear la base de datos y ejecutar migraciones:
   ```bash
   php artisan migrate
   ```

5. Iniciar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## Roles del sistema

### Doctor
- Inicia sesión
- Crea horarios disponibles
- Consulta las citas agendadas por los pacientes

### Paciente
- Inicia sesión
- Visualiza los horarios disponibles
- Agenda una sola cita activa

## Seguridad

- Validación de credenciales y roles al iniciar sesión
- Redirección basada en tipo de usuario
- Restricción para evitar duplicado de citas
- Protección contra acceso directo a rutas sin autenticación


