<?php 

class tiny_options {
  public $data = array();
  public $o = array();

  public function __construct($data) {

    $this->data = $data;
    register_activation_hook(
      $this->data['real_plugin_path'], 
      array($this,'defaults')
    );
    add_action('admin_init', array($this,'options') );
    add_action('admin_menu', array($this,'pages'));
  }
  public function pages(){
    add_options_page(
      $this->data['page_title'],
      $this->data['menu_title'],
      $this->data['permission'],
      $this->data['menu_slug'],
      array($this,'page')
    );      
  }
  public function defaults(){
    update_option($this->data['option_name'], $this->data['defaults']);
  }
  public function page(){
?>
      <div class="wrap">
        <h2><?php echo $this->data['page_title']; ?></h2>
        <?php echo (isset($this->data['page_description'])&&($this->data['page_description']))?'<p>'.$this->data['page_description'].'</p>':''; ?>
        <form method="post" action="options.php">
          <?php settings_fields($this->data['option_name']); ?>
          <?php do_settings_sections($this->data['plugin_path']); ?>
          <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>">
          </p>
        </form>
      </div>
<?php
  }
  public function options(){
    register_setting(
      $this->data['option_name'], 
      $this->data['option_name'], 
      array($this,'validate')
    );
    foreach ($this->data['section'] as $section) {
      add_settings_section($section['slug'], $section['title'], '', $this->data['plugin_path']);
      foreach ($section['field'] as $field) {
        add_settings_field(
          "{$section['slug']}_{$field['slug']}", 
          $field['title'], 
          array($this,$field['type']), 
          $this->data['plugin_path'], 
          $section['slug'],
          array(
            'option_id'=>"{$section['slug']}_{$field['slug']}",
            'description'=>!empty($field['description']) ? $field['description'] : '',
            'options'=>isset($field['options'])?$field['options']:false
          )
        );
      }
    }
  }
  public function get(){
    return get_option($this->data['option_name']);
  }
  public function load(){
    $this->o = get_option($this->data['option_name']);
  }
  public function validate($input) {
    foreach ($this->data['section'] as $section) {
      add_settings_section($section['slug'], $section['title'], '', $this->data['plugin_path']);
      foreach ($section['field'] as $field) {
        $name = "{$section['slug']}_{$field['slug']}";
        $type = $field['type'];
        if (!isset($input[$name]))
          $input[$name] = false;
        // to do: sanitize for every type;
      }
    }
    return $input;
  }  
  public function text($args) {
    $options = get_option($this->data['option_name']);
    echo "<input id='{$args['option_id']}' name='{$this->data['option_name']}[{$args['option_id']}]' type='text' value='{$options[$args['option_id']]}' />";
    if ($args['description'])
      echo '<p class="description">'.$args['description'].'</p>';
  }
  public function textarea($args) {
    $options = get_option($this->data['option_name']);
    echo "<textarea id='{$args['option_id']}' name='{$this->data['option_name']}[{$args['option_id']}]' rows='5'>{$options[$args['option_id']]}</textarea>";
    if ($args['description'])
      echo '<p class="description">'.$args['description'].'</p>';
  }
  public function select($args) {
    $options = get_option($this->data['option_name']);
    echo "<select id='{$args['option_id']}' name='{$this->data['option_name']}[{$args['option_id']}]'>";
    if (isset($args['options']['list_none']) && $args['options']['list_none'])
      echo "<option value=\"\"".($options[$args['option_id']]?"":" selected=\"selected\"").">".__('-none-','tiny_coffee')."</option>";
    foreach($args['options']['list'] as $key => $val) {
      echo "<option value=\"{$key}\"".($options[$args['option_id']]==$key?" selected=\"selected\"":"").">{$val}</option>";
    }

    echo "</select>";
    if ($args['description'])
      echo '<p class="description">'.$args['description'].'</p>';
  }
  public function checkbox($args) {
    $options = get_option($this->data['option_name']);
    if (!isset($options[$args['option_id']])) 
      $options[$args['option_id']] = false;
    echo "<input id='{$args['option_id']}' name='{$this->data['option_name']}[{$args['option_id']}]' type='checkbox' value='true' ".($options[$args['option_id']]?' checked="checked"':'')." />";
    if ($args['description'])
      echo '<p class="description">'.$args['description'].'</p>';
  }
  public function checkbox_list($args) {
    $options = get_option($this->data['option_name']);
    if (!isset($options[$args['option_id']])) 
      $options[$args['option_id']] = array();
    foreach($args['options']['list'] as $key => $val) {
     echo "<label for=\"{$args['option_id']}_{$key}\"><input id='{$args['option_id']}_{$key}' name='{$this->data['option_name']}[{$args['option_id']}][{$key}]' type='checkbox' value='true' ".($options[$args['option_id']][$key]?' checked="checked"':'')." />{$val}</label><br/>";
    }
    if ($args['description'])
      echo '<p class="description">'.$args['description'].'</p>';
  }
}

?>
