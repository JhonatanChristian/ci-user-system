# ci-user-system
A simple user system for any project in CodeIgniter.

<h2>About</h2>

<p>This is a simple user system for projects that use CodeIgniter. This project brings a basic login system and some useful fuctions for work with users in your application.</p>

<h2>The Basic</h2>

<p>The default structure of the framework was kept. To access the login system, use: <strong>http://example.com/login</strong>. When you do the first request to this path, the application will create a basic table and data to use your user system.</p>

<p>For default, the application will create two tables: <strong>users</strong> and <strong>usermeta</strong>. Then, he's populate your database with a generic user, with login <strong>Master</strong> and pass <strong>password</strong>. You can change these values to anything yout wish in: <strong>application/models/Setup_Model.php</strong>. Here, change the vars:</p>

<p>$default_user = 'Your_Login'<br>
$default_pass = 'Your_Password'</p>

<p>Then you can use that information to login on the dashboard. There is not panel areas to manipulate your users data (once the purpose of the project is brings a basic user system for your application development). However, you can use some basic functions to develop your user system.</p>

<h2>Basic Functions</h2>

<p>The model of the users is <strong>Users_Model</strong>. He brings the follow methods:</p>

<h3>create_user( $user_data, $replace = false )</h3>

<p>Creates a user.</p>

<p>Description:</p>

<p><em>@param</em> <strong>$user_data</strong> = array('user_login' => 'User_Login', 'user_pass' => 'user_password', 'user_email' => 'example@email.com', 'user_level' => 0 to 9);</p>

<p><em>@param</em> <strong>$replace</strong> = bool;</p>

<p>If true is past, then the system replace the user date on the DB. If false, in case the user already exists, then returns false.</p>
