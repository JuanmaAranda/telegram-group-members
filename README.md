# Telegram Group Members
Este plugin de WordPress muestra, en tiempo real, el número de usuarios de un grupo de Telegram en tu sitio de WordPress, mostrándolo mediante un shortcode.

## Descripción
El plugin Telegram Group Members permite mostrar el número de miembros de un grupo de Telegram en tu sitio web de WordPress en tiempo real. Utiliza un shortcode para insertar esta información en cualquier página o entrada de tu sitio.

## Instalación

1. Subir el plugin:
- Sube la carpeta telegram-group-members al directorio /wp-content/plugins/.
- O instala el plugin directamente desde el repositorio de plugins de WordPress.


2. Activar el plugin:
- Ve a la sección de "Plugins" en el panel de administración de WordPress.
- Activa el plugin Telegram Group Members.


3. Configurar el plugin:
- Ve a Ajustes > Telegram Group Members.
- Introduce el Token del Bot y el ID del Grupo de Telegram.

## Uso
Para mostrar el número de miembros del grupo de Telegram, utiliza el siguiente shortcode en cualquier página o entrada:
[telegram_group_members]

## Configuración
Para obtener los datos necesarios:
1. Token del Bot:
- Crea un Bot en Telegram con @BotFather.
- Utiliza el comando /newbot y sigue las instrucciones para obtener el Token.
- Asegúrate de que el bot es administrador del grupo.


2. ID del Grupo:
- Invita al bot @getmyid_bot a tu grupo de Telegram.
- Escribe el comando /start en el grupo para obtener el ID.
- Introduce el símbolo - delante del ID si es necesario.

## Detalles Técnicos
### Funciones Principales
- telegram_group_members_settings_page()
  - Añade la opción del plugin en el menú de ajustes de WordPress.
- telegram_group_members_options_page()
  - Renderiza la página de opciones del plugin.
- telegram_group_members_settings()
  - Registra los ajustes del plugin.
- telegram_group_members_options_validate($input)
  - Valida los ajustes introducidos por el usuario.
- telegram_group_members_shortcode()
  - Función del shortcode que obtiene y muestra el número de miembros del grupo.

### Hooks y Filtros
- admin_menu para añadir la página de opciones.
- admin_init para registrar los ajustes del plugin.
- add_shortcode para registrar el shortcode.

## Contribuciones
¡Las contribuciones son bienvenidas! Si tienes alguna mejora, si encuentras un bug o si deseas añadir nuevas características, por favor crea un pull request o abre un issue en el repositorio de GitHub.

## Licencia
Este plugin está licenciado bajo la licencia GPL2. Para más detalles, consulta el archivo LICENSE.

## Autor
Nombre: Juanma Aranda
Sitio web: wpnovatos.com
