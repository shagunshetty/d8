<?php

namespace Drupal\my_d8_demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class storeForm extends FormBase {
	public function getFormId() {
		return "store form";
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['first_name'] = array (
				'#type' => 'textfield',
				'#title' => t ( 'Firet Name:' )
		);
		$form ['last_name'] = array (
				'#type' => 'textfield',
				'#title' => t ( 'Last Name:' )
		);
		$form ['submit'] = array (
				'#type' => 'submit',
				'#value' => 'Go!'
		);

		return $form;
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		$first_name = $form_state->getValue ( 'first_name' );
		$last_name = $form_state->getValue ( 'last_name' );

		if (strlen ( $first_name ) > 10) {
			$form_state->setErrorByName ( 'first_name', 'First Name cannot be more than 10 chars.' );
		}

		if (strlen ( $last_name ) > 10) {
			$form_state->setErrorByName ( 'last_name', 'Last Name cannot be more than 10 chars.' );
		}
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		drupal_set_message ( "Form submited!!" );
	}
}