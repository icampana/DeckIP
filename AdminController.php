<?php

namespace Plugin\Deck;

/**
 *
 */
class AdminController {

  /**
   * Deck.js ask to provide widget management popup HTML. This controller does this.
   *
   * @return \Ip\Response\Json
   *
   * @throws \Ip\Exception\View
   */
  public function widgetPopupHtml() {
    $widgetId = ipRequest()->getQuery('widgetId');
    $widgetRecord = \Ip\Internal\Content\Model::getWidgetRecord($widgetId);
    $widgetData = $widgetRecord['data'];

    // Create form prepopulated with current widget data.
    $form = $this->managementForm($widgetData);

    // Render form and popup HTML.
    $viewData = array(
      'form' => $form,
    );
    $popupHtml = ipView('view/editPopup.php', $viewData)->render();
    $data = array(
      'popup' => $popupHtml,
    );
    // Return rendered widget management popup HTML in JSON format.
    return new \Ip\Response\Json($data);
  }

  /**
   * Check widget's posted data and return data to be stored or errors to be displayed.
   */
  public function checkForm() {
    $data = ipRequest()->getPost();
    $form = $this->managementForm();
    // Filter post data to remove any non form specific items.
    $data = $form->filterValues($data);
    // http://www.impresspages.org/docs/form-validation-in-php-3
    $errors = $form->validate($data);
    if ($errors) {
      // Error.
      $data = array(
        'status' => 'error',
        'errors' => $errors,
      );
    }
    else {
      // Success.
      unset($data['aa']);
      unset($data['securityToken']);
      unset($data['antispam']);
      $data = array(
        'status' => 'ok',
        'data' => $data,

      );
    }
    return new \Ip\Response\Json($data);
  }

  /**
   *
   */
  protected function managementForm($widgetData = array()) {
    $form = new \Ip\Form();

    $form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);

    // Setting hidden input field so that this form would be submitted to 'errorCheck' method of this controller. (http://www.impresspages.org/docs/controller)
    $field = new \Ip\Form\Field\Hidden(
        array(
          'name' => 'aa',
          'value' => 'Deck.checkForm',
        )
    );
    $form->addField($field);

    // Input fields to adjust widget settings.
    $form->addFieldset(new \Ip\Form\Fieldset(__('General', 'Deck')));

    $field = new \Ip\Form\Field\Text(
        array(
          'name' => 'title',
          'label' => 'Title',
          'value' => empty($widgetData['title']) ? NULL : $widgetData['title'],
        )
    );
    $field->addValidator('Required');
    $form->addField($field);

    $field = new \Ip\Form\Field\Select(
        array(
          'name' => 'position',
          'label' => 'Button Position',
          'value' => empty($widgetData['position']) ? NULL : $widgetData['position'],
          'values' => ['Top Left', 'Top Right', 'Bottom Left', 'Bottom Right'],
        )
    );
    $field->addValidator('Required');
    $form->addField($field);

    $field = new \Ip\Form\Field\RepositoryFile(
            array(
              'name' => 'imagelink',
              'label' => __('Image', 'Ip-Admin'),
              'fileLimit' => 1,
              'value' => empty($widgetData['imagelink']) ? NULL : array($widgetData['imagelink'][0]),
            )
        );
    $field->addValidator('Required');
    $form->addField($field);

    $form->addFieldset(new \Ip\Form\Fieldset(__('Display', 'Deck')));

    $form->addField(new \Ip\Form\Field\Url(
            array(
              'name' => 'pagelink',
              'label' => __('Url', 'Ip-Admin'),
              'value' => empty($widgetData['pagelink']) ? NULL : $widgetData['pagelink'],
            )
        )
    );

    $form->addField(new \Ip\Form\Field\Color(
            array(
              'name' => 'blockcolor',
              'label' => __('Color', 'Ip-Admin'),
              'value' => empty($widgetData['blockcolor']) ? '#b70287' : $widgetData['blockcolor'],
            )
        )
    );

    $field = new \Ip\Form\Field\RichText(
        array(
          'name' => 'text',
          'label' => 'Text',
          'value' => empty($widgetData['text']) ? NULL : $widgetData['text'],
        )
    );
    $form->addField($field);

    return $form;
  }

}
