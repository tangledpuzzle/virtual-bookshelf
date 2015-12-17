<?php
/**
 * The front page.
 * @author Jose
 */

	if(isset($success_message))
	{
		echo '<div class="success-msg-box"><h4>Success</h4>' . $success_message . '</div>';
	}
	else if(isset($error_message))
	{
		echo '<div class="error-msg-box"><h4>Error</h4>' . $success_message . '</div>';
	}
?>
<h1 class="first-content-element">Welcome!</h1><br>
<p>VIRTUAL BOOKSHELF is a new kind of book reviewing service for the modern age. Our service enables you to create and manage your own bookshelves and review any books found on the site.</p><p>Register now and become a part of our growing community.</p>
	<h2>Resources Used In The Project</h2>
	<h3>Technologies</h3>
	<ul>
		<li>HTML5</li>
		<li>CSS3</li>
		<li>JavaScript</li>
		<li>PHP5</li>
		<li>Apache2</li>
		<li>Bootstrap</li>
		<li>CodeIgniter</li>
		<li>CodeIgniter REST Server</li>
		<li>MySQL</li>
		<li>3rd Party Library: <a href="http://community-auth.com/">Community Auth</a></li>
		<li>3rd Party Library: <a href="http://www.kryogenix.org/code/browser/sorttable/">sorttable</a></li>
	</ul>
	<h3>Tools</h3>
	<ul>
		<li>Codio</li>
		<li>Ubuntu</li>
		<li>Git</li>
		<li>GitLab</li>
		<li>Postman</li>
		<li>JSLint</li>
		<li>PHPDoc</li>
		<li>JSDoc</li>
		<li>PHPUnit</li>
		<li>MVC pattern</li>
	</ul>
