<?php
/**
 * @author     SilexBB
 * @copyright  2011 - 2012 Silex Bulletin Board
 * @license    GPL version 3 <http://www.gnu.org/licenses/gpl-3.0.html>
 */

/* Langfile:	German (Informal) */
self::$Items = array_merge(self::$Items, array(
'sbb.language.info'    => 'Deutsch (Informell)',
'sbb.language.changed' => 'Deine Sprache wurde nach '.' geändert',

'sbb.error'         => 'Fehler',
'sbb.error.no_page' => 'Diese Seite existiert nicht',
'sbb.forumsoftware' => 'Forensoftware',

'sbb.header.welcome'            => 'Willkommen',
'sbb.header.logo_title'         => 'Startseite',
'sbb.header.slogan'             => 'Die moderne Bulletin-Board-Software',
'sbb.header.search.title'       => 'Suche',
'sbb.header.search.placeholder' => 'Suchen...',

'sbb.page.error'    => 'Fehler',
'sbb.page.home'     => 'Startseite',
'sbb.page.forum'    => 'Forum',
'sbb.page.userlist' => 'Benutzerliste',
'sbb.page.login'    => 'Anmeldung',
'sbb.page.register' => 'Registrierung',
'sbb.page.user'     => 'Benutzer',

'sbb.register.register'           => 'Registrieren',
'sbb.register.username'           => 'Benutzername',
'sbb.register.email'              => 'E-mail Adresse',
'sbb.register.email_repeat'       => 'E-mail Adresse wiederholen',
'sbb.register.password'           => 'Passwort',
'sbb.register.password_repeat'    => 'Passwort wiederholen',
'sbb.register.invalid_username'   => 'Ungültiger Benutzername',
'sbb.register.invalid_email'      => 'Ungültige E-Mail Adresse',
'sbb.register.incorrect_password' => 'Die Passwörter stimmen nicht überein',
'sbb.register.incorrect_email'    => 'Die E-Mail Adressen stimmen nicht überein',
'sbb.register.username_exist'     => 'Dieser Benutzername existiert bereits!',
'sbb.register.email_exist'        => 'Diese E-Mail Adresse existiert bereits!',
'sbb.register.success'            => 'Du hast dich erfolgreich registriert!',

'sbb.login.login'      => 'Einloggen',
'sbb.login.bar_handle' => 'Einloggen / Registrieren',
'sbb.login.username'   => 'Benutzername',
'sbb.login.password'   => 'Passwort',
'sbb.login.stay'       => 'Eingeloggt bleiben',
'sbb.login.failed'     => 'Du konntest dich nicht einloggen',
'sbb.login.success'    => 'Du hast dich erfolgreich angemeldet',
'sbb.logout.success'   => 'Du wurdest erfolgreich ausgeloggt',

'sbb.form.submit' => 'Absenden',

'sbb.user.guest'             => 'Gast',
'sbb.user.avatar'            => 'Profilbild',
'sbb.user.username'          => 'Benutzername',
'sbb.user.joined'            => 'Beigetreten',
'sbb.user.posts'             => 'Beiträge',
'sbb.user.language'          => 'Sprache',
'sbb.user.homepage'          => 'Webseite',
'sbb.user.contact'           => 'Kontaktieren',
'sbb.user.all_members'       => 'Alle Mitglieder',
'sbb.user.teammembers'       => 'Teammitglieder',
'sbb.user.search'            => 'Mitgliedssuche',
'sbb.user.no_user'           => 'Dieser Benutzer existiert nicht!',
'sbb.user.user'              => 'Benutzer',
'sbb.user.profile_of'        => 'Profil von',
'sbb.user.profile.group'     => 'Gruppe',
'sbb.user.profile.gender'    => 'Geschlecht',
'sbb.user.profile.joined'    => 'Beitrittsdatum',
'sbb.user.profile.activity'  => 'Letzte Aktivität',
'sbb.user.profile.language'  => 'Sprachen',
'sbb.user.profile.birthday'  => 'Geburtstag',
'sbb.user.profile.age'       => 'Alter',
'sbb.user.profile.signature' => 'Signatur',
'sbb.user.gender.male'       => 'Männlich',
'sbb.user.gender.female'     => 'Weiblich',

'sbb.logout.logout'        => 'Ausloggen',
'sbb.logout.logged_out'    => 'Du wurdest erfolgreich ausgeloggt',
'sbb.logout.main_menu'     => 'Hauptmenü',
'sbb.logout.not_logged_in' => 'Du kannst dich nicht ausloggen.',

'sbb.profile.homepage'  => 'Homepage',
'sbb.profile.signature' => 'Signatur',

'sbb.board.empty'            => 'Zurzeit ist das Board leer.',
'sbb.board.not_categorized'  => 'Nicht Kategorisiert',
'sbb.board.error.no_board'   => 'Das Forum existiert nicht',
'sbb.topics.error.no_topics' => 'Es gibt keine Themen.',

'sbb.captcha'       => 'Captcha',
'sbb.captcha_wrong' => 'Captcha ist falsch!',

'sbb.email.activation.title' => 'Du musst diesen Link klicken um deine Registrierung abzuschließen: ',

'sbb.footer.current_language' => 'Aktuelle Sprache',
'sbb.footer.current_style'    => 'Aktueller Stil',
'sbb.footer.current_time'     => 'Aktuelle Uhrzeit',
'sbb.footer.current_date'     => 'Aktuelles Datum',

'sbb.time.progress'    => 'Fortschritt des Jahres ('.round(Time::YearProcess() * 100, 2).'%)',
'sbb.time.dayprogress' => 'Fortschritt des Tages ('.round(Time::DayProcess() * 100, 2).'%)',
'sbb.time.january'     => 'Januar',
'sbb.time.february'    => 'Februar',
'sbb.time.march'       => 'März',
'sbb.time.april'       => 'April',
'sbb.time.may'         => 'Mai',
'sbb.time.june'        => 'Juni',
'sbb.time.july'        => 'Juli',
'sbb.time.august'      => 'August',
'sbb.time.september'   => 'September',
'sbb.time.october'     => 'Oktober',
'sbb.time.november'    => 'November',
'sbb.time.december'    => 'Dezember',
'sbb.time.monday'      => 'Montag',
'sbb.time.tuesday'     => 'Dienstag',
'sbb.time.wednesday'   => 'Mittwoch',
'sbb.time.thursday'    => 'Donnerstag',
'sbb.time.friday'      => 'Freitag',
'sbb.time.saturday'    => 'Samstag',
'sbb.time.sunday'      => 'Sonntag',

// Databasestrings
'sbb.config.style.default' => 'Standardstil',
'sbb.config.page.title'    => 'Seitentitel'
));
?>