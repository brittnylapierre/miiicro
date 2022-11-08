<h1>Admin part my module!</h1>

<label class="mw-ui-label">
  Set url
  <input
      name="iiif_url"
      class="mw_option_field"
      type="text"
      value="<?php print get_option('iiif_url', $params['id']); ?>" />
</label>