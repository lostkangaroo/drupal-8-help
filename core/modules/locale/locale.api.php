<?php

/**
 * @file
 * Hooks provided by the Locale module.
 */

/**
 * @defgroup interface_translation_properties Interface translation properties
 * @{
 *
 * .info file properties for interface translation settings.
 *
 * Modules hosted on drupal.org, a project definition is automatically added to
 * the .info file. Only modules with this project definition are discovered by
 * the update module and use it to check for new releases. Locale module uses
 * the same data to build a list of module to check for new translations.
 * Therefore modules not hosted at drupal.org, such as custom modules, custom
 * themes, features and distributions, need a way to identify themselves to
 * the Locale module if they have translations that require to be updated.
 *
 * Custom module which contain new strings should provide po file(s) containing
 * source strings and string translations in gettext format. The translation
 * file can be located both local and remote. Use the following .info file
 * properties to inform Locale module to load and import the translations.
 *
 * Example .info file properties for a custom module with a po file located in
 * the module's folder.
 * @code
 * interface translation project = example_module
 * interface translation server pattern = sites/example.com/modules/custom/example_module/%project-%version.%language.po
 * @endcode
 *
 * Multiple custom modules or themes sharing the same po file should have
 * matching definitions. Such as modules and sub-modules or multiple modules in
 * the same project/code tree. Both "interface translation project" and
 * "interface translation server pattern" definitions of these modules should match.
 *
 * Example .info file properties for a custom module with a po file located on
 * a remote translation server.
 * @code
 * interface translation project = example_module
 * interface translation server pattern = http://example.com/files/translations/%core/%project/%project-%version.%language.po
 * @endcode
 *
 * Custom themes, features and distributions can implement these .info file
 * properties in their .info file too.
 *
 * To change the interface translation settings of modules and themes hosted at
 * drupal.org use hook_locale_translation_projects_alter(). Possible changes
 * include changing the po file location (server pattern) or removing the
 * project from the translation update list.
 *
 * Available .info file properties:
 * - "interface translation project": project name. Required.
 *   Name of the project a (sub-)module belongs to. Multiple modules sharing
 *   the same project name will be listed as one the translation status list.
 * - "interface translation server pattern": URL of the .po translation files
 *   used to download the files from. The URL contains tokens which will be
 *   replaced by appropriate values. The file can be locate both at a local
 *   relative path, a local absolute path and a remote server location.
 *
 * The following tokens are available for the server pattern:
 * - "%core": Core version. Value example: "8.x".
 * - "%project": Project name. Value examples: "drupal", "media_gallery".
 * - "%version": Project version release. Value examples: "8.1", "8.x-1.0".
 * - "%language": Language code. Value examples: "fr", "pt-pt".
 *
 * @} End of "defgroup interface_translation_properties".
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter the list of projects to be updated by locale's interface translation.
 *
 * Locale module attempts to update the translation of those modules returned
 * by update_get_projects(). Using this hook the data returned by
 * update_get_projects() can be altered or extended.
 *
 * Modules or distributions that use a dedicated translation server should use
 * this hook to specify the interface translation server pattern.
 * - "interface translation server pattern": URL of the .po translation files
 *   used to download the files from. The URL contains tokens which will be
 *   replaced by appropriate values.
 * The following tokens are available for the server pattern:
 * - "%core": Core version. Value example: "8.x".
 * - "%project": Project name. Value examples: "drupal", "media_gallery".
 * - "%version": Project version release. Value examples: "8.1", "8.x-1.0".
 * - "%language": Language code. Value examples: "fr", "pt-pt".
 *
 * @param array $projects
 *   Project data as returned by update_get_projects().
 *
 * @see locale_project_list().
 */
function hook_locale_translation_projects_alter(&$projects) {
  // The translations are located at a custom translation sever.
  $projects['existing_project'] = array(
    'info' => array(
      'interface translation server pattern' => 'http://example.com/files/translations/%core/%project/%project-%version.%language.po',
    ),
  );
}

/**
 * @} End of "addtogroup hooks".
 */
