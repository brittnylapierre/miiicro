<h1>Admin part my module!</h1>

<label class="mw-ui-label">
  Set url
  <input
      name="bl_url"
      class="mw_option_field"
      type="text"
      value="<?php print get_option('bl_url', $params['id']); ?>" />
</label>