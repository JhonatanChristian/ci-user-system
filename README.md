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

<p><em>@param Array</em> <strong>$user_data</strong> = array('user_login' => 'User_Login', 'user_pass' => 'user_password', 'user_email' => 'example@email.com', 'user_level' => 0 to 9);</p>

<p><em>@param Bool</em> <strong>$replace</strong> = bool;</p>

<p>If true is past, then the system replace the user date on the DB. If false, in case the user already exists, then returns false.</p>

<h3>get_user_by( $field, $value )</h3>

<p>Gets user by ID or Login.</p>

<p><em>@param String</em> <strong>$field</strong> => 'ID' or 'user_login';</p>

<p><em>@param Int or String</em> <strong>$value</strong> => User ID or User Login;</p>

<h3>update_user( $user_id, $user_data )</h3>

<p>Updates the user data.</p>

<p><em>@param Int</em> <strong>$user_id</strong> => User ID;</p>

<p><em>@param Array</em> <strong>$user_data</strong> => array('user_pass' => 'user_password', 'user_email' => 'example@email.com', 'user_level' => 0 to 9);</p>

<h3>get_users( $args = array() )</h3>

<p><em>@param Array</em> <strong>$args</strong></p>

<p>Returns users.</p>

<table>
  <thead style="text-align:left;">
    <tr>
      <th>Param</th>
      <th>Value</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>id_in</td>
      <td>array(1, 2, 3, ...)</td>
    </tr>
    <tr>
      <td>id_not_in</td>
      <td>array(1, 2, 3, ...)</td>
    </tr>
    <tr>
      <td>s</td>
      <td>Search string.</td>
    </tr>
    <tr>
      <td>order_by</td>
      <td>Column name.</td>
    </tr>
    <tr>
      <td>order</td>
      <td>'ASC' or 'DESC'</td>
    </tr>
    <tr>
      <td>offset</td>
      <td>Default: 0</td>
    </tr>
    <tr>
      <td>limit</td>
      <td>Default: 10</td>
    </tr>
  </tbody>
</table>

<h3>delete_user( $user_id )</h3>

<p>Deletes a user and all his metadata.</p>

<p><em>@param Int</em> <strong>$user_id</strong> => User ID;</p>

<h3>insert_user_meta( $user_id, $meta_key, $meta_value )</h3>

<p>Creates a user metadata. If already exists, then update it.</p>

<p><em>@param Int</em> <strong>$user_id</strong> => User ID;</p>

<p><em>@param String</em> <strong>$meta_key</strong> => The meta key;</p>

<p><em>@param String</em> <strong>$meta_value</strong> => The meta value;</p>

<h3>update_user_meta( $user_id, $meta_key, $meta_value )</h3>

<p>Updates a user metadata.</p>

<p><em>@param Int</em> <strong>$user_id</strong> => User ID;</p>

<p><em>@param String</em> <strong>$meta_key</strong> => The meta key;</p>

<p><em>@param String</em> <strong>$meta_value</strong> => The meta value;</p>

<h3>get_user_meta( $user_id, $meta_key, $only_meta_value = false )</h3>

<p>Gets a user metadata.</p>

<p><em>@param Int</em> <strong>$user_id</strong> => User ID;</p>

<p><em>@param String</em> <strong>$meta_key</strong> => The meta key;</p>

<p><em>@param Bool</em> <strong>$only_meta_value</strong> => If is false, returns all metadata. If is true, returns only the meta value;</p>
