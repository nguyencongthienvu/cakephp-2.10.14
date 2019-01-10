<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP-Demo');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<ul class="menu-content">
			<?php if ($this->Session->check('Auth.User')) { ?>
				<li class="forLi"><?php echo $this->Html->link('Home', array(
								'controller' => 'HomePage',
								'action' => 'display',
								'home')); ?></li>
				<li class="dropdown forLi">
					<a href="javascript:void(0)" class="dropbtn">Menu</a>
					<div class="dropdown-content">
						<?php echo $this->Html->link("Trang San Pham",array('controller' => 'sanphampage','action'=>'index'))?>
						<?php echo $this->Html->link("Trang User",array('controller' => 'users','action'=>'index'))?>
						<?php echo $this->Html->link("My Profile",array('controller' => 'users','action'=>'profile'))?>
					</div>
				</li>
				<li class="default forLi"><?php echo $this->Html->link("Đăng Xuất",array('controller' => 'users','action'=>'logout'))?></li>	
				<?php } else { ?>
					<li class="forLi"><?php echo $this->Html->link('Sign In', array(
								'controller' => 'authlogin',
								'action' => 'login'
								)); ?></li>
				<?php } ?>
			</ul>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
			<?php echo $this->element('sql_dump'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'https://cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
</body>
</html>
