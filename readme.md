# SIPLAC

[English](#english) | [Español](#español)

---

<a id="english"></a>
## English

Sistema de Información para la Planificación Académica (SIPLAC) — a web application developed as a university project for academic management at a higher education institution.

> **Note:** this project was developed for academic purposes as part of a university course. **It never reached production**; it does not manage real data of students, professors, or any institution. The users, credentials, and data included in the seeders are test data, generated for development and demonstration purposes.

### What does it do?

SIPLAC manages the academic planning cycle of a university degree program, including:

- **Users and roles**: user management with roles and permissions (administrator, creator, editor, visitor).
- **Degree programs and courses**: registration of degree programs, courses, and their curricular relationship (courses per program, cycles).
- **Professors**: management of professors and their assignment to courses and projects.
- **Groups and classrooms**: creation of course groups and classroom assignment.
- **Schedules**: assignment and generation of class schedules, with filters and reports.
- **Projects**: project management and professor assignment.
- **Reports**: reports on groups, schedules, and academic status.
- **Activity log and backups**: system activity logging and database backups.

### Tech stack

- **Backend**: PHP / [Laravel](https://laravel.com)
- **Frontend**: Blade, Vue.js, Vuetify, Bootstrap, jQuery
- **Build**: Laravel Mix (Webpack)
- **Database**: MySQL

### Local installation

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# configure the database credentials in .env

php artisan migrate --seed
npm run dev

php artisan serve
```

### Project status

Finished and archived academic project. It receives no active maintenance and is not deployed in any environment.

---

<a id="español"></a>
## Español

Sistema de Información para la Planificación Académica (SIPLAC) — aplicación web desarrollada como proyecto universitario para la gestión académica de una institución de educación superior.

> **Nota:** este proyecto fue desarrollado con fines académicos como parte de un curso universitario. **Nunca llegó a producción**; no gestiona datos reales de estudiantes, profesores ni de ninguna institución. Los usuarios, credenciales y datos incluidos en los seeders son de prueba, generados para fines de desarrollo y demostración.

### ¿Qué hace?

SIPLAC administra el ciclo de planificación académica de una carrera universitaria, incluyendo:

- **Usuarios y roles**: gestión de usuarios con roles y permisos (administrador, creador, editor, visitante).
- **Carreras y cursos**: registro de carreras, cursos, y su relación curricular (cursos por carrera, ciclos).
- **Profesores**: gestión de profesores y su asignación a cursos y proyectos.
- **Grupos y aulas**: creación de grupos de curso y asignación de aulas.
- **Horarios**: asignación y generación de horarios de clase, con filtros y reportes.
- **Proyectos**: gestión de proyectos y asignación de profesores.
- **Reportes**: reportes de grupos, horarios y estado académico.
- **Bitácora y respaldos**: registro de actividad del sistema y backups de la base de datos.

### Stack técnico

- **Backend**: PHP / [Laravel](https://laravel.com)
- **Frontend**: Blade, Vue.js, Vuetify, Bootstrap, jQuery
- **Build**: Laravel Mix (Webpack)
- **Base de datos**: MySQL

### Instalación local

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

# configurar las credenciales de base de datos en .env

php artisan migrate --seed
npm run dev

php artisan serve
```

### Estado del proyecto

Proyecto académico finalizado y archivado. No recibe mantenimiento activo ni está desplegado en ningún entorno.
