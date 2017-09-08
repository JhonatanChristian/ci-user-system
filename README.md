# ci-user-system
A simple user system for any project in CodeIgniter.

<h2>About</h2>

<p>This is a simple user system for projects that use CodeIgniter. This project brings a basic login system and some useful fuctions for work with users in your application.</p>

<h2>The Basic</h2>

<p>The default structure of the framework was kept. To access the login system, use: <strong>http://example.com/login</strong>. When you do the first request to this path, the application will create a basic table and data to use your user system.</p>

<p>For default, the application will create two tables: <strong>users</strong> and <strong>usermeta</strong>. Then, he's populate your database with a generic user, with login <strong>Master</strong> and pass <strong>password</strong>. You can change these values to anything yout wish in: <strong>application/models/Setup_Model.php</strong>. Here, change the vars:</p>

<p>$default_user = 'Your_Login'<br>
$default_pass = 'Your_Password'</p>
