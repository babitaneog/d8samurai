<?php

/**
 * @file
 * Contains \Drupal\day3\Form\ConfigurationForm
 */

namespace Drupal\day3\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;

/**
 * Configuration Form
 *
 * @author bgogoi
 */
class ConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['day3.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'day3_configuration_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('day3.settings');

    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#required' => TRUE,
      '#default_value' => $config->get('title'),
    );
    $form['video'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube video'),
      '#default_value' => $config->get('video')
    );
    $form['develop'] = array(
      '#type' => 'checkbox',
      '#title' => t('I would like to be involved in developing this material'),
      '#default_value' => $config->get('develop'),
    );
    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#default_value' => $config->get('description'),
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate video URL.
    if (!UrlHelper::isValid($form_state->getValue('video'), TRUE)) {
      $form_state->setErrorByName('video', $this->t("The video url '%url' is invalid.", array('%url' => $form_state->getValue('video'))));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }

    // Save result in local module settings config
    $this->config('day3.settings')
        ->set('title', $form_state->getValue('title'))
        ->set('video', $form_state->getValue('video'))
        ->set('develop', $form_state->getValue('develop'))
        ->set('description', $form_state->getValue('description'))
        ->save();
  }

}
