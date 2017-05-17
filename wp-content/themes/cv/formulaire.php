<?php
/* Template Name: FORMULAIRE */
get_header();
?>
<form class="" action="#" method="post">
    <label for="email">EMAIL</label>
    <input type="email" name="email" value="">
    <input type="submit" name="envoyer" value="Envoyer">
</form>
<?php
if (isset ($_POST["envoyer"]) && $_POST["email"] != "") {
    $table = "email";
    $name = strip_tags($_POST["email"], "");
    $wpdb->insert($table, array('email' => $name));
}
?>
