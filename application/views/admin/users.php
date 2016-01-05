<?php

function list_entries(array $users)
{
  foreach ($users as $user) {
    echo '<tr>';
    echo '<form method="post" target="?"><input type="hidden" name="id" value="'.$user->id.'">';
    echo '<td><input type="text" name="username" value="'.$user->username.'"></td>';
    echo '<td><input type="text" name="email" value="'.$user->email.'"></td>';
    echo '<td><input type="checkbox" name="is_admin" value="1"'; if($user->is_admin==1){ echo 'checked="checked"'; } echo '></td>';
    echo '<td><input type="checkbox" name="is_confirmed" value="1"'; if($user->is_confirmed==1){ echo 'checked="checked"'; } echo '></td>';
    echo '<td><input type="checkbox" name="is_deleted" value="1"'; if($user->is_deleted==1){ echo 'checked="checked"'; } echo '></td>';
    echo '<td><input type="submit"  name="action" value="speichern"> <input type="submit" name="action" value="su"></td>';
    echo '</form>';
    echo '</tr>';
  }
}
?>

<h2 class="headline">Liste der User</h2>
<div class="table-responsive">
    <table class="table table-striped table-condensed">
      <thead>
        <tr>
          <th>username</th>
          <th>email</th>
          <th>is_admin</th>
          <th>is_confirmed</th>
          <th>is_deleted</th>
        </tr>
      </thead>
      <tbody>

        <?php list_entries($users)?>

      </tbody>
    </table>
  </div>

</div> <!-- container -->