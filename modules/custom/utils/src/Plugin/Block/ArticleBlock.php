<?php
/**
 * @file 
 * Contains \Drupal\utils\Plugin\Block\ArticleBlock.
 */

namespace Drupal\utils\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Article' block.
 * 
 * @Block(
 *   id = "article_block",
 *   admin_label = @Translation("Article block"),
 *   category = @Translation("Custom article block example")
 * )
 *
 * @author bgogoi
 */
class ArticleBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => 'This block list the article.'
    );
  }
}
