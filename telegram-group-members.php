<?php
/**
 * Plugin Name: Telegram Group Members
 * Description: Este plugin muestra, en tiempo real, el número de usuarios de un grupo de Telegram en tu sitio de WordPress, mostrándolo mediante un shortcode.
 * Version: 1.0
 * Author: Juanma Aranda
 * Author URI: https://wpnovatos.com
 * License: GPL2
 */
 
// Añadir opciones a la página de ajustes de WordPress
function telegram_group_members_settings_page() {
    add_options_page(
        'Ajustes Telegram Group Members',
        'Telegram Group Members',
        'manage_options',
        'telegram-group-members',
        'telegram_group_members_options_page'
    );
}
add_action('admin_menu', 'telegram_group_members_settings_page');

// Página de opciones
function telegram_group_members_options_page() {
    ?>
    <div class="wrap">
        <h1>Ajustes Telegram Group Members</h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('telegram_group_members_options');
            do_settings_sections('telegram-group-members');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Registro de opciones
function telegram_group_members_settings() {
    register_setting(
        'telegram_group_members_options',
        'telegram_group_members_options',
        'telegram_group_members_options_validate'
    );

    add_settings_section(
        'telegram_group_members_section',
        'Telegram Group Members Settings',
        'telegram_group_members_section_callback',
        'telegram-group-members'
    );

    add_settings_field(
        'telegram_group_members_token',
        'Bot Token',
        'telegram_group_members_token_callback',
        'telegram-group-members',
        'telegram_group_members_section'
    );

    add_settings_field(
        'telegram_group_members_chat_id',
        'Chat ID',
        'telegram_group_members_chat_id_callback',
        'telegram-group-members',
        'telegram_group_members_section'
    );
}
add_action('admin_init', 'telegram_group_members_settings');

// Función de validación de opciones
function telegram_group_members_options_validate($input) {
    $options = get_option('telegram_group_members_options');
    $options['token'] = trim($input['token']);
    $options['chat_id'] = trim($input['chat_id']);
    return $options;
}

// Sección de descripción
function telegram_group_members_section_callback() {
    echo '<p>Este plugin te permite mostrar, en tiempo real, el número de miembros de un grupo de Telegram en tu sitio web de WordPress.</p>';
    echo '<h2>Shortcode</h2>';
    echo '<p>Para mostrar el número de miembros, inserta el shortcode <b>[telegram_group_members]</b> en cualquier página o entrada</p>';
    echo '<h2>Datos necesarios</h2>';
    echo '<p>Por favor, introduce el Token y el ID de tu Grupo a continuación:</p>';
}


// Campo de token
function telegram_group_members_token_callback() {
    $options = get_option('telegram_group_members_options');
    echo '<input type="text" name="telegram_group_members_options[token]" value="' . esc_attr($options['token']) . '" size="40" />';
    echo '<p>Para poder obtener el Token necesitas crear un Bot con <a href="https://t.me/botfather" target="new"><b>@BotFather</b></a>.</p>'; 
    echo '<p>Después introduce el comando <b>/newbot</b> y sigue todas sus instrucciones</p>';
    echo '<p>Recuerda que el bot debe estar añadido como administrador de tu Grupo</p>';

}

// Campo de chat ID
function telegram_group_members_chat_id_callback() {
    $options = get_option('telegram_group_members_options');
    echo '<input type="text" name="telegram_group_members_options[chat_id]" value="' . esc_attr($options['chat_id']) . '" size="40" />';
    echo '<p>Para poder obtener el ID del Grupo, necesitas invitar al Grupo al Bot <a href="https://t.me/getmyid_bot" target="new"><b>@getmyid_bot</b></a></p>';
    echo '<p>Una vez dentro del grupo, escribe el comando <b>/start</b> y te mostrará el ID del canal.<p>'; 
    echo '<p>Recuerda introducir el símbolo - delante, si te lo pone el Bot</p>';
}

// Shortcode
function telegram_group_members_shortcode() {
    $options = get_option('telegram_group_members_options');
    $token = $options['token'];
    $chat_id = $options['chat_id'];

    $response = wp_remote_get("https://api.telegram.org/bot$token/getChatMembersCount?chat_id=$chat_id");
    if (is_wp_error($response)) {
        return 'Error: ' . $response->get_error_message();
    }
    $result = json_decode($response['body'], true);
    if (isset($result['ok']) && $result['ok'] == true) {
        return $result['result'];
    } else {
        return 'Error: ' . $result['description'];
    }
}
add_shortcode('telegram_group_members', 'telegram_group_members_shortcode');
