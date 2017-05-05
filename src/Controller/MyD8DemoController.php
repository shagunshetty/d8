<?php

namespace Drupal\my_d8_demo\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MyD8DemoController implements ContainerInjectionInterface {
	private $account;
	public function __construct(AccountProxy $account) {
		$this->account = $account;
	}
	public function static_content() {
		return array (
				'#type' => 'markup',
				'#markup' => t ( 'My DEMO MODULE!!.' )
		);
	}
	public function dynamicContent($arg) {
		return [
				'#markup' => "Value passed = " . $arg
		];
	}
	public function entityUpcaster(NodeInterface $node) {
		return [
				'#theme' => 'item-list',
				'#items' => [
						$node->getTitle (),
						$node->get ( 'body' )->getValue ()
				]
		];
	}
	public function nodeCreatorAccess(NodeInterface $node) {
		kint ( $node->getOwnerId () );
		kint ( $this->account->id () );
		// exit ();
		// $account = \Drupal::service ( 'current_user' );
		if ($node->getOwnerId () === $this->account->id ()) {
			return AccessResult::allowed ();
		} else {
			return AccessResult::forbidden ();
		}
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'current_user' ) );
	}
}