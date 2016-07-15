<?php

namespace Drupal\block_linker\Controller;

use Drupal\block\Entity\Block;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Class LinksController.
 *
 * @package Drupal\block_linker\Controller
 */
class LinksController extends ControllerBase {

  /**
   * Links.
   *
   * @return string
   *   Return Hello string.
   */
  public function links() {
    $blocks = Block::loadMultiple();
    /** @var Block $block */
    foreach ($blocks as $block) {
      $link  = [
        '#type' => 'link',
        '#title' => $block->label(),
        '#url' => Url::fromRoute('entity.block.edit_form')->setRouteParameter('block', $block->id()),
        '#attributes' => [
          'class' => ['use-ajax'],
          'data-dialog-type' => 'offcanvas',
        ],
      ];
      $items[] = ['value' => $link];
      $item_list = array(
        '#items' => $items,
        '#theme' => 'item_list',
        '#attributes' => array('class' => array()),
        '#attached' => [
          'library' => [
            'outside_in/drupal.off_canvas',
          ],
        ],
      );

    }
    return $item_list;
  }

}
