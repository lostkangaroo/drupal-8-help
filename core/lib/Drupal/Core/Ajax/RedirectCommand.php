<?php

/**
 * @file
 * Contains \Drupal\Core\Ajax\RedirectCommand.
 */

namespace Drupal\Core\Ajax;

use Drupal\Core\Ajax\CommandInterface;

/**
 * Defines an AJAX command to set the window.location, loading that URL.
 */
class RedirectCommand implements CommandInterface {

  /**
   * The URL that will be loaded into window.location.
   *
   * @var string
   */
  protected $url;

  /**
   * Constructs an RedirectCommand object.
   *
   * @param string $url
   *   The URL that will be loaded into window.location. This should be a full
   *   URL, one that has already been run through the url() function.
   */
  public function __construct($url) {
    $this->url = $url;
  }

  /**
   * Implements \Drupal\Core\Ajax\CommandInterface:render().
   */
  public function render() {
    return array(
      'command' => 'redirect',
      'url' => $this->url,
    );
  }

}
