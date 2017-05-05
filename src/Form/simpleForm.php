<?php

namespace Drupal\my_d8_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class simpleForm extends FormBase {
	public function getFormId() {
		return "simple form";
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['name'] = array (
				'#type' => 'textfield',
				'#title' => t ( 'Name:' )
		);
		$form ['submit'] = array (
				'#type' => 'submit',
				'#value' => 'Go!'
		);

		return $form;
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$name = $form_state->getValue ( 'name' );

		if (strlen ( $name ) > 5) {
			$form_state->setErrorByName ( 'name', 'Name cannot be more than 5 chars.' );
		}
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		drupal_set_message ( "Form submited!!" );
	}
}